<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2010-04-16
// $Id:$
// ------------------------------------------------------------------------- //

//---基本設定---//
//模組名稱
$modversion['name'] = _MI_WPMUBLOG_NAME;
//模組版次
$modversion['version']	= '1.0';
//模組作者
$modversion['author'] = 'tad';
//模組說明
$modversion['description'] = _MI_WPMUBLOG_DESC;
//模組授權者
$modversion['credits']	= "tad";
//模組版權
$modversion['license']		= "GPL see LICENSE";
//模組是否為官方發佈1，非官方2
$modversion['official']		= 2;
//模組圖示
$modversion['image']		= "images/logo.png";
//模組目錄名稱
$modversion['dirname']		= "wpmu";

//---資料表架構---//
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][1] = "wpmu_xoops";

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

//---使用者主選單設定---//
$modversion['hasMain'] = 1;


//---樣板設定---//

$modversion['templates'][1]['file'] = 'wpmu_index_tpl.html';
$modversion['templates'][1]['description'] = _MI_WPMUBLOG_TEMPLATE_DESC1;
//---區塊設定---//
$modversion['blocks'][1]['file'] = "wpmu_block_1.php";
$modversion['blocks'][1]['name'] = _MI_WPMUBLOG_BNAME1;
$modversion['blocks'][1]['description'] = _MI_WPMUBLOG_BDESC1;
$modversion['blocks'][1]['show_func'] = "wpmu_b_show_1";
$modversion['blocks'][1]['template'] = "wpmu_block_1.html";
$modversion['blocks'][1]['edit_func'] = "wpmu_b_edit_1";
$modversion['blocks'][1]['options'] = "200|3|3|120";


// Options
$modversion['config'][1]['name'] = 'wpmu_ip';
$modversion['config'][1]['title'] = '_MI_WPMUBLOG_IP';
$modversion['config'][1]['description'] = '_MI_WPMUBLOG_IP_DESC';
$modversion['config'][1]['formtype'] = 'textbox';
$modversion['config'][1]['valuetype'] = 'text';
$modversion['config'][1]['default'] = "localhost";

$modversion['config'][2]['name'] = 'wpmu_id';
$modversion['config'][2]['title'] = '_MI_WPMUBLOG_ID';
$modversion['config'][2]['description'] = '_MI_WPMUBLOG_ID_DESC';
$modversion['config'][2]['formtype'] = 'textbox';
$modversion['config'][2]['valuetype'] = 'text';
$modversion['config'][2]['default'] = "root";


$modversion['config'][3]['name'] = 'wpmu_pass';
$modversion['config'][3]['title'] = '_MI_WPMUBLOG_PASS';
$modversion['config'][3]['description'] = '_MI_WPMUBLOG_PASS_DESC';
$modversion['config'][3]['formtype'] = 'textbox';
$modversion['config'][3]['valuetype'] = 'text';
$modversion['config'][3]['default'] = "";


$modversion['config'][4]['name'] = 'wpmu_db';
$modversion['config'][4]['title'] = '_MI_WPMUBLOG_DB';
$modversion['config'][4]['description'] = '_MI_WPMUBLOG_DB_DESC';
$modversion['config'][4]['formtype'] = 'textbox';
$modversion['config'][4]['valuetype'] = 'text';
$modversion['config'][4]['default'] = XOOPS_DB_NAME;


$modversion['config'][6]['name'] = 'wpmu_addr';
$modversion['config'][6]['title'] = '_MI_WPMUBLOG_ADDR';
$modversion['config'][6]['description'] = '_MI_WPMUBLOG_ADDR_DESC';
$modversion['config'][6]['formtype'] = 'textbox';
$modversion['config'][6]['valuetype'] = 'text';
$modversion['config'][6]['default'] = XOOPS_URL;

$modversion['config'][5]['name'] = 'wpmu_max_num';
$modversion['config'][5]['title'] = '_MI_WPMUBLOG_MAX_NUM';
$modversion['config'][5]['description'] = '_MI_WPMUBLOG_MAX_NUM_DESC';
$modversion['config'][5]['formtype'] = 'textbox';
$modversion['config'][5]['valuetype'] = 'text';
$modversion['config'][5]['default'] = '3';

?>
