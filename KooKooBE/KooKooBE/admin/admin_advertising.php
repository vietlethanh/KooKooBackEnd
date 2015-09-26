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
/// Implementations of slAdvertising represent a Advertising
///
/// </summary>
chdir("..");
/* TODO: Add code here */
require('config/globalconfig.php');
require('include/_permission_admin.inc');
include_once('class/model_user.php');
include_once('class/model_advertising.php');
include_once('class/model_adtype.php');
include_once('class/model_articletype.php');

$objArticleType = new model_ArticleType($objConnection);
$objAdvertising = new Model_Advertising($objConnection);
$objAdType = new Model_AdType($objConnection);

if ($_pgR["act"] == Model_Advertising::ACT_ADD || $_pgR["act"] == Model_Advertising::ACT_UPDATE)
{
	//get user info
	$c_userInfo = $_SESSION[global_common::SES_C_USERINFO];
	
	$advertisingName = $_pgR[global_mapping::AdvertisingName];
	$advertisingName = html_entity_decode($advertisingName,ENT_COMPAT ,'UTF-8' );
	
	$adTypeID = html_entity_decode($_pgR[global_mapping::AdTypeID],ENT_COMPAT ,'UTF-8' );
	$articleTypeID = html_entity_decode($_pgR[global_mapping::ArticleTypeID],ENT_COMPAT ,'UTF-8' );
	$content = html_entity_decode($_pgR[global_mapping::Content],ENT_COMPAT ,'UTF-8' );
	$preferLink = html_entity_decode($_pgR[global_mapping::PreferLink],ENT_COMPAT ,'UTF-8' );
	$order = html_entity_decode($_pgR[global_mapping::Order],ENT_COMPAT ,'UTF-8' );
	$startDate = html_entity_decode($_pgR[global_mapping::StartDate],ENT_COMPAT ,'UTF-8' );
	$endDate = html_entity_decode($_pgR[global_mapping::EndDate],ENT_COMPAT ,'UTF-8' );
	$imageLink = html_entity_decode($_pgR[global_mapping::ImageLink],ENT_COMPAT ,'UTF-8' );
	$partnerID = html_entity_decode($_pgR[global_mapping::PartnerID],ENT_COMPAT ,'UTF-8' );
	$status = 1;
	if($_pgR["act"] == Model_Advertising::ACT_ADD)
	{
		$createdBy = $c_userInfo[global_mapping::UserID];
		
		$resultID = $objAdvertising->insert($advertisingName,$partnerID,$startDate,$endDate,$adTypeID,$articleTypeID,$content,$imageLink,$preferLink,$order,$createdBy,$status);
		if ($resultID)
		{
			$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
			echo global_common::convertToXML(
					$arrHeader, array("rs", "inf"), 
					array(1, 'Đăng bài viết thành công'), 
					array( 0, 1 )
					);
			return;
		}
		else
		{
			echo global_common::convertToXML($arrHeader, array("rs","inf"), array(0,"Input data is invalid"), array(0,1));
			return;
		}
	}
	else
	{
		$modifiedBy = $c_userInfo[global_mapping::UserID];
		$advertisingID = html_entity_decode($_pgR[global_mapping::AdvertisingID],ENT_COMPAT ,'UTF-8' );
		$currentAd = $objAdvertising->getAdvertisingByID($advertisingID);
		$resultID = $objAdvertising->update($advertisingID,$advertisingName,$partnerID,$startDate,$endDate,$adTypeID,$articleTypeID,$content,$imageLink,$preferLink,$order,
				$modifiedBy,global_common::nowSQL(),
				$currentAd[global_mapping::DeletedBy],$currentAd[global_mapping::DeletedDate],
				$currentAd[global_mapping::IsDeleted],$currentAd[global_mapping::Status]
				);
		if ($resultID)
		{
			$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
			echo global_common::convertToXML(
					$arrHeader, array("rs", "inf"), 
					array(1, 'Cập nhật thành công'), 
					array( 0, 1 )
					);
			return;
		}
		else
		{
			echo global_common::convertToXML($arrHeader, array("rs","inf"), array(0,"Input data is invalid"), array(0,1));
			return;
		}
	}
	return;
}
elseif($_pgR['act'] == Model_Advertising::ACT_SHOW_EDIT)
{
	
	$advertisingID = $_pgR['id'];
	$advertising =  $objAdvertising->getAdvertisingByID($advertisingID);
	if($advertising)
	{
		$advertising[global_mapping::StartDate] = global_common::formatDateVN($advertising[global_mapping::StartDate]);
		$advertising[global_mapping::EndDate] = global_common::formatDateVN($advertising[global_mapping::EndDate]);
		echo global_common::convertToXML($strMessageHeader, 
				array('rs','content'),array(1,json_encode($advertising)), array(0,1));
	}
	else
	{
		echo global_common::convertToXML($arrHeader, array("rs","inf"), array(0,"Data is invalid. Pleae try again later"), array(0,1));
	}
	
	return ;
}elseif($_pgR['act'] == Model_Advertising::ACT_ACTIVE)
{
	$adID = $_pgR['id'];
	$isActivate = $_pgR['isactivate'];
	$result = $objAdvertising->activeAdvertising($adID,$isActivate);
	if ($result)
	{
		$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
		echo global_common::convertToXML(
				$arrHeader, array("rs", "inf"), 
				array(1, ($isActivate?'Xóa':'Deactivate').' thành công'), 
				array( 0, 1 )
				);
		return;
	}
	else
	{
		echo global_common::convertToXML($arrHeader, array("rs","inf"), array(0,($isActivate?'Xóa':'Deactivate').' unsuccessfully'), array(0,1));
		return;
	}
	
}
$catID = $_pgR["cid"];
$adTypeID = $_pgR["tid"];
$deleted = $_pgR["deleted"];
$condition='';
if($catID)
{
	$condition .= global_mapping::ArticleTypeID .'='.$catID.'';
}

if($adTypeID)
{
	if($condition)
		$condition .= ' and '.global_mapping::AdTypeID .'='.$adTypeID;
	else
		$condition .= global_mapping::AdTypeID .'='.$adTypeID;
}
if($deleted)
{
	$condition .= ' And '.global_mapping::IsDeleted.'=1';
}
else
{
	$condition .= ' And ('.global_mapping::IsDeleted.'=0 or '.global_mapping::IsDeleted.' is null)';
}
$allAds = $objAdvertising->getAllAdvertising(0,null,$condition,null);

$allAdType = $objAdType->getAllAdType(0,null,null,null);
$allCats = $objArticleType->getAllArticleType(0,null,'ParentID=0',null);
?>
<?php
$_SESSION[global_common::SES_C_CUR_PAGE] = "admin/admin_advertising.php";
include_once('include/_admin_header.inc');
?>
<script type="text/javascript" src="<?php echo $_objSystem->locateJs('user_advertising.js');?>"></script>
<div id="admin-advertising">
	<div class="row-fluid">
		<div class="span12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				Manage Advertising
			</h3>
		</div>
	</div>
	
	 <div class="row-fluid">	
            <div class="span12">
				<input type="hidden" id="adddocmode" name="adddocmode" value="" />
				<input type="hidden" id="AdvertisingID" name="AdvertisingID" value="" />
			<a href='javascript:advertising.showPopupAdd("modal-add")' class="btn" title="Add new advertising"><i class="icon-plus"></i> Add New</a>
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
<select class="" name="tid" id="cid" style="height:25px">
	<option value="0" >ALL</option>
<?php
foreach($allAdType as $item)
{
	$isSelect = false;
	//print_r($currentTypes);
	
	if($item[global_mapping::AdTypeID] == $adTypeID)
	{
		$isSelect=true;
	}
	if($isSelect)
		echo '			<option selected="selected" value="'.$item[global_mapping::AdTypeID].'" >'.$item[global_mapping::AdTypeName].'</option>';
	else
		echo '			<option value="'.$item[global_mapping::AdTypeID].'" >'.$item[global_mapping::AdTypeName].'</option>';
}
?>	
</select>	
<label for="deleted" style="height:20px;color:black; margin: 0 0 0 10px">Deleted: </label> <input type="checkbox" <?php echo ($deleted?'checked=checked':'') ?> name="deleted" id="deleted" value="true" />
<input type="submit" value="Search" style="height:24px;margin:0 10px" />		
</form>		
									
<?php
//print_r($advertising);
if($allAds)
{
	echo '<table class="table table-striped">';
	echo '<thead>';
	echo '<th>';
	echo 'Ad Name';		
	echo '</th>';
	echo '<th>';
	echo 'Partner';		
	echo '</th>';
	echo '<th>';
	echo 'Type';		
	echo '</th>';
	echo '<th>';
	echo 'Order';		
	echo '</th>';
	echo '<th>';
	echo 'Image';		
	echo '</th>';
	echo '<th>';
	echo 'StartDate';		
	echo '</th>';
	echo '<th>';
	echo 'EndDate';		
	echo '</th>';
	echo '<th>';
	echo 'Action';		
	echo '</th>';
	echo '</thead>';
	foreach($allAds as $item)
	{
		echo '<tr>';
		echo '<td>';
		echo $item[global_mapping::AdvertisingName];		
		echo '</td>';
		echo '<td style="">';
		echo $item[global_mapping::PartnerID];		
		echo '</td>';
		echo '<td style="">';
		echo $item[global_mapping::AdTypeID];		
		echo '</td>';
		echo '<td style="">';
		echo $item[global_mapping::Order];		
		echo '</td>';
		echo '<td style="">';
		echo '<a href="'. $item[global_mapping::ImageLink].'" target="_blank"><img src= "'. $item[global_mapping::ImageLink].'" width="50" height="50"></a>';	
		echo '</td>';
		echo '<td>';
		echo global_common::formatDateVN($item[global_mapping::StartDate]);		
		echo '</td>';
		echo '<td>';
		echo global_common::formatDateVN($item[global_mapping::EndDate]);		
		echo '</td>';
		echo '<td style="padding:0;width:180px">';
		echo '<a href="javascript:advertising.showPopupEdit(\''.$item[global_mapping::AdvertisingID].'\',\'modal-add\')" class="btn btn-mini">Edit</a> ';	
		if(	!$item[global_mapping::IsDeleted])
		{
			echo '<a href="javascript:advertising.deleteRetailer(\''.$item[global_mapping::AdvertisingName].'\',\''.$item[global_mapping::AdvertisingID].'\',1)" class="btn btn-mini">Delete</a> ';	
		}
		else
		{
			echo '<a href="javascript:advertising.deleteRetailer(\''.$item[global_mapping::AdvertisingName].'\',\''.$item[global_mapping::AdvertisingID].'\',0)" class="btn btn-mini">Restore</a>';	
		}	
		echo '</td>';
		echo '</tr>';
	}
	echo '</table>';
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


<div id="modal-add" class="modal hide fade" tabindex="-1" data-width="800" data-keyboard="false"  aria-hidden="true" data-backdrop="static">
    <div class="modal-header">
        <!--button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        </button-->
        <h3 class="popup-title">Add new advertising
        </h3>
    </div>
    <div class="modal-body">
		
		 <!-- BEGIN FORM-->
        <form class="form-horizontal" action="#">
		<div class="control-group">
			<div class="controls">
				<!--label class="m-wrap">(*) là thông tin bắt buộc</label-->
			</div>
		</div>
        <div class="control-group">
            <label class="control-label">
                Name</label>
            <div class="controls">
                <input type="text" id="txtAdName" class="span5">
            </div>
        </div>
		 <div class="control-group">
            <label class="control-label">
                Advertising Type 
            </label>
            <div class="controls">
                <select tabindex="1" class="span5" id="cmAdType">
<?php
foreach($allAdType as $item)
{
	echo '			<option value="'.$item[global_mapping::AdTypeID].'" >'.$item[global_mapping::AdTypeName].'</option>';
	
}
?>
                </select>
            </div>
        </div>	
		<div class="control-group">
            <label class="control-label">
                Category Type 
            </label>
            <div class="controls">
                <select tabindex="1" class="span5" id="cmCatType">
<?php
foreach($allCats as $item)
{
	echo '			<option value="'.$item[global_mapping::ArticleTypeID].'" >'.$item[global_mapping::ArticleTypeName].'</option>';
	
}
?>
                </select>
            </div>
        </div>	
		<div class="control-group">
            <label class="control-label">
                Order </label>
            <div class="controls">
                <input type="text" id="txtOrder" class="span5">
            </div>
        </div>		
        <div class="control-group">
            <label class="control-label">
                Start Date </label>
            <div class="controls">
                	<div class="input-append date date-picker text " data-date="" readonly="readonly"  data-date-format="dd/mm/yyyy"  data-date-viewmode="days">
					<input name="txtStartDate" id="txtStartDate" disabled="disabled" class="m-wrap m-ctrl-medium date-picker"
					size="16" type="text" placeholder="dd/mm/yyyy" value=""/>
						<span class="add-on"><i class="icon-calendar"></i></span>
				</div>
            </div>
        </div>
		<div class="control-group">
            <label class="control-label">
                End Date </label>
            <div class="controls">
               	<div class="input-append date date-picker text " data-date="" readonly="readonly"  data-date-format="dd/mm/yyyy"  data-date-viewmode="days">
					<input name="txtEndDate" id="txtEndDate" disabled="disabled" class="m-wrap m-ctrl-medium date-picker"
					size="16" type="text" placeholder="dd/mm/yyyy" value=""/>
						<span class="add-on"><i class="icon-calendar"></i></span>
				</div>
            </div>
        </div>
		<div class="control-group">
            <label class="control-label">
                Image Link 
            </label>
            <div class="controls">
                 <input id="txtImageLink" type="text" class="span5">
            </div>
        </div>
		<div class="control-group">
            <label class="control-label">
                Prefer Link 
            </label>
            <div class="controls">
                 <input id="txtPreferLink" type="text" class="span5">
            </div>
        </div>
		<div class="control-group">
            <label class="control-label">
                Content </label>
            <div class="controls">
                <textarea  id="txtContent" class="span5" rows="3"></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">
                Partner Info </label>
            <div class="controls">
                <textarea  id="txtPartner" class="span5" rows="3"></textarea>
            </div>
        </div>
       
        </form>
        <!-- END FORM-->
	</div>
	 <div class="modal-footer">
		<div class="pull-right">
			<a href="javascript:advertising.addAdverting();" class="btn" id="btnSave">Save</a>
			<a href="javascript:;" class="btn btn-mini" data-dismiss="modal"   aria-hidden="true">Cancel</a>        
		</div>
		 <div class="controls pull-right">
			<label class="checkbox ckCreateOther">
				<div class="checker">
					<span class="">
						<input type="checkbox" value=""></span>
				</div>
				Create another
			</label>
		</div>
	</div>
</div>