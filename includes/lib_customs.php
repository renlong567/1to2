<?php

/**
 * 海关申报公共函数库
 * @author RenLong
 * @date 2015-04-03
 */
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

/**
 * @desc 取得机场订单信息
 * @author WangMin
 * @date 2015-06-25
 *
 * @return array
 */
function get_airport_info($orderId)
{
    $sql = 'SELECT ao.*,o.pay_id,o.pay_name,o.source_id,o.order_id,o.user_id '
            . 'FROM ' . $GLOBALS['ecs']->table('airport_order') . ' ao '
            . 'LEFT JOIN ' . $GLOBALS['ecs']->table('order_info') . ' o ON ao.order_sn=o.order_sn '
            . 'WHERE ao.id= ' . $orderId;

    $orderInfo = $GLOBALS['db']->getRow($sql);

    //格式化数据
    $orderInfo['order_addtime'] = local_date('Y-m-d H:i:s', $orderInfo['order_addtime']);
    $orderInfo['pay_time'] = local_date('Y-m-d H:i:s', $orderInfo['pay_time']);
    $orderInfo['st_entry_time'] = local_date('Y-m-d H:i:s', $orderInfo['st_entry_time']);

    return $orderInfo;
}

/**
 * @desc 取得机场订单商品信息
 * @author RenLong
 * @param int $orderId
 *
 * @return array
 */
function get_airport_goods_info($orderId)
{
    $sql = 'SELECT * '
            . 'FROM ' . $GLOBALS['ecs']->table('airport_goods')
            . 'WHERE cid= ' . $orderId;

    $goodsInfo = $GLOBALS['db']->getAll($sql);

    return $goodsInfo;
}

/**
 * @desc 获取机场报关订单列表
 * @author RenLong
 * @date 2015-06-27
 *
 * @return array
 */
function airport_list()
{
    $result = get_filter();

    if ($result === false)
    {
        // 默认的排序
        $filter['sort_by'] = empty($_REQUEST['sort_by']) ? 'id' : mysql_real_escape_string(trim($_REQUEST['sort_by']));
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : mysql_real_escape_string(trim($_REQUEST['sort_order']));
        $filter['customs_status'] = $_REQUEST['customs_status'] == '' ? '' : intval($_REQUEST['customs_status']);
        $filter['orderNo'] = empty($_REQUEST['orderNo']) ? '' : mysql_real_escape_string(trim($_REQUEST['orderNo']));
        $filter['consignee'] = empty($_REQUEST['consignee']) ? '' : mysql_real_escape_string(trim($_REQUEST['consignee']));
        $filter['batchNumbers'] = empty($_REQUEST['batchNumbers']) ? '' : mysql_real_escape_string(trim($_REQUEST['batchNumbers']));
        $filter['logisticsNo'] = empty($_REQUEST['logisticsNo']) ? '' : mysql_real_escape_string(trim($_REQUEST['logisticsNo']));
        $filter['customsType'] = empty($_REQUEST['customsType']) ? '' : mysql_real_escape_string(trim($_REQUEST['customsType']));
        $where = ' WHERE 1';

        // 搜索
        if (!empty($filter['orderNo']))
        {
            $where .= ' AND order_sn LIKE "%' . $filter['orderNo'] . '%"';
        }
        if (!empty($filter['consignee']))
        {
            $where .= ' AND consignee LIKE "%' . $filter['consignee'] . '%"';
        }
        if (!empty($filter['batchNumbers']))
        {
            $where .= ' AND batchNumbers LIKE "%' . $filter['batchNumbers'] . '%"';
        }
        if (!empty($filter['logisticsNo']))
        {
            $where .= ' AND logisticsNo LIKE "%' . $filter['logisticsNo'] . '%"';
        }
        if (!empty($filter['customsType']) && $filter['customs_status'] !== '')
        {
            switch ($filter['customsType'])
            {
                default :
                case 'order':
                    $filter['customsType'] = 'order_status';
                    break;
                case 'pay':
                    $filter['customsType'] = 'pay_number_status';
                    break;
                case 'shentong':
                    $filter['customsType'] = 'st_status';
                    break;
                case 'shipping':
                    $filter['customsType'] = 'transfer_status';
                    break;
            }

            $where .= ' AND ' . $filter['customsType'] . '=' . $filter['customs_status'];
        }

        // 计算总的记录数
        $sql = 'select count(*) from ' . $GLOBALS['ecs']->table('airport_order') . $where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);
        // 分页大小
        $filter = page_and_size($filter);

        //RenLong
        $sql = 'SELECT * '
                . 'FROM ' . $GLOBALS['ecs']->table('airport_order') . ' o '
                . $where
                . " ORDER BY {$filter['sort_by']} {$filter['sort_order']}"
                . ' LIMIT ' . $filter['start'] . ',' . $filter['page_size'];

        set_filter($filter, $sql);
    }
    else
    {
        $sql = $result['sql'];
        $filter = $result['filter'];
    }

    // 查询所有数据
    $res = $GLOBALS['db']->getAll($sql);

    $status_arr = array('order_status', 'transfer_status', 'pay_number_status', 'st_status');

    foreach ($res as &$value)
    {
        $value['import_time'] = local_date('Y-m-d H:i:s', $value['import_time']);
        foreach ($status_arr as $v)
        {
            switch ($value[$v])
            {
                case AIRPORT_CUSTOMS_NORMAL:
                    $value[$v] = '未申报';
                    break;
                case AIRPORT_CUSTOMS_OK:
                    $value[$v] = '<span style="color:green;">成功</span>';
                    break;
                case AIRPORT_CUSTOMS_FAIL:
                    $value[$v] = '<span style="color:#f00;">失败</span>';
                    break;
                default:
                    $value[$v] = '未知状态';
                    break;
            }
        }
    }
    $arr = array('res' => $res, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}

/**
 * @desc 机场订单导入信息
 * @author WangMin
 * @date 2015-06-29
 * @return array
 */
function airport_order()
{
    $result = get_filter();

    if ($result === false)
    {
        $filter['orderSn'] = empty($_REQUEST['orderSn']) ? '' : trim($_REQUEST['orderSn']);

        $where = ' WHERE 1 ';
        // 搜索
        if ($filter['orderSn'] != '')
        {
            $where .= ' AND order_sn LIKE "%' . $filter['orderSn'] . '%" ';
        }

        $where .= ' AND order_status=' . OS_CONFIRMED . ' AND pay_status=' . PS_PAYED . ' AND shipping_id=2 '
                . 'AND order_sn NOT IN (SELECT o.order_sn FROM '
                . $GLOBALS['ecs']->table('order_info') . ' o INNER JOIN '
                . $GLOBALS['ecs']->table('airport_order') . ' a ON o.order_sn=a.order_sn)';

        //计算总的记录数
        $sql = 'select count(*) from ' . $GLOBALS['ecs']->table('order_info') . $where;

        $filter['record_count'] = $GLOBALS['db']->getOne($sql);
        //分页大小
        $filter = page_and_size($filter);
        $sql = 'select * from ' . $GLOBALS['ecs']->table('order_info') . $where . ' LIMIT ' . $filter['start'] . ',' . $filter['page_size'];

        set_filter($filter, $sql);
    }
    else
    {
        $sql = $result['sql'];
        $filter = $result['filter'];
    }

    $res = $GLOBALS['db']->getAll($sql);

    $arr = array('res' => $res, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}

/**
 * @desc 保税区报文数据替换
 * @author RenLong
 * @date 2016-01-14
 * @param [] $values
 * @param [] $params
 */
function replace_customs_values(&$values, $params = array())
{
    switch ($params['stockFlag'])
    {
        case CUSTOMS_MODE_JIHUO:
            $values[33]['value'] = JIHUO_SEND_NAME;
            $values[34]['value'] = JIHUO_SEND_ADDRESS;
            $values[35]['value'] = JIHUO_SEND_MOBILE;
            $values[36]['value'] = JIHUO_TRADING_COUNTRY_CODE_CIQ;
            $values[37]['value'] = JIHUO_TRADING_COUNTRY_CODE_CUS;
            $values[46]['value'] = CUSTOMS_MODE_JIHUO;
            break;
        case CUSTOMS_MODE_BEIHUO:
            $values[33]['value'] = BEIHUO_SEND_NAME_BAOSHUI;
            $values[34]['value'] = BEIHUO_SEND_ADDRESS_BAOSHUI;
            $values[35]['value'] = BEIHUO_SEND_MOBILE_BAOSHUI;
            $values[36]['value'] = BEIHUO_SEND_COUNTRY_CODE_CIQ;
            $values[37]['value'] = BEIHUO_SEND_COUNTRY_CODE_CUS;
            $values[46]['value'] = CUSTOMS_MODE_BEIHUO;
            break;
    }

    switch ($params['express'])
    {
        case 'shenTong':
            $values[88]['value'] = LOGISTICS_SHENTONG_CIQ_CODE;
            $values[89]['value'] = LOGISTICS_SHENTONG_CIQ_NAME;
            break;
        case 'EMS':
            $values[88]['value'] = LOGISTICS_EMS_CODE_BAOSHUIWULIU;
            $values[89]['value'] = LOGISTICS_EMS_NAME_BAOSHUIWULIU;
            break;
    }

    $values[55]['value'] = $params['modifyMark'];
}

/**
 * @desc 取得保税区订单信息
 * @author RenLong
 * @date 2016-04-11
 *
 * @return array
 */
function get_customs_info($orderId)
{
    $sql = 'SELECT ao.*,o.pay_id,o.pay_name,o.source_id,o.order_id,o.user_id '
            . 'FROM ' . $GLOBALS['ecs']->table('customs_order') . ' ao '
            . 'LEFT JOIN ' . $GLOBALS['ecs']->table('order_info') . ' o ON ao.orderNo=o.order_sn '
            . 'WHERE ao.id= ' . $orderId;

    $orderInfo = $GLOBALS['db']->getRow($sql);

    return $orderInfo;
}

/**
 * @desc 保税物流中心报文列表
 * @author RenLong
 * @date 2016-04-12
 * @return []
 */
function customs_list()
{
    $result = get_filter();

    if ($result === false)
    {
// 默认的排序
        $filter['sort_by'] = empty($_REQUEST['sort_by']) ? 'time' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
        $filter['customs_status'] = $_REQUEST['customs_status'] == '' ? '' : intval($_REQUEST['customs_status']);
        $where = ' WHERE 1';
        // 搜索
        if ($filter['customs_status'] != '')
        {
            $where .= ' AND customs_status=' . $filter['customs_status'];
        }

        if (isset($_POST['orderNo']) && $_POST['orderNo'])
        {
            $where .= ' AND orderNo LIKE "' . $_POST['orderNo'] . '"';
        }
        elseif (isset($_POST['batchNumbers']) && $_POST['batchNumbers'])
        {
            $where .= ' AND batchNumbers LIKE "' . $_POST['batchNumbers'] . '"';
        }
        elseif (isset($_POST['logisticsNo']) && $_POST['logisticsNo'])
        {
            $where .= ' AND logisticsNo LIKE "' . $_POST['logisticsNo'] . '"';
        }
        elseif (isset($_POST['customer']) && $_POST['customer'])
        {
            $where .= ' AND customer LIKE "' . $_POST['customer'] . '"';
        }
        elseif (isset($_POST['consignee']) && $_POST['consignee'])
        {
            $where .= ' AND consignee LIKE "' . $_POST['consignee'] . '"';
        }
//    elseif (isset($_POST['customs_status']) && $_POST['customs_status'])
        //    {
        //        // 翻页带上 搜索条件
        //        $filter['customs_status'] = $_POST['customs_status'];
        //
    //        if ($_POST['customs_status'] == 1)
        //        {
        //            // 待运单绑定
        //            $where .= ' AND logisticsNo = " " ';
        //        }
        //        elseif ($_POST['customs_status'] == 2)
        //        {
        //            // 待海关申报
        //            $where .= ' AND logisticsNo <> " " AND customs_status = 0 ';
        //        }
        //        elseif ($_POST['customs_status'] == 3)
        //        {
        //            // 待海关回执
        //            $where .= ' AND logisticsNo <> " " AND customs_status = 1 ';
        //        }
        //        elseif ($_POST['customs_status'] == 4)
        //        {
        //            // 待物流申报
        //            $where .= ' AND logisticsNo <> " " AND customs_status = -1 ';
        //        }
        //    }
        // 计算总的记录数
        $sql = 'select count(*) from ' . $GLOBALS['ecs']->table('customs_order') . $where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);
        $filter = page_and_size($filter); // 分页大小
        $sql = 'select * from ' . $GLOBALS['ecs']->table('customs_order') . $where . " ORDER BY {$filter['sort_by']} {$filter['sort_order']}" . ' LIMIT ' . $filter['start'] . ',' . $filter['page_size'];

        set_filter($filter, $sql);
    }
    else
    {
        $sql = $result['sql'];
        $filter = $result['filter'];
    }
    // 查询所有数据
    $res = $GLOBALS['db']->getAll($sql);

    $status_arr = array('order_status', 'transfer_status', 'pay_number_status', 'st_status');

    foreach ($res as &$value)
    {
        $value['time'] = local_date('Y-m-d H:i:s', $value['time']);
        $sql = 'select count(*) as count from ' . $GLOBALS['ecs']->table('customs_goods') . ' where cid=' . $value['id'];
        $count = $GLOBALS['db']->getRow($sql);
        $value['count'] = $count['count'];
        foreach ($status_arr as $v)
        {
            switch ($value[$v])
            {
                case AIRPORT_CUSTOMS_NORMAL:
                    $value[$v] = '未申报';
                    break;
                case AIRPORT_CUSTOMS_OK:
                    $value[$v] = '<span style="color:green;">成功</span>';
                    break;
                case AIRPORT_CUSTOMS_FAIL:
                    $value[$v] = '<span style="color:#f00;">失败</span>';
                    break;
                default:
                    $value[$v] = '未知状态';
                    break;
            }
        }
    }

    $arr = array('res' => $res, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}
