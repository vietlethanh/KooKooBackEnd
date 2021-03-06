<?php
/*
 * This file was automatically generated By Code Smith 
 * Modifications will be overwritten when code smith is run
 *
 * PLEASE DO NOT MAKE MODIFICATIONS TO THIS FILE
 * Date Created 5/6/2012
 *
 */

/// <summary>
/// Implementations of slarticles represent a Article
///
/// </summary>
chdir("..");
/* TODO: Add code here */
require('config/globalconfig.php');
require('include/_permission_admin.inc');
include_once('class/model_articletype.php');
include_once('class/model_article.php');
include_once('class/model_user.php');


$objArticleType = new model_ArticleType($objConnection);
$objArticle = new model_Article($objConnection);

$catID = $_pgR["cid"];
$page = $_pgR["p"]? $_pgR["p"]:1;
$inactive = $_pgR["inactive"];
$expired = $_pgR["expired"];
$allCats = $objArticleType->getAllArticleType(0,null,'ParentID=0',null);
if($catID == 0)
{
	$allCatIDs ='';
}
else
{
	$allSubCats = $objArticleType->getAllArticleType(0,null,'ParentID='.$catID,null);
	//print_r($allSubCats);
	if(count($allSubCats)<=0)
	{
		$allCatIDs = $catID;
	}
	else
	{
		$allCatIDs = global_common::getArrayColumn($allSubCats,global_mapping::ArticleTypeID);
	}
}
//print_r($allCatIDs);
if($expired)
{
	$condidtion = ' And '.global_mapping::EndDate.' < \''.global_common::nowDateSQL().'\'';
}
else
{
	$condidtion = ' And ('.global_mapping::EndDate.' >= \''.global_common::nowDateSQL().'\' OR '.global_mapping::EndDate.' is null )';
}
if($inactive =='true')
{
	$condidtion .= ' And `'.global_mapping::Status.'`=0';
}
else
{
	$condidtion .=  ' And `'.global_mapping::Status.'`=1';
}
$articles = $objArticle->searchArticle($page,$allCatIDs,'','',$condidtion,'',$total);

?>
<?php
$_SESSION[global_common::SES_C_CUR_PAGE] = "admin/admin_article.php";
include_once('include/_admin_header.inc');
?>
<script type="text/javascript" src="<?php echo $_objSystem->locateJs('user_article.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJs('user_articletype.js');?>"></script>
<div id="admin-article">
	<div class="row-fluid">
		<div class="span12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				Quản lý khuyến mãi
			</h3>
		</div>
	</div>
	 <div class="row-fluid">	
            <div class="span12">
	<div class="portlet box">
		<div class="portlet-title hide">
			<div class="caption">
				<!--i class="icon-reorder"></i-->
			</div>
			
			<div class="tools">                                
				<!--a href="#config-form" data-toggle="modal" class="config"></a-->
				<!--a href="javascript:;" class="reload" title="Reload"></a-->
			</div>
			<div class="actions">									
				
			</div>
		</div>
		<!---->
		<div class="portlet-body">
<form method="get" id="form-article" style="display: inline-flex">
<select class="" name="cid" id="cid" style="height:25px">
<option value="0" >ALL</option>
<?php
foreach($allCats as $item)
{
	$isSelect = false;
	//print_r($currentTypes);
	
	if($item[global_mapping::ArticleTypeID] == $catID)
	{
		$isSelect=true;
	}
	if($isSelect)
		echo '			<option selected="selected" value="'.$item[global_mapping::ArticleTypeID].'" >'.$item[global_mapping::ArticleTypeName].'</option>';
	else
		echo '			<option value="'.$item[global_mapping::ArticleTypeID].'" >'.$item[global_mapping::ArticleTypeName].'</option>';
}
?>		
</select>	
<label for="inactive" style="height:20px;color:black; margin: 0 0 0 10px">InActive: </label> <input type="checkbox" <?php echo ($inactive?'checked=checked':'') ?> name="inactive" id="inactive" value="true" />
<label for="expired" style="height:20px;color:black; margin: 0 0 0 10px">Expired: </label> <input type="checkbox" <?php echo ($expired?'checked=checked':'') ?> name="expired" id="expired" value="true" />
<input type="hidden"  name="p" id="p" value="<?php echo ($page) ?>" />
<input type="submit" value="Search" style="height:24px;margin:0 10px" onclick="$('#p').val(0)" />		
</form>		
<div style="float:right;color:black">
<?php echo 'Total:'. $total; ?>
</div>
<?php
//print_r($articles);
if($articles)
{
	echo '<table class="table table-striped">';
	echo '<thead>';
	echo '<th>';
	echo 'Tên khuyến mãi';		
	echo '</th>';
	echo '<th>';
	echo 'Đơn vị kinh doanh';		
	echo '</th>';
	echo '<th>';
	echo 'Người tạo';		
	echo '</th>';
	echo '<th>';
	echo 'Ngày bắt đầu';		
	echo '</th>';
	echo '<th>';
	echo 'Ngày kết thúc';		
	echo '</th>';
	echo '<th>';
	echo 'Ngày tạo';		
	echo '</th>';
	echo '<th>';
	echo 'Ngày cập nhật';		
	echo '</th>';
	echo '<th>';
	echo 'Action';		
	echo '</th>';
	echo '</thead>';
	foreach($articles as $item)
	{
		echo '<tr>';
		echo '<td>';
		echo $item[global_mapping::Title];		
		echo '</td>';
		echo '<td style="padding:0;width:200px">';
		echo $item[global_mapping::CompanyName];		
		echo '</td>';
		echo '<td style="">';
		echo $item[global_mapping::CreatedBy][global_mapping::UserName];		
		echo '</td>';
		echo '<td>';
		echo global_common::formatDateVN($item[global_mapping::StartDate]);		
		echo '</td>';
		echo '<td>';
		echo global_common::formatDateVN($item[global_mapping::EndDate]);		
		echo '</td>';
		echo '<td>';
		echo global_common::formatDateVN($item[global_mapping::CreatedDate]);		
		echo '</td>';
		echo '<td>';
		echo global_common::formatDateVN($item[global_mapping::ModifiedDate]);		
		echo '</td>';
		echo '<td style="padding:0;width:180px">';
		echo '<a href="../article_detail.php?aid='.$item[global_mapping::ArticleID].'" target="_blank" class="btn btn-mini"> View</a> ';	
		if(	!$item[global_mapping::Status])
		{
			echo '<a href="javascript:article.activeArticle(\''.$item[global_mapping::ArticleID].'\',1)" class="btn btn-mini">Active</a> ';	
		}
		else
		{
			echo '<a href="javascript:article.activeArticle(\''.$item[global_mapping::ArticleID].'\',0)" class="btn btn-mini">Deactive</a>';	
		}	
		echo '</td>';
		echo '</tr>';
	}
	echo '</table>';
	echo global_common::getPagingHTMLByNum($page,Model_Article::NUM_PER_PAGE,$total, "article.SearchAdmin");
}
?>
				</div>
					</div>
		</div>
	</div>
</div>
<?php
include_once('include/_admin_footer.inc');
?>
