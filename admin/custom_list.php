<?php
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
require(dirname(__FILE__) . '/includes/lib_cus.php');
admin_priv('cus_01_list');
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
    $smarty->assign('ur_here',     $_LANG['cus_01_list']);
    $smarty->assign('action_link', array('text' => '检测新的订单', 'href' => 'custom_list.php?act=check'));
	$smarty->assign('action_link2',array('href' => 'custom_list.php?act=ftp', 'text' => '检测平台反馈'));
     $smarty->assign('full_page',   1);

    /* 获取货币数据 */
    $list = get_custom_list();

    $smarty->assign('custom_list',      $list['list']);
    $smarty->assign('filter',          $list['filter']);
    $smarty->assign('record_count',    $list['record_count']);
    $smarty->assign('page_count',      $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);

    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
    $smarty->display('custom_list.htm');

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
	$list = get_custom_list();
    $smarty->assign('custom_list',      $list['list']);
    $smarty->assign('filter',          $list['filter']);
    $smarty->assign('record_count',    $list['record_count']);
    $smarty->assign('page_count',      $list['page_count']);
    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);
    make_json_result($smarty->fetch('custom_list.htm'), '',array('filter' => $list['filter'], 'page_count' => $list['page_count']));

}elseif ($_REQUEST['act'] == 'check')
{
	 $sql = "SELECT o.*,concat( IFNULL(p.region_name, ''), " ."'  ', IFNULL(t.region_name, ''), '  ', IFNULL(d.region_name, '')) AS region FROM " . $GLOBALS['ecs']->table('order_info') . " as o " .
		"LEFT JOIN " . $ecs->table('region') . " AS p ON o.province = p.region_id " .
		"LEFT JOIN " . $ecs->table('region') . " AS t ON o.city = t.region_id " .
		"LEFT JOIN " . $ecs->table('region') . " AS d ON o.district = d.region_id " .
		"WHERE o.order_id NOT IN (select order_id from ".$GLOBALS['ecs']->table('cuslist').") and (o.pay_status=2)";
		$rows = $GLOBALS['db']->getAll($sql);
	 if($rows){
		 foreach($rows as $row){
			$insert_sql="INSERT INTO ".$GLOBALS['ecs']->table('cuslist')." ( `order_sn`, `add_time`, `update_time`,  `order_id`,  `orderstatus`, `sendorderdate`, `paymentstatus`, `sendpaymentdate`, `shippingstatus`, `sendshippingdate`, `sendstatus`, `status`) values "."('".$row['order_sn']."','".gmtime()."','".gmtime()."','".$row['order_id']."','1','0','1','0','1','0','1','0')".";";
			$db->query($insert_sql); 
			$newid=$db->insert_id();
			$order_up=array(
				'cusid'=>$newid,
				'cbecode'=>$GLOBALS['_CFG']['cus_cbecode'],
				'cbename'=>$GLOBALS['_CFG']['cus_cbename'],
				'ecpcode'=>$GLOBALS['_CFG']['cus_ecpcode'],
				'ecpname'=>$GLOBALS['_CFG']['cus_ecpname'],
				'collectionuseraddress'=>$row['region'].' '.$row['address'],
				'collectionusercountry'=>'142',
				'collectionusername'=>$row['consignee'],
				'collectionusertelephone'=>$row['tel'],
				'goodsvalue'=>$row['goods_amount'],
				'orderid'=>$row['order_sn'],
				'order_id'=>$row['order_id'],
				'ordersum'=>$row['money_paid'],
				'freight'=>$row['shipping_fee'],
				'senderuseraddress'=>$GLOBALS['_CFG']['cus_senderuseraddress'],
				'senderusercountry'=>$GLOBALS['_CFG']['cus_senderusercountry'],
				'senderusername'=>$GLOBALS['_CFG']['cus_senderusername'],
				'senderusertelephone'=>$GLOBALS['_CFG']['cus_senderusertelephone'],
				'collusercountryinsp'=>$GLOBALS['_CFG']['cus_collusercountryinsp'],
				'sendusercountryinsp'=>$GLOBALS['_CFG']['cus_sendusercountryinsp'],
				'cbecodeinsp'=>$GLOBALS['_CFG']['cus_cbecodeinsp'],
				'trepcodeinsp'=>$GLOBALS['_CFG']['cus_trepcodeinsp'],
				'ecpcodeinsp'=>$GLOBALS['_CFG']['cus_ecpcodeinsp'],
				'payenterprisecode'=>$GLOBALS['_CFG']['cus_payenterprisecode'],
				'payenterprisename'=>$GLOBALS['_CFG']['cus_payenterprisename'],
				'totalfeeunit'=>$GLOBALS['_CFG']['cus_totalfeeunit'],

				'declcode'=>$GLOBALS['_CFG']['cus_declcode'],
				'declname'=>$GLOBALS['_CFG']['cus_declname'],
				'taxedenterprise'=>$GLOBALS['_CFG']['cus_taxedenterprise'],
					'tradecompany'=>$GLOBALS['_CFG']['cus_tradecompany'],
				'submittime'=>local_date($_CFG['time_format'],$row['confirm_time']),
				'weightunit'=>'035',
				'netweightunit'=>'035',
				'customerid'=>$row['customerid'],
				'idtype'=>"T0C001",
				'ietype'=>'I',
				'billmode'=>"2",
				'wasterornot'=>'N',
				'botanyornot'=>'N',
				'otherfee'=>'0.00',
				'taxfee'=>'0.00',
				'netweight'=>'1',
				'weight'=>'1.2',
				'otherpayment'=>'0.00',
				'depositorguarantee'=>'',
				'guaranteeno'=>'',
				'lmsno'=>$GLOBALS['_CFG']['cus_lmsno'],
				'manualno'=>$GLOBALS['_CFG']['cus_manualno'],
			);
			/**商品种类数**/
			$orderkey='';
			$ordervalue='';
			foreach($order_up as $key=>$value){
				if($orderkey){
					$orderkey=$orderkey.',`'.$key.'`';
				}else{
					$orderkey='`'.$key.'`';
				}
				if($ordervalue){
					$ordervalue=$ordervalue.",'".$value."'";
				}else{
					$ordervalue="'".$value."'";
				}
			}
			$ordersql="INSERT INTO ".$GLOBALS['ecs']->table('cuslist_order')." (".$orderkey.") values (".$ordervalue.")";
			$db->query($ordersql);
			

		 }

	 }

     $link[0]['text'] = '返回列表';
     $link[0]['href'] = 'custom_list.php';
	 sys_msg("同步完成",0, $link);
}


function get_custom_list()
{
    $result = get_filter();
    if ($result === false)
    {
        $filter = array();


        $filter['order_id'] = empty($_REQUEST['order_id']) ? '' : trim($_REQUEST['order_id']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['order_id'] = json_str_iconv($filter['order_id']);
        }

        $filter['order_sn'] = empty($_REQUEST['order_sn']) ? '' : trim($_REQUEST['order_sn']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['order_sn'] = json_str_iconv($filter['order_sn']);
        }

        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? ' cusid ' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? ' DESC ' : trim($_REQUEST['sort_order']);

        $ex_where = ' WHERE 1 ';

        if ($filter['order_id'])
        {
            $ex_where .= " AND order_id = '" . mysql_like_quote($filter['order_id']) ."'";
        }

        if ($filter['order_sn'])
        {
            $ex_where .= " AND order_sn LIKE '%" . mysql_like_quote($filter['order_sn']) ."%'";
        }

        /* 获得总记录数据 */
        $sql = 'SELECT COUNT(*) FROM ' .$GLOBALS['ecs']->table('cuslist') .$ex_where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        $filter = page_and_size($filter);

        /* 获取数据 */
        $sql  = 'SELECT *'.
               ' FROM ' .$GLOBALS['ecs']->table('cuslist').$ex_where.
                " ORDER by $filter[sort_by] $filter[sort_order]";

        set_filter($filter, $sql);
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
    }
    $res = $GLOBALS['db']->selectLimit($sql, $filter['page_size'], $filter['start']);

    $list = array();
    while ($rows = $GLOBALS['db']->fetchRow($res))
    {

        $list[] = $rows;
    }

    return array('list' => $list, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
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