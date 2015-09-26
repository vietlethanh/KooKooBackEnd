<?php

/* TODO: Add code here */
require('config/globalconfig.php');
include_once('class/model_user.php');
include_once('class/model_resetpassword.php');

$objUser = new Model_User($objConnection);
$objReset = new Model_ResetPassword($objConnection);
if ($_pgR["id"] )
{
	global_common::clearSession();
	$resetID = $_pgR['id'];
	$resetID = html_entity_decode($resetID,ENT_COMPAT ,'UTF-8' );	
	$result = $objReset->checkResetPasswordByID($resetID);
	
}

?>

<?php
include_once('include/_header.inc');
include_once('include/_menu.inc');
?>
<div id="forgot-page">
	<form method="POST" id='form-reset' class="form-horizontal">
		<div class="table-forgot">
			<div class="control-group">
				<div class="controls">
					<h1 class="m-wrap title"> Thay đổi mật khẩu</h1>
				</div>
			</div>
<?php 
if($result)
{
			?>
			<div class="control-group">
				<label class="">Bạn vừa yêu cầu thay đổi mật khẩu. Xin hãy nhập mật khẩu mới phía dưới:</label>
			</div>
			<hr>
			<div class="error-summary"></div>
			<div class="control-group">
				<label class="control-label">Mật khẩu mới</label>
				<div class="controls">
					<input type="password" name="txtNewPass" id="txtNewPass" class="text" maxlength="250" />
					<div class="help-inline message"></div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Xác nhận mật khẩu</label>
				<div class="controls">
					<input type="password" name="txtConfirmPass" id="txtConfirmPass" class="text" maxlength="250" />
					<div class="help-inline message"></div>
				</div>
			</div>
			
			<div class="control-group">
				<div class="controls">
					<input type="hidden" name="reset-id" id="reset-id" value="<?php echo $resetID?>"/>
					<input type="button" name="btnChangePassword" id="btnChangePassword" class="btn" value="Cập nhật"/>
					<input type="button" name="btnClose" id="btnClose" class="btn gray" value="Thoát" onclick="core.util.goTo('login.php')"/>
				</div>
			</div>
	<?php 
}
else
{
		?>
		<div class="control-group">
				<label class="">Yêu cầu thay đổi mật khẩu đã hết hạn. Xin vui lòng nhấn vào <a href="forgot_password.php">đây</a> để yêu cầu thay đổi mật khẩu</label>
			</div>
			<div class="control-group">
				<div class="controls">
					<input type="button" name="btnClose" id="btnClose" class="btn gray" value="Thoát" onclick="core.util.goTo('login.php')"/>
				</div>
			</div>
	<?php
}
			?>
		</div>
	</form>
</div>
<script language="javascript" type="text/javascript">
   $(document).ready(function () {
		
			core.util.getObjectByID("btnChangePassword").click(function(){
				user.updateResetPassword();			
			});

			/*
			core.util.getObjectByID("form-reset").submit(function () {
                user.updateResetPassword();				
				return false;				
            });
			*/
    });
</script>
<?php 
//footer
include_once('include/_footer.inc');
?>
