<?php
/* 連資料庫檢查 */
$wp_link=mysql_connect($xoopsModuleConfig['wpmu_ip'],$xoopsModuleConfig['wpmu_id'],$xoopsModuleConfig['wpmu_pass'],true);  //資料庫連線
mysql_query("SET NAMES 'utf8'");  //設定語系

//bind-address           = 127.0.0.1

if(empty($xoopsModule)){
  $modhandler = &xoops_gethandler('module');
  $xoopsModule = &$modhandler->getByDirname("wpmu");
}

$mid=$xoopsModule->getVar('mid');
if(empty($wp_link))redirect_header(XOOPS_URL."/modules/system/admin.php?fct=preferences&op=showmod&mod=$mid", 5, sprintf(_MD_WPMUBLOG_ERROR6,$xoopsModuleConfig['wpmu_ip'])."<div>mysql_connect({$xoopsModuleConfig['wpmu_ip']},{$xoopsModuleConfig['wpmu_id']},{$xoopsModuleConfig['wpmu_pass']})</div>");

define("_PICKED_DIR",XOOPS_ROOT_PATH."/uploads/wpmu");
define("_PICKED_URL",XOOPS_URL."/uploads/wpmu");
define("_WPMU_DB",$xoopsModuleConfig['wpmu_db']);
define("_WPMU_IP",$xoopsModuleConfig['wpmu_ip']);
define("_WPMU_ID",$xoopsModuleConfig['wpmu_id']);
define("_WPMU_PASS",$xoopsModuleConfig['wpmu_pass']);

//輸出為Big5
function to_Big5($str=""){
	if(_CHARSET=="Big5"){
   $str=iconv("UTF-8","Big5",$str);
	}
  return $str;
}
?>
