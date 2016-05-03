<?php

/**
 * ECSHOP 海关国家代码表
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
admin_priv('cus_03_hg_country');
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
    $smarty->assign('ur_here',     $_LANG['cus_03_hg_country']);
    $smarty->assign('action_link', array('text' => '添加国家', 'href' => 'cus_hg_country.php?act=add'));
     $smarty->assign('full_page',   1);

    /* 获取友情链接数据 */
    $list = get_cus_hg_country_list();

    $smarty->assign('country_list',      $list['list']);
    $smarty->assign('filter',          $list['filter']);
    $smarty->assign('record_count',    $list['record_count']);
    $smarty->assign('page_count',      $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);

    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
    $smarty->display('cus_hg_country_list.htm');
}
elseif ($_REQUEST['act'] == 'query')
{
    /* 获取友情链接数据 */
	$list = get_cus_hg_country_list();

    $smarty->assign('country_list',      $list['list']);
    $smarty->assign('filter',          $list['filter']);
    $smarty->assign('record_count',    $list['record_count']);
    $smarty->assign('page_count',      $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);

    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('cus_hg_country_list.htm'), '',array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
elseif ($_REQUEST['act'] == 'add')
{

    $smarty->assign('ur_here',     "添加国家");
    $smarty->assign('action_link', array('href'=>'cus_hg_country.php?act=list', 'text' => $_LANG['cus_03_hg_country']));
    $smarty->assign('action',      'add');
    $smarty->assign('form_act',    'insert');

    assign_query_info();
    $smarty->display('cus_hg_country_info.htm');
}
elseif ($_REQUEST['act'] == 'insert')
{
	$country_code  = (!empty($_POST['country_code']))  ? sub_str(trim($_POST['country_code']), 20, false) : '';
	$iso_e  = (!empty($_POST['iso_e']))  ? sub_str(trim($_POST['iso_e']), 40, false) : '';
	$coun_c_name  = (!empty($_POST['coun_c_name']))  ? sub_str(trim($_POST['coun_c_name']), 100, false) : '';
	$coun_e_name  = (!empty($_POST['coun_e_name']))  ? sub_str(trim($_POST['coun_e_name']), 100, false) : '';
	$def  = intval($_POST['def']);
	if($def){
		$def=1;
	}
    /* 插入数据 */
        $sql    = "INSERT INTO ".$ecs->table('cus_hg_country')." (country_code, iso_e, coun_c_name, coun_e_name,def) ".
                  "VALUES ('$country_code', '$iso_e', '$coun_c_name', '$coun_e_name', '$def')";
        $db->query($sql);
		$newid=$db->insert_id();
		if($def){
			$sql    = "UPDATE ".$ecs->table('cus_hg_country')." set def='0' where id<>'".$newid."'";
			$db->query($sql);
		}
        /* 记录管理员操作 */
        admin_log($_POST['country_code'], 'add', 'cus_03_hg_country');

        /* 清除缓存 */
        clear_cache_files();

        /* 提示信息 */
        $link[0]['text'] = '继续添加';
        $link[0]['href'] = 'cus_hg_country.php?act=add';

        $link[1]['text'] = '返回列表';
        $link[1]['href'] = 'cus_hg_country.php?act=list';

        sys_msg($_LANG['add'] . "&nbsp;" .stripcslashes($_POST['country_code']) . " " . $_LANG['attradd_succed'],0, $link);

}
elseif ($_REQUEST['act'] == 'remove')
{
    $id = intval($_GET['id']);

    $sql    = "DELETE FROM ".$ecs->table('cus_hg_country')." WHERE(id='".$id."')";
    $db->query($sql);	
    clear_cache_files();
    admin_log('', 'remove', 'cus_03_hg_country');

    $url = 'cus_hg_country.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}elseif ($_REQUEST['act'] == 'edit')
{
    $sql = "SELECT * ".
           "FROM " .$ecs->table('cus_hg_country'). " WHERE id = '".intval($_REQUEST['id'])."'";
    $country = $db->getRow($sql);
   
    $smarty->assign('ur_here',     '编辑国家');
    $smarty->assign('action_link', array('href'=>'cus_hg_country.php?act=list&' . list_link_postfix(), 'text' => $_LANG['cus_03_hg_country']));
    $smarty->assign('form_act',    'update');
    $smarty->assign('action',      'edit');


    $smarty->assign('country',    $country);

    assign_query_info();
    $smarty->display('cus_hg_country_info.htm');
}elseif ($_REQUEST['act'] == 'update')
{
    /* 变量初始化 */
    $id         = (!empty($_REQUEST['id']))      ? intval($_REQUEST['id'])      : 0;
	$country_code  = (!empty($_POST['country_code']))  ? sub_str(trim($_POST['country_code']), 20, false) : '';
	$iso_e  = (!empty($_POST['iso_e']))  ? sub_str(trim($_POST['iso_e']), 40, false) : '';
	$coun_c_name  = (!empty($_POST['coun_c_name']))  ? sub_str(trim($_POST['coun_c_name']), 100, false) : '';
	$coun_e_name  = (!empty($_POST['coun_e_name']))  ? sub_str(trim($_POST['coun_e_name']), 100, false) : '';
	$def  = intval($_POST['def']);
	if($def){
		$def=1;
	}
    /* 插入数据 */
        $sql    = "UPDATE ".$ecs->table('cus_hg_country')."set country_code='".$country_code."', iso_e='".$iso_e."', coun_c_name='".$coun_c_name."', coun_e_name='".$coun_e_name."',def='".$def."' where id='".$id."'";
        $db->query($sql);
		if($def){
			$sql    = "UPDATE ".$ecs->table('cus_hg_country')." set def='0' where id<>'".$id."'";
			$db->query($sql);
		}
    admin_log($_POST['country_code'], 'edit', 'cus_03_hg_country');

    /* 清除缓存 */
    clear_cache_files();

    /* 提示信息 */
    $link[0]['text'] = $_LANG['back_list'];
    $link[0]['href'] = 'cus_hg_country.php?act=list&' . list_link_postfix();

    sys_msg($_LANG['edit'] . "&nbsp;" .stripcslashes($_POST['country_code']) . "&nbsp;" . $_LANG['attradd_succed'],0, $link);
}
function get_cus_hg_country_list()
{
    $result = get_filter();
    if ($result === false)
    {
        $filter = array();

        $filter['coun_e_name'] = empty($_REQUEST['coun_e_name']) ? '' : trim($_REQUEST['coun_e_name']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['coun_e_name'] = json_str_iconv($filter['coun_e_name']);
        }
        $filter['iso_e'] = empty($_REQUEST['iso_e']) ? '' : trim($_REQUEST['iso_e']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['iso_e'] = json_str_iconv($filter['iso_e']);
        }
        $filter['coun_c_name'] = empty($_REQUEST['coun_c_name']) ? '' : trim($_REQUEST['coun_c_name']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['coun_c_name'] = json_str_iconv($filter['coun_c_name']);
        }
        $filter['country_code'] = empty($_REQUEST['country_code']) ? '' : trim($_REQUEST['country_code']);
        if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
        {
            $filter['country_code'] = json_str_iconv($filter['country_code']);
        }
        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'def' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);

        $ex_where = ' WHERE 1 ';
        if ($filter['iso_e'])
        {
            $ex_where .= " AND iso_e LIKE '%" . mysql_like_quote($filter['iso_e']) ."%'";
        }
        if ($filter['country_code'])
        {
            $ex_where .= " AND country_code LIKE '%" . mysql_like_quote($filter['country_code']) ."%'";
        }
        if ($filter['coun_c_name'])
        {
            $ex_where .= " AND coun_c_name LIKE '%" . mysql_like_quote($filter['coun_c_name']) ."%'";
        }
        if ($filter['coun_e_name'])
        {
            $ex_where .= " AND coun_e_name LIKE '%" . mysql_like_quote($filter['coun_e_name']) ."%'";
        }
        /* 获得总记录数据 */
        $sql = 'SELECT COUNT(*) FROM ' .$GLOBALS['ecs']->table('cus_hg_country') .$ex_where;
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        $filter = page_and_size($filter);

        /* 获取数据 */
        $sql  = 'SELECT *'.
               ' FROM ' .$GLOBALS['ecs']->table('cus_hg_country').$ex_where.
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