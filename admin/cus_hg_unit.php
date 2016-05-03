<?php

/**
 * ECSHOP 海关计量单位代码表
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
admin_priv('cus_05_hg_unit');
/* act操作项的初始化 */
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
    /* 模板赋值 */
    $smarty->assign('ur_here',     $_LANG['cus_05_hg_unit']);
    $smarty->assign('action_link', array('text' => '添加单位', 'href' => 'cus_hg_unit.php?act=add'));
     $smarty->assign('full_page',   1);

    /* 获取单位数据 */
    $list = get_cus_hg_unit_list();

    $smarty->assign('unit_list',      $list['list']);
    $smarty->assign('filter',          $list['filter']);
    $smarty->assign('record_count',    $list['record_count']);
    $smarty->assign('page_count',      $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);

    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
    $smarty->display('cus_hg_unit_list.htm');
}
elseif ($_REQUEST['act'] == 'query')
{
    /* 获取单位数据 */
	$list = get_cus_hg_unit_list();
    $smarty->assign('unit_list',      $list['list']);
    $smarty->assign('filter',          $list['filter']);
    $smarty->assign('record_count',    $list['record_count']);
    $smarty->assign('page_count',      $list['page_count']);
    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);
    make_json_result($smarty->fetch('cus_hg_unit_list.htm'), '',array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
elseif ($_REQUEST['act'] == 'add')
{

    $smarty->assign('ur_here',     "添加单位");
    $smarty->assign('action_link', array('href'=>'cus_hg_unit.php?act=list', 'text' => $_LANG['cus_05_hg_unit']));
    $smarty->assign('action',      'add');
    $smarty->assign('form_act',    'insert');

    assign_query_info();
    $smarty->display('cus_hg_unit_info.htm');
}
elseif ($_REQUEST['act'] == 'insert')
{
	$unit_code  = (!empty($_POST['unit_code']))  ? sub_str(trim($_POST['unit_code']), 20, false) : '';
	$unit_name  = (!empty($_POST['unit_name']))  ? sub_str(trim($_POST['unit_name']), 100, false) : '';
	$conv_code  = (!empty($_POST['conv_code']))  ? sub_str(trim($_POST['conv_code']), 100, false) : '';
	$conv_ratio  = (!empty($_POST['conv_ratio']))  ? sub_str(trim($_POST['conv_ratio']), 100, false) : '';
	$def  = intval($_POST['def']);
	if($def){
		$def=1;
	}
    /* 插入数据 */
        $sql    = "INSERT INTO ".$ecs->table('cus_hg_unit')." (unit_code, unit_name, conv_code,conv_ratio,def) ".
                  "VALUES ('$unit_code', '$unit_name', '$conv_code','$conv_ratio', '$def')";
        $db->query($sql);
		$newid=$db->insert_id();
		if($def){
			$sql    = "UPDATE ".$ecs->table('cus_hg_unit')." set def='0' where id<>'".$newid."'";
			$db->query($sql);
		}
        /* 记录管理员操作 */
        admin_log($_POST['unit_code'], 'add', 'cus_05_hg_unit');

        /* 清除缓存 */
        clear_cache_files();

        /* 提示信息 */
        $link[0]['text'] = '继续添加';
        $link[0]['href'] = 'cus_hg_unit.php?act=add';

        $link[1]['text'] = '返回列表';
        $link[1]['href'] = 'cus_hg_unit.php?act=list';

        sys_msg($_LANG['add'] . "&nbsp;" .stripcslashes($_POST['unit_code']) . " " . $_LANG['attradd_succed'],0, $link);

}
elseif ($_REQUEST['act'] == 'remove')
{
    $id = intval($_GET['id']);

    $sql    = "DELETE FROM ".$ecs->table('cus_hg_unit')." WHERE(id='".$id."')";
    $db->query($sql);	
    clear_cache_files();
    admin_log('', 'remove', 'cus_05_hg_unit');

    $url = 'cus_hg_unit.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}elseif ($_REQUEST['act'] == 'edit')
{
    $sql = "SELECT * ".
           "FROM " .$ecs->table('cus_hg_unit'). " WHERE id = '".intval($_REQUEST['id'])."'";
    $unit = $db->getRow($sql);
   
    $smarty->assign('ur_here',     '编辑单位');
    $smarty->assign('action_link', array('href'=>'cus_hg_unit.php?act=list&' . list_link_postfix(), 'text' => $_LANG['cus_05_hg_unit']));
    $smarty->assign('form_act',    'update');
    $smarty->assign('action',      'edit');


    $smarty->assign('unit',    $unit);

    assign_query_info();
    $smarty->display('cus_hg_unit_info.htm');
}elseif ($_REQUEST['act'] == 'update')
{
    /* 变量初始化 */
    $id         = (!empty($_REQUEST['id']))      ? intval($_REQUEST['id'])      : 0;
	$unit_code  = (!empty($_POST['unit_code']))  ? sub_str(trim($_POST['unit_code']), 20, false) : '';
	$unit_name  = (!empty($_POST['unit_name']))  ? sub_str(trim($_POST['unit_name']), 100, false) : '';
	$conv_code  = (!empty($_POST['conv_code']))  ? sub_str(trim($_POST['conv_code']), 100, false) : '';
	$conv_ratio  = (!empty($_POST['conv_ratio']))  ? sub_str(trim($_POST['conv_ratio']), 100, false) : '';
	$def  = intval($_POST['def']);
	if($def){
		$def=1;
	}
    /* 插入数据 */
        $sql    = "UPDATE ".$ecs->table('cus_hg_unit')."set unit_code='".$unit_code."', unit_name='".$unit_name."', conv_code='".$conv_code."', conv_ratio='".$conv_ratio."',def='".$def."' where id='".$id."'";
        $db->query($sql);
		if($def){
			$sql    = "UPDATE ".$ecs->table('cus_hg_unit')." set def='0' where id<>'".$id."'";
			$db->query($sql);
		}
    admin_log($_POST['unit_code'], 'edit', 'cus_05_hg_unit');

    /* 清除缓存 */
    clear_cache_files();

    /* 提示信息 */
    $link[0]['text'] = $_LANG['back_list'];
    $link[0]['href'] = 'cus_hg_unit.php?act=list&' . list_link_postfix();

    sys_msg($_LANG['edit'] . "&nbsp;" .stripcslashes($_POST['unit_code']) . "&nbsp;" . $_LANG['attradd_succed'],0, $link);
}
function get_cus_hg_unit_list()
{
    $result = get_filter();
    if ($result === false)
    {
        $filter = array();

        $filter['unit_code'] = empty($_REQUEST['unit_code']) ? '' : trim($_REQUEST['unit_code']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['unit_code'] = json_str_iconv($filter['unit_code']);
        }
        $filter['unit_name'] = empty($_REQUEST['unit_name']) ? '' : trim($_REQUEST['unit_name']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['unit_name'] = json_str_iconv($filter['unit_name']);
        }
        $filter['conv_code'] = empty($_REQUEST['conv_code']) ? '' : trim($_REQUEST['conv_code']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['conv_code'] = json_str_iconv($filter['conv_code']);
        }
        $filter['conv_ratio'] = empty($_REQUEST['conv_ratio']) ? '' : trim($_REQUEST['conv_ratio']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['conv_ratio'] = json_str_iconv($filter['conv_ratio']);
        }
        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'def' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);

        $ex_where = ' WHERE 1 ';
        if ($filter['unit_code'])
        {
            $ex_where .= " AND unit_code LIKE '%" . mysql_like_quote($filter['unit_code']) ."%'";
        }
        if ($filter['unit_name'])
        {
            $ex_where .= " AND unit_name LIKE '%" . mysql_like_quote($filter['unit_name']) ."%'";
        }
        if ($filter['conv_code'])
        {
            $ex_where .= " AND conv_code LIKE '%" . mysql_like_quote($filter['conv_code']) ."%'";
        }
        if ($filter['conv_ratio'])
        {
            $ex_where .= " AND conv_ratio LIKE '%" . mysql_like_quote($filter['conv_ratio']) ."%'";
        }
        /* 获得总记录数据 */
        $sql = 'SELECT COUNT(*) FROM ' .$GLOBALS['ecs']->table('cus_hg_unit') .$ex_where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        $filter = page_and_size($filter);

        /* 获取数据 */
        $sql  = 'SELECT *'.
               ' FROM ' .$GLOBALS['ecs']->table('cus_hg_unit').$ex_where.
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
?>