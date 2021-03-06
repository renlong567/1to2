<?php

define('IN_ECS', true);
require_once(dirname(__FILE__) . '/includes/init.php');
require_once(dirname(__FILE__) . '/includes/lib_cus.php');
require_once(ROOT_PATH . '/includes/lib_customs.php');

admin_priv('cus_01_list');

$exc_airport_order = new exchange($ecs->table('airport_order'), $db, 'id', '');

if (empty($_REQUEST['act']))
{
    $_REQUEST['act'] = 'list';
}
else
{
    $_REQUEST['act'] = trim($_REQUEST['act']);
}
if ($_REQUEST['act'] == 'list')
{
    $airport_list = airport_list();
    // header头部模板赋值
    $smarty->assign('ur_here', '报关订单列表');
    $smarty->assign('action_link', array('text' => '导入物流信息准备申报', 'href' => 'custom_list.php?act=check'));
    $smarty->assign('res', $airport_list['res']);
    $smarty->assign('filter', $airport_list['filter']);
    $smarty->assign('record_count', $airport_list['filter']['record_count']);
    $smarty->assign('page_count', $airport_list['filter']['page_count']);

    // 计算排序图标
    $sort_flag = sort_flag($airport_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);
    $smarty->assign('full_page', 1);

    assign_query_info();
    $smarty->display('airport_list.htm');
}
elseif ($_REQUEST['act'] == 'edit')
{
    $cusid = empty($_REQUEST['cusid']) ? 0 : intval($_REQUEST['cusid']);
    if (!$cusid)
    {
        sys_msg("请选择关单", 1, array(), false);
    }
    $sql = "select * from " . $GLOBALS['ecs']->table('cuslist') . " WHERE cusid='" . $cusid . "'";
    $custom = $GLOBALS['db']->getRow($sql);
    if (!$custom)
    {
        sys_msg("请选择关单", 1, array(), false);
    }
    $custom['sendorderdate'] = local_date($_CFG['time_format'], $custom['sendorderdate']);
    $custom['sendpaymentdate'] = local_date($_CFG['time_format'], $custom['sendpaymentdate']);
    $custom['sendshippingdate'] = local_date($_CFG['time_format'], $custom['sendshippingdate']);
    $smarty->assign('custom', $custom);

    $smarty->assign('ur_here', "三单管理:" . $custom['order_sn']);
    $smarty->assign('action_link', array('href' => 'custom_list.php?act=list', 'text' => '三单列表'));

    $smarty->display('custom_list_edit.htm');
}
elseif ($_REQUEST['act'] == 'savedata')
{

    $cusid = empty($_REQUEST['cusid']) ? 0 : intval($_REQUEST['cusid']);
    if (!$cusid)
    {
        sys_msg("请选择关单", 1, array(), false);
    }
    $sql = "select * from " . $GLOBALS['ecs']->table('cuslist') . " WHERE cusid='" . $cusid . "'";
    $custom = $GLOBALS['db']->getRow($sql);
    if (!$custom)
    {
        sys_msg("请选择关单", 1, array(), false);
    }
    $sql = "update " . $GLOBALS['ecs']->table('cuslist') . " set orderstatus='" . intval($_POST['orderstatus']) . "',paymentstatus='" . intval($_POST['paymentstatus']) . "',shippingstatus='" . intval($_POST['shippingstatus']) . "',status='" . intval($_POST['status']) . "',sendstatus='" . intval($_POST['sendstatus']) . "' WHERE cusid='" . $cusid . "'";
    $db->query($sql);
    $link[0]['text'] = '返回列表';
    $link[0]['href'] = 'custom_list.php';
    $link[1]['text'] = '返回编辑';
    $link[1]['href'] = 'custom_list.php?act=edit&cusid=' . $cusid;

    sys_msg("编辑完成", 0, $link);
}
elseif ($_REQUEST['act'] == 'haiguanedit')
{
    $cusid = empty($_REQUEST['cusid']) ? 0 : intval($_REQUEST['cusid']);
    if (!$cusid)
    {
        sys_msg("请选择关单", 1, array(), false);
    }
    $sql = "select * from " . $GLOBALS['ecs']->table('cuslist') . " WHERE cusid='" . $cusid . "'";
    $custom = $GLOBALS['db']->getRow($sql);
    if (!$custom)
    {
        sys_msg("请选择关单", 1, array(), false);
    }
    $sql = "select * from " . $GLOBALS['ecs']->table('cuslist_order') . " WHERE cusid='" . $cusid . "'";
    $order = $GLOBALS['db']->getRow($sql);
    if (!$order)
    {
        sys_msg("该关单不存在订单，请删除后重新同步", 1, array(), false);
    }
    $custom['sendorderdate'] = local_date($_CFG['time_format'], $custom['sendorderdate']);
    $custom['sendpaymentdate'] = local_date($_CFG['time_format'], $custom['sendpaymentdate']);
    $custom['sendshippingdate'] = local_date($_CFG['time_format'], $custom['sendshippingdate']);
    $smarty->assign('custom', $custom);
    $smarty->assign('order', $order);
    $smarty->assign('ur_here', " &nbsp;&nbsp;&nbsp;&nbsp;海关关单" . $custom['order_sn']);
    $smarty->assign('action_link', array('href' => 'custom_list.php?act=list', 'text' => '三单列表'));

    $smarty->display('custom_order_edit.htm');
}
elseif ($_REQUEST['act'] == 'haiguansavecheck')
{

    $datas = haiguancheck($_POST);
    if ($datas)
    {
        echo json_encode(array("status" => 0, 'message' => implode("\r\n", $datas)));
        exit;
    }
}
elseif ($_REQUEST['act'] == 'haiguansave')
{
    $cusid = empty($_REQUEST['cusid']) ? 0 : intval($_REQUEST['cusid']);
    if (!$cusid)
    {
        sys_msg("请选择关单", 1, array(), false);
    }
    $sql = "select * from " . $GLOBALS['ecs']->table('cuslist') . " WHERE cusid='" . $cusid . "'";
    $custom = $GLOBALS['db']->getRow($sql);
    if (!$custom)
    {
        sys_msg("请选择关单", 1, array(), false);
    }

    $datas = haiguancheck($_POST);
    if ($datas)
    {
        sys_msg(implode("<br/>", $datas), 1, array(), false);
        exit;
    }
    $order = $_POST['order'];
    $goodslist = $_POST['goodslist'];
}
elseif ($_REQUEST['act'] == 'query')
{
    $airport_list = airport_list();

    $smarty->assign('res', $airport_list['res']);
    $smarty->assign('filter', $airport_list['filter']);
    $smarty->assign('record_count', $airport_list['filter']['record_count']);
    $smarty->assign('page_count', $airport_list['filter']['page_count']);

    // 计算排序图标
    $sort_flag = sort_flag($airport_list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('airport_list.htm'), '', array('filter' => $airport_list['filter'], 'page_count' => $airport_list['filter']['page_count']));
}
/**
 * @desc 推送报文
 * @author RenLong
 * @date 2016-05-04
 */
elseif ($_REQUEST['act'] == 'customsAction')
{
    if (empty($_POST['order']))
    {
        sys_msg('订单不能为空', 1);
    }

    //操作类型,1新增，2修改，3删除
    $modifyMark = intval($_POST['modifyMark']);
    //总毛重
    $totalWeight = trim($_POST['totalWeight']);
    //进出境日期
    $jcbOrderTime = empty($_POST['jcbOrderTime']) ? local_date('Y-m-d', $_SERVER['REQUEST_TIME']) : trim($_POST['jcbOrderTime']);
    //目标口岸
    $target = empty($_POST['target']) ? 'airport' : trim($_POST['target']);
    //通关方式
    $billmode = intval($_POST['billmode']);

    //订单接口
    if ($_POST['operate'] == 'o2')
    {
        require_once ROOT_PATH . 'includes/modules/customs/airportOrder.php';
        $airportOrder = new airportOrder($_CFG);

        $airportOrder->billmode = $billmode;
        switch ($billmode)
        {
//            case CUSTOMS_MODE_JIHUO:
//                $airportOrder->senderusername = JIHUO_SEND_NAME;
//                $airportOrder->senderuseraddress = JIHUO_SEND_ADDRESS;
//                $airportOrder->senderusertelephone = JIHUO_SEND_MOBILE;
//                $airportOrder->tradecompany = JIHUO_TRADING_COUNTRY_CODE_CIQ;
//                $airportOrder->collusercountryinsp = JIHUO_SEND_COUNTRY_CODE_CIQ;
//                break;
//            case CUSTOMS_MODE_BEIHUO:
//                $airportOrder->senderusername = BEIHUO_SEND_NAME;
//                $airportOrder->senderuseraddress = BEIHUO_SEND_ADDRESS;
//                $airportOrder->senderusertelephone = BEIHUO_SEND_MOBILE;
//                $airportOrder->tradecompany = BEIHUO_TRADING_COUNTRY_CODE_CIQ;
//                $airportOrder->collusercountryinsp = BEIHUO_SEND_COUNTRY_CODE_CIQ;
//                break;
        }

        if (!handle_total_weight_of_orders($totalWeight, $_POST['order']))
        {
            sys_msg('订单毛重计算失败,请检查数据', 1);
        }

        foreach ($_POST['order'] as $v)
        {
            $airportOrder->orderId = $v;
            $airportOrder->appType = $modifyMark;
            $airportOrder->send();
        }
//
        $link[] = array('text' => $_LANG['go_back'], 'href' => basename(__FILE__) . '?act=list');
        sys_msg('报文已生成', 0, $link, false);
    }
    //运单接口
    elseif ($_POST['operate'] == 'o1')
    {
        switch ($_POST['transfer'])
        {
            //EMS
            case 't1':
                require_once ROOT_PATH . 'includes/modules/customs/airportEMS.php';

                $airportEMS = new airportEMS($_CFG);
                $airportEMS->orderIdArr = $_POST['order'];
                $airportEMS->JCBORDERTIME = $jcbOrderTime;
                $airportEMS->MODIFYMARK = $modifyMark;
                $airportEMS->BILLMODE = $billmode;
                switch ($target)
                {
                    case 'zongbao':
                        $airportEMS->JCBORDERPORT = JCB_ORDER_PORT_ZONGBAO;
                        $airportEMS->JCBORDERPORTINSP = JCB_ORDER_PORT_INSP_ZONGBAO;
                        $airportEMS->APPLYPORTINSP = APPLY_PORT_INSP_ZONGBAO;
                        $airportEMS->DECLAREPORT = DECLARE_PORT_ZONGBAO;
                        break;
                }
                $airportEMS->send();
                break;
            //Eton
            case 't3':
                //易通接口
                require_once ROOT_PATH . 'includes/modules/customs/airportEton.php';
                $airportEton = new airportEton($_CFG);
                $airportEton->trepcodeinsp = (string)trim($_POST['OMS']);

                foreach ($_POST['order'] as $v)
                {
                    $airportEton->order_id = $v;
                    $airportEton->billmode = $billmode;
                    $airportEton->send();
                }
                break;
        }

        sys_msg('提交完成，请返回查看结果');
    }
    //支付报文接口
    elseif ($_POST['operate'] == 'o6')
    {
        require_once ROOT_PATH . 'includes/modules/customs/alipay.php';
        require_once ROOT_PATH . 'includes/lib_order.php';

        $alipayModel = new alipay($_CFG);

        foreach ($_POST['order'] as $v)
        {
            $order = get_airport_info($v);
            switch ($order['pay_name'])
            {
                case '支付宝':
                default :
                    $alipayModel->out_request_no = $order['order_sn'];
                    $alipayModel->trade_no = $order['paymentNo'];
                    $alipayModel->amount = $order['order_amount'];
                    $alipayModel->customs_place = PAY_TYPE_ALIPAY_CUSTOMS_ZONGSHU;
                    $alipayModel->send();
                    $alipayModel->out_request_no = $order['order_sn'] . 'b';
                    $alipayModel->customs_place = PAY_TYPE_ALIPAY_CUSTOMS_ZONGBAOQU;
                    $alipayModel->send();
                    break;
            }
        }

        sys_msg('提交完成，请返回刷新查看结果');
    }
    //仓储企业接口
    elseif ($_POST['operate'] == 'o3')
    {
        require_once ROOT_PATH . 'includes/modules/customs/airportStorage.php';
        $airportStorage = new airportStorage($_CFG);

        foreach ($_POST['order'] as $v)
        {
            $order = get_airport_info($v);

            switch ($billmode)
            {
                case CUSTOMS_MODE_JIHUO:
//                    $airportStorage->SENDERUSERCOUNTRY = JIHUO_SEND_COUNTRY_CODE_CUS;
//                    $airportStorage->SENDERUSERNAME = JIHUO_SEND_NAME;
//                    $airportStorage->SENDERUSERADDRESS = JIHUO_SEND_ADDRESS;
//                    $airportStorage->SENDERUSERTELEPHONE = JIHUO_SEND_MOBILE;
//                    $airportStorage->TRADECOMPANY = JIHUO_TRADING_COUNTRY_CODE_CIQ;
//                    $airportStorage->COLLUSERCOUNTRYINSP = JIHUO_SEND_COUNTRY_CODE_CIQ;
                    break;
                case CUSTOMS_MODE_BEIHUO:
//                    $airportStorage->SENDERUSERCOUNTRY = BEIHUO_SEND_COUNTRY_CODE_CUS;
//                    $airportStorage->SENDERUSERNAME = BEIHUO_SEND_NAME;
//                    $airportStorage->SENDERUSERADDRESS = BEIHUO_SEND_ADDRESS;
//                    $airportStorage->SENDERUSERTELEPHONE = BEIHUO_SEND_MOBILE;
//                    $airportStorage->TRADECOMPANY = BEIHUO_TRADING_COUNTRY_CODE_CIQ;
//                    $airportStorage->COLLUSERCOUNTRYINSP = BEIHUO_SEND_COUNTRY_CODE_CIQ;
                    break;
            }

            $airportStorage->orderId = $v;
            $airportStorage->ActionID = $modifyMark;
            $airportStorage->PlatformOrderNO = $order['order_sn'];
            $airportStorage->OrderTime = local_strtotime($order['order_addtime']);
            $airportStorage->PayTime = local_strtotime($order['pay_time']);
            $airportStorage->Totoal = $order['order_amount'];
            $airportStorage->IDType = $order['idtype'];
            $airportStorage->IDNO = $order['consignee_idc'];
            $airportStorage->ConsigneeCountry = $order['country'];
            $airportStorage->ConsigneeName = $order['consignee'];
            $airportStorage->C_Province = $order['province'];
            $airportStorage->C_City = $order['city'];
            $airportStorage->C_Tel1 = $order['mobile'];
            $airportStorage->C_Zone = $order['district'];
            $airportStorage->C_Address1 = $order['address'];

            $airportStorage->send();
        }

        sys_msg('提交完成，请返回刷新查看结果');
    }
    elseif ($_POST['operate'] == 'batch_del')
    {
        $sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('airport_order') . ' WHERE ' . db_create_in($_POST['order'], 'id');
        $del_order = $GLOBALS['db']->query($sql);
        if (!$del_order)
        {
            messageGoBackJS('删除订单失败...');
        }
        messageGoBackJS('删除成功', 'custom_list.php?act=list');
    }
}
/**
 * @desc 删除订单报文
 * @author RenLong
 * @date 2016-05-04
 */
elseif ($_REQUEST['act'] == 'remove')
{
    $id = intval($_GET['id']);
    $airport_info = get_airport_info($id);
    if (empty($airport_info))
    {
        make_json_error('订单记录不存在');
    }
    $order_sn = $airport_info['order_sn'];

    if ($exc_airport_order->drop($id))
    {
        /* 记日志 */
        admin_log($order_sn, 'remove', 'airport_order');
        /* 清除缓存 */
        clear_cache_files();
        $url = basename(__FILE__) . '?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);
        ecs_header("Location: $url\n");
        exit();
    }
    else
    {
        make_json_result('删除失败');
    }
}
// excel订单导入
if ($_REQUEST['act'] == 'check')
{
    // header头部模板赋值
    $smarty->assign('ur_here', '导入物流信息');
    $smarty->assign('action_link', array('href' => 'custom_list.php?act=list', 'text' => '返回三单列表'));
    $smarty->display('airport_excel.htm');
}
elseif ($_REQUEST['act'] == 'excel_order_action')
{
    // excel导入操作
    // 文件上传成功处理
    if ($_FILES['excel']['error'] == UPLOAD_ERR_OK)
    {
        // 判断文件格式
        if (strpos($_FILES['excel']['type'], 'excel'))
        {
            // 定义文件上传目录
            $uploaddir = ROOT_PATH . "upload/file/" . date('Ymd');
            // 创建文件上传目录
            if (!is_dir($uploaddir))
            {
                if (!mkdir($uploaddir, 0777, true))
                {
                    echo '<script>alert("上传目录没有create权限！请联系管理员修改！");location="airport.php?act=excel"</script>';
                }
            }

            // 定义文件上传名
            $uploadfile = $uploaddir . '/' . uniqid() . '.xls';

            // 保存上传的文件
            if (!move_uploaded_file($_FILES['excel']['tmp_name'], $uploadfile))
            {
                // 文件保存失败！
                p_message("文件上传失败！请联系管理员修改！", "airport.php?act=excel");
            }


            // excel导入操作 使用PHPExcel类
            require_once ROOT_PATH . 'includes/phpexcel.php';
            $excel = PHPExcel_IOFactory::load($uploadfile); // 从文件加载excel
            $sheet = $excel->getActiveSheet(); // 得到活动的工作表
            $rows = $sheet->getHighestRow(); // 得到总条数
            $data_order = array();    //初始化订单数据
            $data_goods = array();    //初始化商品数据
            // 循环读取数据，从第2行开始
            for ($i = 2; $i <= $rows; $i++)
            {
                $order_sn = trim($sheet->getCellByColumnAndRow(0, $i)->getValue());

                $sql = 'SELECT '
                        . 'o.*,'
                        . 'a.region_name as province,'
                        . 'b.region_name as city,'
                        . 'c.region_name as district,'
                        . 'u.customerid'
                        . ' FROM ' . $GLOBALS['ecs']->table('order_info') . ' o' .
                        ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' u ON o.user_id=u.user_id' .
                        ' LEFT JOIN ' . $GLOBALS['ecs']->table('region') . ' a ON o.province=a.region_id' .
                        ' LEFT JOIN ' . $GLOBALS['ecs']->table('region') . ' b ON o.city=b.region_id' .
                        ' LEFT JOIN ' . $GLOBALS['ecs']->table('region') . ' c ON o.district=c.region_id' .
                        ' WHERE o.order_sn=\'' . $order_sn . '\'';
                $data = $GLOBALS['db']->getRow($sql);

                if ($data)
                {
                    // 判断是否已导入过
                    $sql = 'select order_sn from ' . $ecs->table('airport_order') . " where order_sn='$order_sn'";
                    if ($db->getOne($sql))
                    {
                        $repeat .= $order_sn . '|';
                        continue;
                    }

                    $data_order['import_time'] = $_SERVER['REQUEST_TIME'];
                    $data_order['order_sn'] = $data['order_sn'];
                    $data_order['pay_time'] = $data['pay_time'];
                    $data_order['order_amount'] = $data['money_paid']; // 总费用
                    $data_order['goods_amount'] = $data['goods_amount']; // 货值
                    $data_order['consignee'] = $data['consignee']; // 收货人名称
                    $data_order['address'] = $data['province'] . $data['city'] . $data['district'] . $data['address']; // 收货人地址
                    $data_order['mobile'] = $data['mobile']; // 收货人电话
                    $data_order['consignee_idc'] = $data['customerid']; // 证件号码
                    $data_order['paymentNo'] = $data['pay_number']; // 支付交易号
                    $data_order['logisticsNo'] = $data['invoice_no']; // 物流运单号
                    $data_order['order_addtime'] = $data['add_time']; // 订单提交时间
                    $data_order['shipping_fee'] = $data['shipping_fee']; // 运费
                    $data_order['taxfee'] = $data['tax']; // 进口行邮税
                    $data_order['batchNumbers'] = trim($sheet->getCellByColumnAndRow(1, $i)->getValue()); // 批次号
                    $data_order['totalLogisticsNo'] = trim($sheet->getCellByColumnAndRow(2, $i)->getValue()); // 总运单号

                    $data_order = array_map(strip_tags, $data_order);
                    $data_order = array_map(mysql_real_escape_string, $data_order);

                    // 替换特殊字符
                    $data_order['consignee'] = str_replace(' ', '', $data_order['consignee']);
                    $data_order['mobile'] = str_replace(' ', '', $data_order['mobile']);
                    $data_order['mobile'] = str_replace('-', '', $data_order['mobile']);
                    $data_order['address'] = str_replace('<', '（', $data_order['address']);
                    $data_order['address'] = str_replace('>', '）', $data_order['address']);

                    $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('airport_order'), $data_order, 'INSERT');
                }
            }

            $msg = empty($repeat) ? '全部导入成功~' : '导入完成，其中有重复订单:' . $repeat;
            sys_msg($msg);
        }
        else
        {
            p_message("只支持.xls格式的excel表格！", "airport.php?act=excel");
        }
    }
    elseif ($_FILES['excel']['error'] == UPLOAD_ERR_INI_SIZE)
    {
        p_message("上传文件太大！", "airport.php?act=excel");
    }
    elseif ($_FILES['excel']['error'] == UPLOAD_ERR_NO_FILE)
    {
        p_message("没有选定上传文件！", "airport.php?act=excel");
    }
    elseif ($_FILES['excel']['error'] == UPLOAD_ERR_CANT_WRITE)
    {
        p_message("文件夹没有写入权限！", "airport.php?act=excel");
    }
}

// js打印输出，并跳转页面
function p_message($info, $url)
{
    echo "<script>alert('{$info}');location='{$url}'</script>";
    die;
}

function haiguancheck($value)
{
    $errmsg = array();
    $order = $value['order'];
    $goodslist = $value['goodslist'];

    if ($order)
    {
        if (!$order["lmsno"])
        {
            $errmsg[] = "订单总表:S账册号不能为空";
        }
        if (!$order["manualno"])
        {
            $errmsg[] = "订单总表:关联H2010账册号不能为空";
        }
        /**
          if(!$order["license_no"]){
          $errmsg[]="订单总表:许可证号不能为空";
          }
          if(!$order["declaretype"]){
          $errmsg[]="订单总表:申报方式1： 货物申报 2： 物品申报不能为空";
          }
         * */
        if (!$order["cbecode"])
        {
            $errmsg[] = "订单总表:电商代码不能为空";
        }

        if (!$order["cbename"])
        {
            $errmsg[] = "订单总表:电商名称不能为空";
        }

        if (!$order["ecpcode"])
        {
            $errmsg[] = "订单总表:电商平台代码不能为空";
        }
        /**
          if(!$order["ecpname"]){
          $errmsg[]="订单总表:电商平台名称不能为空";
          }
         * */
        if (!$order["collectionuseraddress"])
        {
            $errmsg[] = "订单总表:收货人地址不能为空";
        }
        if (!$order["collectionusercountry"])
        {
            $errmsg[] = "订单总表:收货人国家不能为空";
        }
        if (!$order["collectionusername"])
        {
            $errmsg[] = "订单总表:收货人名称不能为空";
        }
        if (!$order["collectionusertelephone"])
        {
            $errmsg[] = "订单总表:收货人电话不能为空";
        }
        if (!$order["goodsvalue"])
        {
            $errmsg[] = "订单总表:订单实际销售价格不能为空";
        }
        if (!$order["orderid"])
        {
            $errmsg[] = "订单总表:订单编号不能为空";
        }
        if (!$order["ordersum"])
        {
            $errmsg[] = "订单总表:订单总价 总费用不能为空";
        }
        /**
          if(!$order["freight"]){
          $errmsg[]="订单总表:运费不能为空";
          }
          if(!$order["otherfee"]){
          $errmsg[]="订单总表:其他费用不能为空";
          }

          if(!$order["taxfee"]){
          $errmsg[]="订单总表:进口行邮费不能为空";
          }
          if(!$order["remark"]){
          $errmsg[]="订单总表:备注不能为空";
          }
         * */
        if (!$order["senderusercountry"])
        {
            $errmsg[] = "订单总表:发货人所在国不能为空";
        }
        if (!$order["senderusername"])
        {
            $errmsg[] = "订单总表:发货人的名称不能为空";
        }
        if (!$order["senderuseraddress"])
        {
            $errmsg[] = "订单总表:发货人的地址不能为空";
        }
        if (!$order["senderusertelephone"])
        {
            $errmsg[] = "订单总表:发货人电话不能为空";
        }
        if (!$order["idtype"])
        {
            $errmsg[] = "订单总表:证件类型不能为空";
        }
        if (!$order["customerid"])
        {
            $errmsg[] = "订单总表:证件号码不能为空";
        }
        if (!$order["ietype"])
        {
            $errmsg[] = "订单总表:进出口标志 I-进口；E-出口不能为空";
        }
        /**
          if(!$order["modifymark"]){
          $errmsg[]="订单总表:操作类型 1-新增；2-修改；3-删除不能为空";
          }
         * */
        if (!$order["billmode"])
        {
            $errmsg[] = "订单总表:模式代码：1- 一般模式 ； 2- 保税模式不能为空";
        }
        if (!$order["wasterornot"])
        {
            $errmsg[] = "订单总表:是否有废旧物品不能为空";
        }
        if (!$order["botanyornot"])
        {
            $errmsg[] = "订单总表:是否带有植物性包装及铺垫材料不能为空";
        }
        /**
          if(!$order["taxedenterprise"]){
          $errmsg[]="订单总表:缴税单位不能为空";
          }
         * */
        if (!$order["cbecodeinsp"])
        {
            $errmsg[] = "订单总表:电商检验检疫备案编号不能为空";
        }
        /**
          if(!$order["ecpcodeinsp"]){
          $errmsg[]="订单总表:电商平台检验检疫备案编号不能为空";
          }
         * */
        if (!$order["trepcodeinsp"])
        {
            $errmsg[] = "订单总表:物流企业检验检疫备案编号不能为空";
        }
        if (!$order["submittime"])
        {
            $errmsg[] = "订单总表:订单提交时间不能为空";
        }
        if (!$order["tradecompany"])
        {
            $errmsg[] = "订单总表:贸易国别（代码）不能为空";
        }
        if (!$order["totalfeeunit"])
        {
            $errmsg[] = "订单总表:总费用币制不能为空";
        }
        if (!$order["countofgoodstype"])
        {
            $errmsg[] = "订单总表:商品种类数不能为空";
        }
        if (!$order["weight"])
        {
            $errmsg[] = "订单总表:毛重不能为空";
        }
        if (!$order["weightunit"])
        {
            $errmsg[] = "订单总表:毛重单位不能为空";
        }
        if (!$order["netweight"])
        {
            $errmsg[] = "订单总表:净重不能为空";
        }
        if (!$order["netweightunit"])
        {
            $errmsg[] = "订单总表:净重单位不能为空";
        }
        /**
          if(!$order["platformurl"]){
          $errmsg[]="订单总表:平台网址不能为空";
          }
         * */
        if (!$order["collusercountryinsp"])
        {
            $errmsg[] = "订单总表:发货人所在国（检验检疫代码） 不能为空";
        }
        if (!$order["sendusercountryinsp"])
        {
            $errmsg[] = "订单总表:收货人所在国（检验检疫代码） 不能为空";
        }
        if (!$order["paynumber"])
        {
            $errmsg[] = "订单总表:支付交易号不能为空";
        }
        if (!$order["payenterprisecode"])
        {
            $errmsg[] = "订单总表:支付企业代码不能为空";
        }
        /**
          if(!$order["payenterprisename"]){
          $errmsg[]="订单总表:支付企业名称不能为空";
          }

          if(!$order["otherpayment"]){
          $errmsg[]="订单总表:其他支付金额不能为空";
          }
          if(!$order["otherpaymenttype"]){
          $errmsg[]="订单总表:其他支付备注不能为空";
          }
         * */
        if (!$order["declcode"])
        {
            $errmsg[] = "订单总表:报关企业海关备案编号不能为空";
        }
        /**
          if(!$order["declname"]){
          $errmsg[]="订单总表:报关企业名称不能为空";
          }
         * */
        /**
          if(!$order["depositorguarantee"]){
          $errmsg[]="订单总表:保金保函类型不能为空";
          }

          if(!$order["guaranteeno"]){
          $errmsg[]="订单总表:保函编号不能为空";
          }
          if(!$order["extendfield1"]){
          $errmsg[]="订单总表:预留字段1不能为空";
          }
          if(!$order["extendfield2"]){
          $errmsg[]="订单总表:预留字段2不能为空";
          }
          if(!$order["extendfield3"]){
          $errmsg[]="订单总表:预留字段3不能为空";
          }
         * */
    }
    else
    {
        $errmsg[] = "订单总表没有数据";
    }
    if ($goodslist)
    {
        foreach ($goodslist as $key => $goods)
        {
            if (!$goods["gno"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:关联H2010项号不能为空";
            }
            if (!$goods["itemno"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:海关备案商品编号不能为空";
            }
            if (!$goods["shelfgoodsname"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:商品上架品名不能为空";
            }
            if (!$goods["describe"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:商品描述不能为空";
            }
            if (!$goods["goodid"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:商品货号不能为空";
            }
            if (!$goods["goodname"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:申报品名不能为空";
            }
            if (!$goods["specifications"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:规格型号不能为空";
            }
            if (!$goods["barcode"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]: HS编码不能为空";
            }
            if (!$goods["taxid"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:行邮税号不能为空";
            }
            if (!$goods["sourceproducercountry"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:原产国不能为空";
            }
            if (!$goods["coin"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:币制不能为空";
            }
            if (!$goods["unit"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:计量单位不能为空";
            }
            if (!$goods["amount"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:申报数量不能为空";
            }
            if (!$goods["goodprice"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:成交单价不能为空";
            }
            if (!$goods["ordersum"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:成交总价不能为空";
            }
            if (!$goods["flag"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:是否赠品 N:不是 Y:是不能为空";
            }
            if (!$goods["goodidinsp"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:检验检疫商品备案编号不能为空";
            }
            if (!$goods["orderid"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:订单编号不能为空";
            }
            if (!$goods["goodnameenglish"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:货物名称(英文)不能为空";
            }
            if (!$goods["weigth"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:毛重不能为空";
            }
            if (!$goods["weightunit"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:重量单位代码不能为空";
            }
            if (!$goods["packcategoryinsp"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:包装类型代码(检验检疫)不能为空";
            }
            if (!$goods["wasterornotinsp"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:废旧标识不能为空";
            }
            if (!$goods["remarksinsp"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:备注不能为空";
            }
            if (!$goods["coininsp"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:币制（检验检疫代码）不能为空";
            }
            if (!$goods["unitinsp"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:计量单位（检验检疫代码）不能为空";
            }
            if (!$goods["srccountryinsp"])
            {
                $errmsg[] = "商品[" . $goods["goods_id"] . "]:原产国（检验检疫代码）不能为空";
            }
        }
    }
    else
    {
        $errmsg[] = "订单商品不能为空";
    }
    return $errmsg;
}

?>