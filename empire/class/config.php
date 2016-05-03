<?php
if(!defined('InEmpireBak'))
{
	exit();
}

//Database
$phome_db_ver="5.0";
$phome_db_server="qdm106277472.my3w.com";
$phome_db_port="";
$phome_db_username="qdm106277472";
$phome_db_password="cy8zzr0i63";
$phome_db_dbname="";
$baktbpre="";
$phome_db_char="utf8";

//USER
$set_username="admin";
$set_password="c76044300bd4011240261f8c7d5b190e";
$set_loginauth="";
$set_loginrnd="YFfd33mV2MrKwDenkecYWZETWgUwMV";
$set_outtime="60";
$set_loginkey="1";

//COOKIE
$phome_cookiedomain="";
$phome_cookiepath="/";
$phome_cookievarpre="ebak_";

//LANGUAGE
$langr=ReturnUseEbakLang();
$ebaklang=$langr['lang'];
$ebaklangchar=$langr['langchar'];

//BAK
$bakpath="bdata";
$bakzippath="zip";
$filechmod="1";
$phpsafemod="";
$php_outtime="1000";
$limittype="";
$canlistdb="";

//------------ SYSTEM ------------
HeaderIeChar();
?>