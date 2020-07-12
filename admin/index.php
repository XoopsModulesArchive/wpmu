<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2010-04-16
// $Id:$
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
include "../../../include/cp_header.php";
include "../function.php";

/*-----------function區--------------*/

//部落格列表
function all_blog(){
	global $xoopsModuleConfig,$wp_link,$xoopsModule,$xoopsDB;

  $mid=$xoopsModule->getVar('mid');
  
  $sql="select bosn,picked from ".$xoopsDB->prefix("wpmu_xoops")."";
  $result=$xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	while(list($bosn,$picked)=$xoopsDB->fetchRow($result)){
	  $blogs[$bosn]=$picked;
	  $old[]=$bosn;
	}

	$sql="select blog_id,deleted from `wp_blogs` where public='1'";
	$result=mysql_db_query($xoopsModuleConfig['wpmu_db'],$sql,$wp_link) or header("location: ".XOOPS_URL."/modules/system/admin.php?fct=preferences&op=showmod&mod=$mid");
	$tbody="";
	while(list($blog_id,$deleted)=mysql_fetch_row($result)){
	

		$sql2="select option_id,option_name,option_value from `wp_{$blog_id}_options` where option_id <10";
		$result2=mysql_db_query($xoopsModuleConfig['wpmu_db'],$sql2,$wp_link) or header("location: ".XOOPS_URL."/modules/system/admin.php?fct=preferences&op=showmod&mod=$mid");

		while(list($option_id,$option_name, $option_value)=mysql_fetch_row($result2)){
      $option_value=to_Big5($option_value);
			//siteurl , blogname ,admin_email
		  $$option_name=$option_value;
		}

		$sql3="select b.display_name from `wp_usermeta` as a join `wp_users` as b on a.user_id=b.ID where a.meta_key='primary_blog' and a.meta_value='{$blog_id}'";
		$result3=mysql_db_query($xoopsModuleConfig['wpmu_db'],$sql3,$wp_link) or header("location: ".XOOPS_URL."/modules/system/admin.php?fct=preferences&op=showmod&mod=$mid");

		list($display_name)=mysql_fetch_row($result3);
    $display_name=to_Big5($display_name);

		$selected=($blogs[$blog_id]=='1')?"selected":"";

		$pic_path=_PICKED_DIR."/{$blog_id}.png";
		$pic_url=_PICKED_URL."/{$blog_id}.png";
    $pic=(file_exists($pic_path))?"<img src='$pic_url'>":"";
    
    $aa=(in_array($blog_id,$old))?"update":"insert";

		if($deleted=='1' and !in_array($blog_id,$old)){
      continue;
		}

	  $del=($deleted=='1')?_MA_WPMUBLOG_NOT_FOUND:"";
    $opt=($deleted=='1')?"<option value='1' selected>"._MA_WPMUBLOG_DEL."</option>":"<option value='0'>"._MA_WPMUBLOG_NORMAL."</option>\n<option value='1' $selected>"._MA_WPMUBLOG_PICKED."</option>";
	  $aa=($deleted=='1')?"del":$aa;

		$tbody.="
		<tr>
		<td>
		<select name='{$aa}[$blog_id]'>
		$opt
		</select>

		</td>
		<td>$pic</td>
		<td><a href='{$siteurl}'>{$del}{$blogname}</a></td>
		<td><a href='{$siteurl}'>{$siteurl}</a></td>
		<td><a href='mailto:{$admin_email}'>{$display_name}</a></td>
		<td><input type='file' name='pic[$blog_id]'></td>
		</tr>";
	}

	$main="
	<form action='index.php' method='post' enctype='multipart/form-data'>
	<table id='tbl' style='width:auto;margin:3px auto;' align='center'>
	  <thead>
	    <tr><th>"._MA_WPMUBLOG_PICKED."</th><th colspan=2>"._MD_WPMUBLOG_BLOG_NAME."</th><th>"._MD_WPMUBLOG_BLOG_URL."</th><th>"._MD_WPMUBLOG_BLOG_ADMIN."</th><th>"._MD_WPMUBLOG_BLOG_UPLOAD."</th></tr>
	  </thead>
    <tbody>
    $tbody
    </tbody>
  </table>
  <div align='center'><input type='hidden' name='op' value='add_to_picked'><input type='submit' value='"._MA_WPMUBLOG_SAVE."'></div>
	</form>
	";

	return $main;
}



//加入精選
function add_to_picked(){
	global $xoopsDB;
	foreach($_POST['update'] as $bosn => $picked){
    $sql = "update ".$xoopsDB->prefix("wpmu_xoops")." set picked='$picked' where bosn='{$bosn}'";
    $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, _MA_WPMUBLOG_ERROR4."<br>{$sql}");
	}
	
	foreach($_POST['insert'] as $bosn => $picked){
    $sql = "insert into ".$xoopsDB->prefix("wpmu_xoops")." (bosn,counter,picked) values('$bosn','0','$picked')";
		$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, _MA_WPMUBLOG_ERROR4."<br>{$sql}");

	}
	
	foreach($_POST['del'] as $bosn => $picked){
    $sql = "delete from ".$xoopsDB->prefix("wpmu_xoops")." where bosn='$bosn'";
		$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, _MA_WPMUBLOG_ERROR4."<br>{$sql}");

	}
	upload_pic();
}


//上傳
function upload_pic(){
  global $xoopsDB;

  //引入上傳物件
  include_once "../class/upload/class.upload.php";

	//取消上傳時間限制
  set_time_limit(0);
  //設置上傳大小
  ini_set('memory_limit', '80M');

  $files = array();
  foreach ($_FILES['pic'] as $k => $l) {

    foreach ($l as $i => $v) {
      if (!array_key_exists($i, $files)){
        $files[$i] = array();
			}
      $files[$i][$k] = $v;

      $sn[$i] = $i;
    }
  }



  foreach($files as $i => $file){
  	//取得檔案
	  $file_handle = new upload($file,"zh_TW");
	  
	  if(empty($file['name']))continue;
    unlink(_PICKED_DIR."/{$sn[$i]}.png");

	  if ($file_handle->uploaded) {
      $file_handle->file_safe_name = false;
      $file_handle->file_overwrite = true;

			$file_handle->file_new_name_body = $sn[$i];
			$file_handle->file_new_name_ext = 'png';

      if($file_handle->image_src_x > 60){
	      $file_handle->image_resize         = true;
	      $file_handle->image_x              = 60;
	      $file_handle->image_ratio_y         = true;
      }
      $file_handle->image_convert = 'png';

      $file_handle->process(_PICKED_DIR);
      $file_handle->auto_create_dir = true;

			//上傳檔案
      if ($file_handle->processed) {
          $file_handle->clean();
      } else {
					redirect_header($_SERVER['PHP_SELF'],3, "Error:".$file_handle->error);
      }
		}

  }
}
/*-----------執行動作判斷區----------*/
$op = (!isset($_REQUEST['op']))? "main":$_REQUEST['op'];

switch($op){


	//加入精選
	case "add_to_picked";
	add_to_picked();
	header("location: ".$_SERVER['PHP_SELF']);
	break;
	
	
	default:
	$main=all_blog();
	break;
}

/*-----------秀出結果區--------------*/
xoops_cp_header();
echo "<link rel='stylesheet' type='text/css' media='screen' href='../module.css' />";
echo menu_interface();
echo $main;
xoops_cp_footer();

?>
