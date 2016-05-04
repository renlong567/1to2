<?php
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
require(dirname(__FILE__) . '/includes/lib_cus.php');
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
    $smarty->assign('action_link', array('text' => '检测新的订单', 'href' => 'custom_list.php?act=check'));
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

}elseif ($_REQUEST['act'] == 'edit')
{
    $cusid = empty($_REQUEST['cusid']) ? 0 : intval($_REQUEST['cusid']);
    if(!$cusid){
         sys_msg("请选择关单", 1, array(), false);
    }
    $sql="select * from ".$GLOBALS['ecs']->table('cuslist')." WHERE cusid='".$cusid."'";
    $custom=$GLOBALS['db']->getRow($sql);
    if(!$custom){
        sys_msg("请选择关单", 1, array(), false);    
    }
    $custom['sendorderdate']=local_date($_CFG['time_format'], $custom['sendorderdate']);
    $custom['sendpaymentdate']=local_date($_CFG['time_format'], $custom['sendpaymentdate']);
    $custom['sendshippingdate']=local_date($_CFG['time_format'], $custom['sendshippingdate']);
    $smarty->assign('custom',      $custom);

    $smarty->assign('ur_here',     "三单管理:".$custom['order_sn']);
    $smarty->assign('action_link', array('href'=>'custom_list.php?act=list', 'text' => '三单列表'));

    $smarty->display('custom_list_edit.htm');


}elseif ($_REQUEST['act'] == 'savedata')
{

    $cusid = empty($_REQUEST['cusid']) ? 0 : intval($_REQUEST['cusid']);
    if(!$cusid){
         sys_msg("请选择关单", 1, array(), false);
    }
    $sql="select * from ".$GLOBALS['ecs']->table('cuslist')." WHERE cusid='".$cusid."'";
    $custom=$GLOBALS['db']->getRow($sql);
    if(!$custom){
        sys_msg("请选择关单", 1, array(), false);    
    }
    $sql="update ".$GLOBALS['ecs']->table('cuslist')." set orderstatus='".intval($_POST['orderstatus'])."',paymentstatus='".intval($_POST['paymentstatus'])."',shippingstatus='".intval($_POST['shippingstatus'])."',status='".intval($_POST['status'])."',sendstatus='".intval($_POST['sendstatus'])."' WHERE cusid='".$cusid."'";
    $db->query($sql); 
     $link[0]['text'] = '返回列表';
     $link[0]['href'] = 'custom_list.php';
     $link[1]['text'] = '返回编辑';
     $link[1]['href'] = 'custom_list.php?act=edit&cusid='.$cusid;

     sys_msg("编辑完成",0, $link);


}elseif ($_REQUEST['act'] == 'haiguanedit')
{
    $cusid = empty($_REQUEST['cusid']) ? 0 : intval($_REQUEST['cusid']);
    if(!$cusid){
         sys_msg("请选择关单", 1, array(), false);
    }
    $sql="select * from ".$GLOBALS['ecs']->table('cuslist')." WHERE cusid='".$cusid."'";
    $custom=$GLOBALS['db']->getRow($sql);
    if(!$custom){
        sys_msg("请选择关单", 1, array(), false);    
    }
    $sql="select * from ".$GLOBALS['ecs']->table('cuslist_order')." WHERE cusid='".$cusid."'";
    $order=$GLOBALS['db']->getRow($sql);
    if(!$order){
        sys_msg("该关单不存在订单，请删除后重新同步", 1, array(), false);    
    }
    $custom['sendorderdate']=local_date($_CFG['time_format'], $custom['sendorderdate']);
    $custom['sendpaymentdate']=local_date($_CFG['time_format'], $custom['sendpaymentdate']);
    $custom['sendshippingdate']=local_date($_CFG['time_format'], $custom['sendshippingdate']);
    $smarty->assign('custom',      $custom);
    $smarty->assign('order',      $order);
    $smarty->assign('ur_here',     " &nbsp;&nbsp;&nbsp;&nbsp;海关关单".$custom['order_sn']);
    $smarty->assign('action_link', array('href'=>'custom_list.php?act=list', 'text' => '三单列表'));

    $smarty->display('custom_order_edit.htm');

}elseif ($_REQUEST['act'] == 'haiguansavecheck')
{

    $datas=haiguancheck($_POST);
    if($datas){
        echo json_encode(array("status"=>0,'message'=>implode("\r\n",$datas)));
        exit;
    }

}elseif ($_REQUEST['act'] == 'haiguansave')
{
    $cusid = empty($_REQUEST['cusid']) ? 0 : intval($_REQUEST['cusid']);
    if(!$cusid){
         sys_msg("请选择关单", 1, array(), false);
    }
    $sql="select * from ".$GLOBALS['ecs']->table('cuslist')." WHERE cusid='".$cusid."'";
    $custom=$GLOBALS['db']->getRow($sql);
    if(!$custom){
        sys_msg("请选择关单", 1, array(), false);    
    }
    
    $datas=haiguancheck($_POST);
    if($datas){
        sys_msg(implode("<br/>",$datas), 1, array(), false);    
        exit;
    }
    $order=$_POST['order'];
    $goodslist=$_POST['goodslist'];

    
    
}elseif ($_REQUEST['act'] == 'query')
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

}elseif ($_REQUEST['act'] == 'check')
{
    $data_order = array();    //初始化订单数据
    $data_goods = array();    //初始化商品数据
    $sql = 'SELECT '
            . 'o.*,'
            . 'a.region_name as province,'
            . 'b.region_name as city,'
            . 'c.region_name as district,'
            . 'u.customerid,'
            . 'ao.id'
            . ' FROM ' . $GLOBALS['ecs']->table('order_info') . ' o' .
            ' INNER JOIN ' . $GLOBALS['ecs']->table('users') . ' u ON o.user_id=u.user_id' .
            ' INNER JOIN ' . $GLOBALS['ecs']->table('region') . ' a ON o.province=a.region_id' .
            ' INNER JOIN ' . $GLOBALS['ecs']->table('region') . ' b ON o.city=b.region_id' .
            ' INNER JOIN ' . $GLOBALS['ecs']->table('region') . ' c ON o.district=c.region_id' .
            ' LEFT JOIN ' . $GLOBALS['ecs']->table('airport_order') . ' ao ON o.order_sn=ao.order_sn' .
            ' WHERE ao.order_sn IS NULL' .
            ' ORDER BY o.order_sn ASC';
    $data = $GLOBALS['db']->getAll($sql);

    if($data)
    {
        foreach($data as $key => $value)
        {
            $data_order['import_time'] = $_SERVER['REQUEST_TIME'];
            $data_order['order_sn'] = $value['order_sn'];
            $data_order['pay_time'] = $value['pay_time'];
            $data_order['order_amount'] = $value['money_paid']; // 总费用
            $data_order['goods_amount'] = $value['goods_amount']; // 货值
            $data_order['consignee'] = $value['consignee']; // 收货人名称
            $data_order['address'] = $value['province'] . $value['city'] . $value['district'] . $value['address']; // 收货人地址
            $data_order['mobile'] = $value['mobile']; // 收货人电话
            $data_order['consignee_idc'] = $value['customerid']; // 证件号码
            $data_order['paymentNo'] = $value['pay_number']; // 支付交易号
            $data_order['logisticsNo'] = $value['invoice_no']; // 物流运单号
            $data_order['order_addtime'] = $value['add_time']; // 订单提交时间
            $data_order['shipping_fee'] = $value['shipping_fee']; // 运费
            $data_order['taxfee'] = $value['tax']; // 进口行邮税

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

    $link[0]['text'] = '返回列表';
    $link[0]['href'] = 'custom_list.php';
    sys_msg('同步完成',0, $link);
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
    //进出境日期
    $jcbOrderTime = empty($_POST['jcbOrderTime']) ? local_date('Y-m-d',$_SERVER['REQUEST_TIME']) : trim($_POST['jcbOrderTime']);
    //目标口岸
    $target = empty($_POST['target']) ? 'airport' : trim($_POST['target']);
    //通关方式
    $billmode = intval($_POST['billmode']);
    
    //订单接口
    if ($_POST['operate'] == 'o2')
    {
        require_once ROOT_PATH . 'includes/modules/customs/airportOrder.php';
        $time = local_date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
        $num = 1;
        $airportOrder = new airportOrder($_CFG);
        foreach ($_POST['order'] as $v)
        {
            ++$num;
            $order = get_airport_info($v);

            /** ======================2.1进出口订单信息=========================== */
            switch ($order['st_stock_flag'])
            {
                case CUSTOMS_MODE_JIHUO:
//                    $airportOrder->SENDERUSERCOUNTRY = JIHUO_SEND_COUNTRY_CODE_CUS;
//                    $airportOrder->SENDERUSERNAME = JIHUO_SEND_NAME;
//                    $airportOrder->SENDERUSERADDRESS = JIHUO_SEND_ADDRESS;
//                    $airportOrder->SENDERUSERTELEPHONE = JIHUO_SEND_MOBILE;
//                    $airportOrder->TRADECOMPANY = JIHUO_TRADING_COUNTRY_CODE_CIQ;
//                    $airportOrder->COLLUSERCOUNTRYINSP = JIHUO_SEND_COUNTRY_CODE_CIQ;
                    break;
                default:
                case CUSTOMS_MODE_BEIHUO:
//                    $airportOrder->SENDERUSERCOUNTRY = BEIHUO_SEND_COUNTRY_CODE_CUS;
//                    $airportOrder->SENDERUSERNAME = BEIHUO_SEND_NAME;
//                    $airportOrder->SENDERUSERADDRESS = BEIHUO_SEND_ADDRESS;
//                    $airportOrder->SENDERUSERTELEPHONE = BEIHUO_SEND_MOBILE;
//                    $airportOrder->TRADECOMPANY = BEIHUO_TRADING_COUNTRY_CODE_CIQ;
//                    $airportOrder->COLLUSERCOUNTRYINSP = BEIHUO_SEND_COUNTRY_CODE_CIQ;
                    break;
            }

            $airportOrder->time = $time;
            $airportOrder->orderId = $v;
            $airportOrder->CUSTOMERID = $order['consignee_idc'];
            $airportOrder->NETWEIGHT = $order['netweight'];
            $airportOrder->PAYNUMBER = $order['paymentNo'];
            $airportOrder->COLLECTIONUSERADDRESS = $order['address'];
            $airportOrder->COLLECTIONUSERNAME = $order['consignee'];
            $airportOrder->COLLECTIONUSERTELEPHONE = $order['mobile'];
            $airportOrder->PURCHASERNAME = $airportOrder->COLLECTIONUSERNAME;
            $airportOrder->BUYER_REG_NO = $airportOrder->COLLECTIONUSERTELEPHONE;
            $airportOrder->PURCHASERTELEPHONE = $airportOrder->COLLECTIONUSERTELEPHONE;
            $airportOrder->IDTYPE = $order['idtype'];
            $airportOrder->GOODSVALUE = $order['goods_amount'];
            $airportOrder->ORDERID = $order['order_sn'];
            $airportOrder->ORDERSUM = $order['order_amount'];
            $airportOrder->SUBMITTIME = $order['order_addtime'];
            $airportOrder->WEIGHT = $order['weight'];
            $airportOrder->COUNTOFGOODSTYPE = $order['COUNTOFGOODSTYPE'];
            $airportOrder->BILLMODE = $billmode;
            $airportOrder->OTHERPAYMENT = $order['other'];
            $airportOrder->MODIFYMARK = $modifyMark;
            $airportOrder->send();
        }

        sys_msg('报文已生成');
    }
    //EMS运单接口
    if ($_POST['operate'] == 'o7')
    {
        require_once ROOT_PATH . 'includes/modules/customs/airportEMS.php';

        $airportEMS = new airportEMS();
        $airportEMS->orderIdArr = $_POST['order'];
        $airportEMS->JCBORDERTIME = $jcbOrderTime;
        $airportEMS->MODIFYMARK = $modifyMark;
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

        sys_msg('提交完成，请返回查看结果');
    }
    //支付报文接口
    if ($_POST['operate'] == 'o6')
    {
        require_once ROOT_PATH . 'includes/modules/customs/alipay.php';
        require_once ROOT_PATH . 'includes/modules/customs/wxpay.php';
        require_once ROOT_PATH . 'includes/lib_order.php';

        $alipayModel = new alipay();

        foreach ($_POST['order'] as $v)
        {
            $order = get_airport_info($v);
            $pay_source = get_order_pay_source($order['order_id']);
            switch ($order['pay_name'])
            {
                case '支付宝':
                default :
                    $alipayModel->out_request_no = $order['order_sn'];
                    $alipayModel->trade_no = $order['paymentNo'];
                    $alipayModel->amount = $order['order_amount'];
                    $alipayModel->send();
                    break;
            }
        }

        sys_msg('提交完成，请返回刷新查看结果');
    }
    if ($_POST['operate'] == 'batch_del')
    {
        $sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('airport_order') . ' WHERE ' . db_create_in($_POST['order'], 'id');
        $del_order = $GLOBALS['db']->query($sql);
        if (!$del_order)
        {
            messageGoBackJS('删除订单失败...');
        }
        messageGoBackJS('删除成功');
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


function haiguancheck($value){
        $errmsg=array();
        $order=$value['order'];
        $goodslist=$value['goodslist'];

        if($order){
            if(!$order["lmsno"]){
                $errmsg[]="订单总表:S账册号不能为空";
            }
            if(!$order["manualno"]){
                $errmsg[]="订单总表:关联H2010账册号不能为空";
            }
            /**
            if(!$order["license_no"]){
                $errmsg[]="订单总表:许可证号不能为空";
            }
            if(!$order["declaretype"]){
                $errmsg[]="订单总表:申报方式1： 货物申报 2： 物品申报不能为空";
            }
            **/
            if(!$order["cbecode"]){
                $errmsg[]="订单总表:电商代码不能为空";
            }
            
            if(!$order["cbename"]){
                $errmsg[]="订单总表:电商名称不能为空";
            }
            
            if(!$order["ecpcode"]){
                $errmsg[]="订单总表:电商平台代码不能为空";
            }
            /**
            if(!$order["ecpname"]){
                $errmsg[]="订单总表:电商平台名称不能为空";
            }
            **/
            if(!$order["collectionuseraddress"]){
                $errmsg[]="订单总表:收货人地址不能为空";
            }
            if(!$order["collectionusercountry"]){
                $errmsg[]="订单总表:收货人国家不能为空";
            }
            if(!$order["collectionusername"]){
                $errmsg[]="订单总表:收货人名称不能为空";
            }
            if(!$order["collectionusertelephone"]){
                $errmsg[]="订单总表:收货人电话不能为空";
            }
            if(!$order["goodsvalue"]){
                $errmsg[]="订单总表:订单实际销售价格不能为空";
            }
            if(!$order["orderid"]){
                $errmsg[]="订单总表:订单编号不能为空";
            }
            if(!$order["ordersum"]){
                $errmsg[]="订单总表:订单总价 总费用不能为空";
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
            **/
            if(!$order["senderusercountry"]){
                $errmsg[]="订单总表:发货人所在国不能为空";
            }
            if(!$order["senderusername"]){
                $errmsg[]="订单总表:发货人的名称不能为空";
            }
            if(!$order["senderuseraddress"]){
                $errmsg[]="订单总表:发货人的地址不能为空";
            }
            if(!$order["senderusertelephone"]){
                $errmsg[]="订单总表:发货人电话不能为空";
            }
            if(!$order["idtype"]){
                $errmsg[]="订单总表:证件类型不能为空";
            }
            if(!$order["customerid"]){
                $errmsg[]="订单总表:证件号码不能为空";
            }
            if(!$order["ietype"]){
                $errmsg[]="订单总表:进出口标志 I-进口；E-出口不能为空";
            }
            /**
            if(!$order["modifymark"]){
                $errmsg[]="订单总表:操作类型 1-新增；2-修改；3-删除不能为空";
            }
            **/
            if(!$order["billmode"]){
                $errmsg[]="订单总表:模式代码：1- 一般模式 ； 2- 保税模式不能为空";
            }
            if(!$order["wasterornot"]){
                $errmsg[]="订单总表:是否有废旧物品不能为空";
            }
            if(!$order["botanyornot"]){
                $errmsg[]="订单总表:是否带有植物性包装及铺垫材料不能为空";
            }
            /**
            if(!$order["taxedenterprise"]){
                $errmsg[]="订单总表:缴税单位不能为空";
            }
            **/
            if(!$order["cbecodeinsp"]){
                $errmsg[]="订单总表:电商检验检疫备案编号不能为空";
            }
            /**
            if(!$order["ecpcodeinsp"]){
                $errmsg[]="订单总表:电商平台检验检疫备案编号不能为空";
            }
            **/
            if(!$order["trepcodeinsp"]){
                $errmsg[]="订单总表:物流企业检验检疫备案编号不能为空";
            }
            if(!$order["submittime"]){
                $errmsg[]="订单总表:订单提交时间不能为空";
            }
            if(!$order["tradecompany"]){
                $errmsg[]="订单总表:贸易国别（代码）不能为空";
            }
            if(!$order["totalfeeunit"]){
                $errmsg[]="订单总表:总费用币制不能为空";
            }
            if(!$order["countofgoodstype"]){
                $errmsg[]="订单总表:商品种类数不能为空";
            }
            if(!$order["weight"]){
                $errmsg[]="订单总表:毛重不能为空";
            }
            if(!$order["weightunit"]){
                $errmsg[]="订单总表:毛重单位不能为空";
            }
            if(!$order["netweight"]){
                $errmsg[]="订单总表:净重不能为空";
            }
            if(!$order["netweightunit"]){
                $errmsg[]="订单总表:净重单位不能为空";
            }
            /**
            if(!$order["platformurl"]){
                $errmsg[]="订单总表:平台网址不能为空";
            }
            **/
            if(!$order["collusercountryinsp"]){
                $errmsg[]="订单总表:发货人所在国（检验检疫代码） 不能为空";
            }
            if(!$order["sendusercountryinsp"]){
                $errmsg[]="订单总表:收货人所在国（检验检疫代码） 不能为空";
            }
            if(!$order["paynumber"]){
                $errmsg[]="订单总表:支付交易号不能为空";
            }
            if(!$order["payenterprisecode"]){
                $errmsg[]="订单总表:支付企业代码不能为空";
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
            **/
            if(!$order["declcode"]){
                $errmsg[]="订单总表:报关企业海关备案编号不能为空";
            }
            /**
            if(!$order["declname"]){
                $errmsg[]="订单总表:报关企业名称不能为空";
            }
            **/
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
            **/
        }else{
                $errmsg[]="订单总表没有数据";
        }
        if($goodslist){
            foreach($goodslist as $key=>$goods){
                if(!$goods["gno"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:关联H2010项号不能为空";
                }
                if(!$goods["itemno"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:海关备案商品编号不能为空";
                }
                if(!$goods["shelfgoodsname"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:商品上架品名不能为空";
                }
                if(!$goods["describe"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:商品描述不能为空";
                }
                if(!$goods["goodid"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:商品货号不能为空";
                }
                if(!$goods["goodname"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:申报品名不能为空";
                }
                if(!$goods["specifications"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:规格型号不能为空";
                }
                if(!$goods["barcode"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]: HS编码不能为空";
                }
                if(!$goods["taxid"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:行邮税号不能为空";
                }
                if(!$goods["sourceproducercountry"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:原产国不能为空";
                }
                if(!$goods["coin"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:币制不能为空";
                }
                if(!$goods["unit"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:计量单位不能为空";
                }
                if(!$goods["amount"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:申报数量不能为空";
                }
                if(!$goods["goodprice"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:成交单价不能为空";
                }
                if(!$goods["ordersum"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:成交总价不能为空";
                }
                if(!$goods["flag"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:是否赠品 N:不是 Y:是不能为空";
                }
                if(!$goods["goodidinsp"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:检验检疫商品备案编号不能为空";
                }
                if(!$goods["orderid"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:订单编号不能为空";
                }
                if(!$goods["goodnameenglish"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:货物名称(英文)不能为空";
                }
                if(!$goods["weigth"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:毛重不能为空";
                }
                if(!$goods["weightunit"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:重量单位代码不能为空";
                }
                if(!$goods["packcategoryinsp"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:包装类型代码(检验检疫)不能为空";
                }
                if(!$goods["wasterornotinsp"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:废旧标识不能为空";
                }
                if(!$goods["remarksinsp"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:备注不能为空";
                }
                if(!$goods["coininsp"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:币制（检验检疫代码）不能为空";
                }
                if(!$goods["unitinsp"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:计量单位（检验检疫代码）不能为空";
                }
                if(!$goods["srccountryinsp"]){
                    $errmsg[]="商品[".$goods["goods_id"]."]:原产国（检验检疫代码）不能为空";
                }
            }
        }else{
            $errmsg[]="订单商品不能为空";
        }
        return $errmsg;
}

?>