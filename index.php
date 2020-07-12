<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2010-04-16
// $Id:$
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = "wpmu_index_tpl.html";
/*-----------function區--------------*/


//部落格列表
function all_blog(){
	global $xoopsModuleConfig,$wp_link,$xoopsDB;

  $sql="select bosn,picked from ".$xoopsDB->prefix("wpmu_xoops")."";
  $result=$xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	while(list($bosn,$picked)=$xoopsDB->fetchRow($result)){
	  $blogs[$bosn]=$picked;
	}



	$sql="select blog_id from `wp_blogs` where public='1' and deleted='0'";
	$result=mysql_db_query($xoopsModuleConfig['wpmu_db'],$sql,$wp_link) or die($sql);
	$tbody="";
	while(list($blog_id)=mysql_fetch_row($result)){

		$sql2="select option_id,option_name,option_value from `wp_{$blog_id}_options` where option_id <10";
		$result2=mysql_db_query($xoopsModuleConfig['wpmu_db'],$sql2,$wp_link) or die($sql2);

		while(list($option_id,$option_name, $option_value)=mysql_fetch_row($result2)){
		  $option_value=to_Big5($option_value);

			//siteurl , blogname ,admin_email
		  $$option_name=$option_value;
		}

		$sql3="select a.ID,a.post_modified,a.post_title,b.display_name from `wp_{$blog_id}_posts` as a join wp_users as b on a.post_author=b.ID where a.post_type='post' and a.post_status='publish' order by a.post_modified desc limit 0,{$xoopsModuleConfig['wpmu_max_num']}";
		$result3=mysql_db_query($xoopsModuleConfig['wpmu_db'],$sql3,$wp_link) or die($sql3);
	  $content="";
		while(list($post_id,$post_modified,$post_title, $display_name)=mysql_fetch_row($result3)){
      $post_title=to_Big5($post_title);
      $display_name=to_Big5($display_name);
      $post_modified=substr($post_modified,0,10);
		  $content.="<div>{$post_modified} <a href='{$siteurl}?p=$post_id' target='_blank'>{$post_title}</a><span style='font-size:11px;color:#9999FF'> ({$display_name}) </span></div>";
		}

		$award=($blogs[$blog_id]=='1')?"<img src='images/award_star_gold_3.png' align='left'>":"";

		$pic_path=_PICKED_DIR."/{$blog_id}.png";
		$pic_url=_PICKED_URL."/{$blog_id}.png";
    $pic=(file_exists($pic_path))?"<img src='$pic_url'>":"<img src='images/pic.png'>";
    

		$tbody.="
		<tr>
		<td>{$pic}</td>
		<td>{$award}<a href='{$siteurl}'>{$blogname}</a><div><a href='{$siteurl}' style='font-size:12px;color:#FF6600'>{$siteurl}</a></div></td>
		<td style='font-size:12px;'>$content</td>
		</tr>";
	}

	$main="
	<table id='tbl' style='width:auto;margin:4px auto;' align='center'>
	  <thead>
	    <tr><th>"._MD_WPMUBLOG_GOOD_BLOG."</th><th>"._MD_WPMUBLOG_BLOG_NAME."</th><th>"._MD_WPMUBLOG_RECENT_POSTS."</th></tr>
	  </thead>
    <tbody>
    $tbody
    </tbody>
  </table>";

	return $main;
}


function add_count($bosn=""){
	global $xoopsDB,$xoopsUser;
	$sql="update ".$xoopsDB->prefix("wpmu_xoops")." set `counter`=`counter`+1 where bosn='{$bosn}'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, _MD_WPMUBLOG_ERROR5."<br>{$sql}");
}


/*-----------執行動作判斷區----------*/
$_REQUEST['op']=(empty($_REQUEST['op']))?"":$_REQUEST['op'];
switch($_REQUEST['op']){


	//新增計數器
	case "go":
	add_count($_GET['bosn']);
	header("location: ".$_GET['to']);
	break;
	

	default:
	$main=all_blog();
	break;

}

/*-----------秀出結果區--------------*/
include XOOPS_ROOT_PATH."/header.php";
echo "<link rel='stylesheet' type='text/css' media='screen' href='module.css' />";
echo toolbar($interface_menu);
echo $main ;
include_once XOOPS_ROOT_PATH.'/footer.php';

?>
