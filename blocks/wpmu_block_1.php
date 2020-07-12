<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2010-04-16
// $Id:$
// ------------------------------------------------------------------------- //

//區塊編輯函式
function wpmu_b_edit_1($options){
	$form="
	"._MB_WPMUBLOG_BO_BLOG_B_EDIT_1_BITEM0."
	<INPUT type='text' name='options[0]' value='{$options[0]}'> px<br>
	"._MB_WPMUBLOG_BO_BLOG_B_EDIT_1_BITEM1."
	<INPUT type='text' name='options[1]' value='{$options[1]}'><br>
	"._MB_WPMUBLOG_BO_BLOG_B_EDIT_1_BITEM2."
	<INPUT type='text' name='options[2]' value='{$options[2]}'><br>
	"._MB_WPMUBLOG_BO_BLOG_B_EDIT_1_BITEM3."
	<INPUT type='text' name='options[3]' value='{$options[3]}'> px
	";
	return $form;
}



//區塊主函式 (部落格精選)
function wpmu_b_show_1($options){
	global $xoopsDB,$xoopsUser;
	
	$modhandler = &xoops_gethandler('module');
  $xoopsModule = &$modhandler->getByDirname("wpmu");
  $config_handler =& xoops_gethandler('config');
  $xoopsModuleConfig =& $config_handler->getConfigsByCat(0, $xoopsModule->getVar('mid'));
  
	include_once XOOPS_ROOT_PATH."/modules/wpmu/wp_link.php";

  $sql = "select bosn,counter	from ".$xoopsDB->prefix("wpmu_xoops")."	where picked='1'";
	//執行SQL語法
	$result = $xoopsDB->query($sql) or die($sql);
	while(list($bosn,$counter)=$xoopsDB->fetchRow($result)) {

	  $sql2="select option_id,option_name,option_value from `wp_{$bosn}_options` where option_id < 10";
		$result2=mysql_db_query($xoopsModuleConfig['wpmu_db'],$sql2,$wp_link) or die($sql2.mysql_error()."<p>");

		while(list($option_id,$option_name, $option_value)=mysql_fetch_row($result2)){
      $option_value=to_Big5($option_value);
			//siteurl , blogname ,admin_email
		  $$option_name=$option_value;
		}


		$pic_path=_PICKED_DIR."/{$bosn}.png";
		$pic_url=_PICKED_URL."/{$bosn}.png";
    $pic=(file_exists($pic_path))?"<img src='$pic_url'>":"";

    $url[$bosn]=$siteurl;
		$blogurl[$bosn]="<a href='".XOOPS_URL."/modules/wpmu/index.php?op=go&bosn={$bosn}&to=$siteurl' target='_blank'>".$blogname."</a>";
		$count[$bosn]=$counter;
		$blogpic[$bosn]=_PICKED_URL."/{$bosn}.png";
	}
	

	$n=$options[2];
	$m=$options[2]-1;
	
	//框內底色
	$ccc="#fbfbff";
	$block="
	<style type='text/css' media='screen,print'>
	/* wp_inset 3D Curved */
  .wp_inset {
  	background: transparent;
  	width: auto;
  	margin: 4px;
  }

  .wpmu_h1, .wp_inset p {
    margin:0px 10px;
    }
  h1.wpmu_h1 {
    float:left;
    padding:0px 2px 2px 2px;
    margin-top:0px;
  	margin-bottom: 6px;
  	border-bottom:1px dotted #cfcfcf;
  	overflow:hidden;
  	height:1em;
  	line-height:1em;
		width:{$options[0]}px;
    }
  .wpmu_h1 a{
  	font-size: 12pt;
  	color: #3366ff;
  	font-weight: bolder;
    text-decoration:none;
  }
	.wpmu_h1 a:hover{
		color: #ff0066;
		text-decoration: none;
	}


  .wp_inset p {
    padding-bottom:0.5em;
    }
  .wp_inset .b1, .wp_inset .b2, .wp_inset .b3, .wp_inset .b4, .wp_inset .b1b, .wp_inset .b2b, .wp_inset .b3b, .wp_inset .b4b {
    display:block;
    overflow:hidden;
    font-size:1px;
    }
  .wp_inset .b1, .wp_inset .b2, .wp_inset .b3, .wp_inset .b1b, .wp_inset .b2b, .wp_inset .b3b {
    height:1px;
    }
  .wp_inset .b2 {
    background:{$ccc};
    border-left:1px solid #999;
    border-right:1px solid #aaa;
    }
  .wp_inset .b3 {
    background:{$ccc};
    border-left:1px solid #999;
    border-right:1px solid #ddd;
    }
  .wp_inset .b4 {
    background:{$ccc};
    border-left:1px solid #999;
    border-right:1px solid #eee;
    }
  .wp_inset .b4b {
    background:{$ccc};
    border-left:1px solid #aaa;
    border-right:1px solid #fff;
    }
  .wp_inset .b3b {
    background:{$ccc};
    border-left:1px solid #ddd;
    border-right:1px solid #fff;
    }
  .wp_inset .b2b {
    background:{$ccc};
    border-left:1px solid #eee;
    border-right:1px solid #fff;
    }
  .wp_inset .b1 {
    margin:0 5px;
    background:#999;
    }
  .wp_inset .b2, .wp_inset .b2b {
    margin:0 3px;
    border-width:0 2px;
    }
  .wp_inset .b3, .wp_inset .b3b {
    margin:0 2px;
    }
  .wp_inset .b4, .wp_inset .b4b {
    height:2px; margin:0 1px;
    }
  .wp_inset .b1b {
    margin:0 5px;
    background:#fff;
    }
  .wp_inset .boxcontent {
  	height:100px;
    display:block;
    background:{$ccc};
    border-left:1px solid #999;
    border-right:1px solid #fff;
    padding:6px;
  	background-position: right bottom;
  	background-repeat: no-repeat;
  	background-image: url(".XOOPS_URL."/modules/wpmu/images/picked_bg.gif);
    }
    
    .wp_inset .author{
      text-align:right;
      color:#b7c558;
      font-size:9px;
      margin-bottom:3px;
    }

    .wp_inset .count{
    	display: inline;
    	float: right;
    	font-size: 10px;
    	color: #92e241;
    	vertical-align: top;
    }

    .wp_inset .pic{
      margin-right:6px;
      padding:3px;
      background-color:white;
      border:1px solid #e0e0e0;
    }
	</style>
  <table>";
	foreach($blogurl as $bosn=>$title){

		$sql3="select a.ID,a.post_modified,a.post_title,b.display_name from `wp_{$bosn}_posts` as a join wp_users as b on a.post_author=b.ID where a.post_type='post' and a.post_status='publish' order by a.post_modified desc limit 0,{$options[1]}";
		$result3=mysql_db_query(_WPMU_DB,$sql3,$wp_link) or die($sql3);
	  $content="";
		while(list($post_id,$post_modified,$post_title, $display_name)=mysql_fetch_row($result3)){
      $post_title=to_Big5($post_title);
      $display_name=to_Big5($display_name);
      $date=substr($post_modified,5,5);
		  $content.="<a href='{$url[$bosn]}?p=$post_id' target='_blank' style='width:{$options[3]}px;display:block;line-height:18px;height:18px;overflow:hidden;text-decoration:none;'>$date $post_title</a>";
		  $bosn_name[$bosn]=$display_name;
		}
	

		$tr=($n%$options[2]==0)?"<tr>":"";
		$tr2=($n%$options[2]==$m)?"</tr>":"";
		
		$pic=(!file_exists(_PICKED_DIR."/{$bosn}.png"))?XOOPS_URL."/modules/wpmu/images/pic.png":$blogpic[$bosn];
		
		$block.=$tr."<td>
    <div class='wp_inset'>
    <b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b>
    <div class='boxcontent'>
      <h1 class='wpmu_h1'>{$title}</h1>
      <div style='clear:both;'></div>
      <img src='{$pic}' align='left' class='pic'>
      <div style='font-size:12px;margin-top:3px;margin-bottom:4px;line-height:150%'>$content</div>
      <div class='author'>posted by {$bosn_name[$bosn]}</div>
      <div style='clear:both;'></div>
    </div>
    <b class='b4b'></b><b class='b3b'></b><b class='b2b'></b><b class='b1b'></b>
    </div>
		".$tr2;

    $n++;
  }
	$block.="</table>
	<div style='margin:10px 2px;font-size:12px;' align='right'> (<a href='".XOOPS_URL."/modules/wpmu/'>"._MB_WPMUBLOG_ALL."</a>) </div>";

  mysql_select_db(XOOPS_DB_NAME);
  
	return $block;
}


?>
