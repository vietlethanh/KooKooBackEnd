<?php

/* TODO: Add code here */
require('config/globalconfig.php');
include_once('include/_permission.inc');
include_once('class/model_user.php');
require_once('lib/ImageManipulator.php');
include_once('class/model_partner.php');


$objPartner = new Model_Partner($objConnection);
$objUser = new Model_User($objConnection);
$currentUser = $_SESSION[global_common::SES_C_USERINFO];
$currentPartner = $objPartner->getPartnerByUserID($currentUser[global_mapping::UserID]);
//print_r($currentPartner);
if($_pgR["update-avatar"])
{
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if ((($_FILES["file"]["type"] == "image/gif")
				|| ($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/jpg")
				|| ($_FILES["file"]["type"] == "image/pjpeg")
				|| ($_FILES["file"]["type"] == "image/x-png")
				|| ($_FILES["file"]["type"] == "image/png"))
			//&& ($_FILES["file"]["size"] > 20000)
			&& in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			global_common::writeLog($_FILES["file"]["error"]);
			//echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
			//if (file_exists("upload/" . $_FILES["file"]["name"]))
			//{
			
			$manipulator = new ImageManipulator($_FILES["file"]["tmp_name"]);
			// resizing to 200x200
			$manipulator->resample($_FILES["file"]["tmp_name"],$_FILES["file"]["type"], 200, 200);
			//echo "after";
			$fileName = global_common::FOLDER_AVATAR.$currentUser[global_mapping::UserID].'_'.$_FILES["file"]["name"];
			$userUpdate = $objUser->getUserByID($currentUser[global_mapping::UserID]);
			$userUpdate[global_mapping::Avatar]= $fileName;
			//echo $fileName;
			//echo $userUpdate[global_mapping::IsActive];
			$result=$objUser->update($userUpdate[global_mapping::UserID],$userUpdate[global_mapping::UserName],$userUpdate[global_mapping::Password],
					$userUpdate[global_mapping::FullName],$userUpdate[global_mapping::BirthDate],$userUpdate[global_mapping::Address],
					$userUpdate[global_mapping::Phone],$userUpdate[global_mapping::Email],$userUpdate[global_mapping::Sex],
					$userUpdate[global_mapping::Identity],$userUpdate[global_mapping::RoleID],$userUpdate[global_mapping::UserRankID],
					$userUpdate[global_mapping::Avatar],$userUpdate[global_mapping::AccountID],$userUpdate[global_mapping::IsActive]);
			//echo $result;
			$_SESSION[global_common::SES_C_USERINFO] = $currentUser = $userUpdate;
			move_uploaded_file($_FILES["file"]["tmp_name"],$fileName);
			
			//}
			//else
			//{
			//	move_uploaded_file($_FILES["file"]["tmp_name"],
			//			global_common::FOLDER_AVATAR  . $currentUser[global_mapping::UserID].$_FILES["file"]["name"]);
			//}
		}
	}
	else
	{
		global_common::writeLog("Invalid file");
		//echo "Invalid file";
	}
	//return;
}
?>

<?php
include_once('include/_header.inc');
include_once('include/_menu.inc');
//print_r($currentUser);
?>

<div id="profile-page" class="page-content">
	<div class="row-fluid">
		<div class="span12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
				Thông tin tài khoản
			</h3>
		</div>
	</div>
	  <div class="row-fluid">	
            <div class="span12">
                <div class="span3">
                    <ul class="menu-profile">
                        <li class="active">
							<a href="javascript:void(0)"><i class="icon-user"></i>Thông tin cá nhân </a><span class="after"></span>
						</li>
                        <li class="">
							<a href="profile_article.php"><i class="icon-file-text"></i>Chương trình khuyến mãi</a>
						</li>
                    </ul>
                </div>
                <div class="span9 tabbable tabbable-custom tabbable-full-width">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#general-info" data-toggle="tab">Tổng quát</a></li>
						<li class=""><a href="#change-avatar" data-toggle="tab">Thay đổi avatar</a></li>
						<li class=""><a href="#change-profile" data-toggle="tab">Thay đổi tài khoản</a></li>
						<li class=""><a href="#change-password" data-toggle="tab">Thay đổi mật khẩu</a></li>
                    </ul>
                    <div class="tab-content">
						<div id="general-info" class="tab-pane row-fluid active" >
                            <div class="span2">
                                <img src="<?php echo ($currentUser[global_mapping::Avatar])?>" alt="" />
                            </div>
							
                            <ul class="unstyled span10">
								<li><h1 style="font-size:20px">Thông tin cá nhân</h1></li>
                                <li><span>Tên đăng nhập:</span> <?php echo global_common::formatOutputText($currentUser[global_mapping::UserName])?></li>
                                <li><span>Họ và Tên:</span> <?php echo global_common::formatOutputText($currentUser[global_mapping::FullName])?></li>
								<li><span>Ngày sinh:</span> 
									<?php echo global_common::formatOutputText(global_common::formatDateVN($currentUser[global_mapping::BirthDate]))?></li>
                                <li><span>Giới tính:</span> <?php echo ($currentUser[global_mapping::Sex]?'Nam':'Nữ')?></li>
                                <li><span>Email:</span> <a href="mailto:">  <?php echo global_common::formatOutputText($currentUser[global_mapping::Email])?></a></li>
	   							<li><span>Số điện thoại:</span> <?php echo global_common::formatOutputText($currentUser[global_mapping::Phone])?></li>                               
                                <li><span>Địa chỉ:</span>  <?php echo global_common::formatOutputText($currentUser[global_mapping::Address])?></li>
                          
								<li><h2 style="font-size:20px">Thông tin đơn vị</h2></li>
                                <li><span>Tên:</span> <?php echo global_common::formatOutputText($currentPartner[global_mapping::Company])?></li>
	   							<li><span>Số điện thoại:</span> <?php echo  global_common::formatOutputText($currentPartner[global_mapping::Phone1])?></li>                               
                                <li><span>Địa chỉ:</span>  <?php echo global_common::formatOutputText($currentPartner[global_mapping::Address1])?></li>
                                <li><span>Website:</span>  <?php echo global_common::formatOutputText($currentPartner[global_mapping::Website1])?></li>
                            </ul>
                        </div>
						<div id="change-avatar" class="tab-pane row-fluid">
                                <form action=""  method="post" enctype="multipart/form-data" >
                                    <p>
                                       Hãy chọn hình làm đại diện trên hệ thống
                                    </p>
                                    <br />
                                   <div class="controls">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="<?php echo ($currentUser[global_mapping::Avatar])?>" alt="" />
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px;
                                                max-height: 150px; line-height: 20px;">
                                            </div>
                                            <div>
                                                <span class="btn btn-file"><span class="fileupload-new">Chọn avatar</span> <span
                                                    class="fileupload-exists">Chọn lại</span>
                                                    <input type="file" name="file" id="name" class="default" /></span> <a href="#" class="btn fileupload-exists"
                                                        data-dismiss="fileupload">Xóa</a>
                                            </div>
                                        </div>
                                        <!--span class="label label-important">Chú ý</span> <span>Attached image thumbnail is supported
                                            in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span-->
                                    </div>
									 <div class="submit-btn">
										<input type="hidden" name="update-avatar" id="update-avatar" value="1"/>
                                        <input type="submit" class="btn green" value="Lưu thay đổi">
										<input type="reset" class="btn" value="Hủy bỏ"/>
                                    </div>
								</form>
                        </div>
                        <div id="change-profile" class="tab-pane" >
							<div class="control-group">
								<div class="controls">
									<label class="m-wrap">(*) là thông tin bắt buộc</label>
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
									<h2 class="m-wrap title">Thông tin cá nhân</h2>
								</div>
							</div>
							<div class="control-group">    
								<label class="control-label">
									Họ và tên *</label>
								<div class="controls">
									<input type="text" name="txtFullname" id="txtFullname" class="text  m-wrap span8" maxlength="255" 
									value="<?php echo $currentUser[global_mapping::UserName] ?>" />
									<div class="help-inline message"></div>  
								</div>     
							</div>     
							<div class="control-group">                         
								<label class="control-label">
									Ngày sinh *</label>
								<div class="controls">
									<div class="input-append date date-picker text " data-date="<?php echo global_common::formatDateVN($currentUser[global_mapping::BirthDate])?>"  
									data-date-format="dd/mm/yyyy"  data-date-viewmode="days">
										<input name="txtBirthDate" id="txtBirthDate" class="m-wrap m-ctrl-medium date-picker" size="16" type="text" disabled
										value="<?php echo global_common::formatDateVN($currentUser[global_mapping::BirthDate])?>" placeholder="dd/mm/yyyy" />
											<span class="add-on"><i class="icon-calendar"></i></span>
									</div>
									<div class="help-inline message"></div>
								</div>
							</div>
							<div class="control-group">
								 <label class="control-label">
									Giới tính *</label>
								<div class="controls">
									<label class="radio " style="">
										<input type="radio" name="sex" id="rdMale" value="1" style="margin-left:0 !important;margin-right: 3px;"  
										<?php echo ($currentUser[global_mapping::Sex]?'checked="checked"':'')?> />
										 Nam
									</label>
									<label class="radio " style="">
										<input type="radio" name="sex" id="rdFemale" value="0"  style="margin-left:0 !important;margin-right: 3px;" 
										<?php echo ($currentUser[global_mapping::Sex]?'':'checked="checked"')?>  />
										 Nữ
									</label> 
									<div class="help-inline message"></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">
									Email *</label>
								<div class="controls">
									<div class="input-icon left inline">
										<i class="icon-envelope"></i>
										<input type="text" placeholder="Địa chỉ email"  name="txtEmail" id="txtEmail" class="text  m-wrap span8" 
										maxlength="255" value="<?php echo ($currentUser[global_mapping::Email])?>">    
									</div>
									<div class="help-inline message"></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">
									Số điện thoại </label>
								<div class="controls">
									<input type="text" name="txtPhone" id="txtPhone" placeholder="Vd: 01289 567 567" class="text m-wrap span8" 
									value="<?php echo $currentUser[global_mapping::Phone]?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Địa chỉ </label>
								<div class="controls">
									<input type="text" name="txtAddress" id="txtAddress" class="text m-wrap span8" maxlength="250" 
									placeholder="vd: 1A Trần Hưng Đạo, P. Bến Thành, Quận 1, HCM" value="<?php echo $currentUser[global_mapping::Address]?>" />
								</div>				
							</div>
							<div class="control-group">
								<div class="controls">
									<h2 class="m-wrap title">Thông tin đơn vị</h2>
								</div>
							</div>
							<div class="control-group">    
								<label class="control-label">
									Tên </label>
								<div class="controls">
									<input type="text" name="txtComanyName" id="txtComanyName" class="text  m-wrap span8" maxlength="255" 
									value="<?php echo $currentPartner[global_mapping::Company] ?>" />
									<div class="help-inline message"></div>  
								</div>     
							</div>  
							<div class="control-group">    
								<label class="control-label">
									Số điện thoại </label>
								<div class="controls">
									<input type="text" name="txtCompanyPhone" id="txtCompanyPhone" class="text  m-wrap span8" maxlength="255" placeholder="Vd: 01289 567 567" 
									value="<?php echo $currentPartner[global_mapping::Phone1] ?>" />
									<div class="help-inline message"></div>  
								</div>     
							</div>    
							<div class="control-group">    
								<label class="control-label">
									Địa chỉ </label>
								<div class="controls">
									<input type="text" name="txtComanyAddress" id="txtComanyAddress" class="text m-wrap span8" maxlength="255" 
									value="<?php echo $currentPartner[global_mapping::Address1] ?>" />
									<div class="help-inline message"></div>  
								</div>     
							</div>   
						
							<div class="control-group">    
								<label class="control-label">
									Website </label>
								<div class="controls">
									<input type="text" name="txtCompanyWebsite" id="txtCompanyWebsite" class="text  m-wrap span8" maxlength="255" 
									value="<?php echo $currentPartner[global_mapping::Website1] ?>" />
									<div class="help-inline message"></div>  
								</div>     
							</div>  
                            <div class="submit-btn">
                                <input type="button" onclick="javascript:user.updateProfile();" class="btn green" id="btnUpdateInfo" value="Lưu thay đổi" />
								<input type="reset" class="btn" value="Hủy bỏ"/>
                            </div>
                        </div>
                        
                        <div id="change-password" class="tab-pane">
                                <form action="#">
									<div class="control-group">
										<label class="control-label">
											Mật khẩu hiện tại</label>
										<div class="controls">
											<input type="password" id="txtCurrentPass" class="m-wrap span8" />
											<div class="help-inline message"></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">
											Mật khẩu mới</label>                                                                													
										<div class="controls">
											<input type="password" id="txtNewPass" class="m-wrap span8" name="password">
											<div class="help-inline message"></div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">
											Nhắc lại mật khẩu mới</label>
										<div class="controls">
										    <input type="password" id="txtConfirmPass" class="m-wrap span8" />
											<div class="help-inline message"></div>
										</div>
                                 	</div>
                                    <div class="submit-btn">
										<input type="button" onclick="javascript:user.changePassword();" class="btn green" id="btnChangePassword" 
											value="Lưu thay đổi" />
										<input type="reset" class="btn" value="Hủy bỏ"/>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
                <!--end span9-->
            </div>
        </div>
</div>
<script language="javascript" type="text/javascript">
    $(document).ready(function () {
       
    });
</script>
<?php 
//footer
include_once('include/_footer.inc');
?>
