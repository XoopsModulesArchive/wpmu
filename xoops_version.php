<?php
//  ------------------------------------------------------------------------ //
// ���Ҳե� tad �s�@
// �s�@����G2010-04-16
// $Id:$
// ------------------------------------------------------------------------- //

//---�򥻳]�w---//
//�ҲզW��
$modversion['name'] = _MI_WPMUBLOG_NAME;
//�Ҳժ���
$modversion['version']	= '1.0';
//�Ҳէ@��
$modversion['author'] = 'tad';
//�Ҳջ���
$modversion['description'] = _MI_WPMUBLOG_DESC;
//�Ҳձ��v��
$modversion['credits']	= "tad";
//�Ҳժ��v
$modversion['license']		= "GPL see LICENSE";
//�ҲլO�_���x��o�G1�A�D�x��2
$modversion['official']		= 2;
//�Ҳչϥ�
$modversion['image']		= "images/logo.png";
//�Ҳեؿ��W��
$modversion['dirname']		= "wpmu";

//---��ƪ�[�c---//
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][1] = "wpmu_xoops";

//---�޲z�����]�w---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

//---�ϥΪ̥D���]�w---//
$modversion['hasMain'] = 1;


//---�˪O�]�w---//

$modversion['templates'][1]['file'] = 'wpmu_index_tpl.html';
$modversion['templates'][1]['description'] = _MI_WPMUBLOG_TEMPLATE_DESC1;
//---�϶��]�w---//
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
