<?php
if (!defined('IN_ECS'))
{
	die('Hacking attempt');
}

function load_cus($tablename='')
{
    $arr = array();
	if(!$tablename){
		return $arr;
	}
    $data = read_static_cache($tablename);
    if ($data === false)
    {
        $sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table($tablename) . ' WHERE id > 0 order by def desc,id asc';
        $res = $GLOBALS['db']->getAll($sql);

        foreach ($res AS $row)
        {
            $arr[$row['id']] = $row;
        }
        write_static_cache($tablename, $arr);
    }
    else
    {
        $arr = $data;
    }

    return $arr;
}








function Cus_Soap($address,$xml){
	$messages=array('status'=>'0','msg'=>'');
	if(!$address){
		$messages['msg']='地址不能为空';
		return $messages;
	}
	try {
		$client = new SoapClient($address);
		$param = array("arg0"=>$xml);
		$result = $client->__soapCall('receive',array('paramters'=>$param));
		$messages['msg']=$result;
		if($result=='SUCCESS'){
			$messages['status']='1';
		}
		return $messages;
	}catch(SOAPFault $e){
		$messages['msg']=$e;
		return $messages;
	}
}
?>