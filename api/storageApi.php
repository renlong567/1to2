<?php

/**
 * @desc 小马过河仓储发货信息接口
 * @author RenLong
 * @date 2016-10-14
 */
define('IN_ECS', true);
require_once(dirname(__FILE__) . '/init.php');

if (!empty($_GET))
{
    ecs_header("Location:/admin/order.php?act=delivery_ship&code=xiaomaApi&{$_SERVER['QUERY_STRING']}\n");
}
exit();
