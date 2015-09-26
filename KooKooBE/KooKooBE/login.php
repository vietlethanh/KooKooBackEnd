<?php

/* TODO: Add code here */
require('config/globalconfig.php');
include_once('class/model_user.php');

$objUser = new Model_User($objConnection);

$message = '';
if ($_pgR["act"] == Model_User::ACT_LOGIN)
{
	$userName = $_pgR['txtUserName'];
	$userName = html_entity_decode($userName,ENT_COMPAT ,'UTF-8' );
	$password = $_pgR['txtPassword'];
	$password = html_entity_decode($password,ENT_COMPAT ,'UTF-8' );
	$remember = $_pgR['ckRemember'];
	
	$result = $objUser->login($userName,$password);
	
	if ($result)
	{
		$_SESSION[global_common::SES_C_USERINFO] = $result;
		$curPage = $_SESSION[global_common::SES_C_CUR_PAGE];
		if($curPage)
		{
			global_common::redirect($curPage);
		}
		else
		{
			global_common::redirect("index.php");
		}
	}
	else
	{
		$message = 'Đăng nhập thất bại. Thông tin đăng nhập không hợp lệ.
				<br> Nếu quên mật khẩu hãy nhấn vào <a href="forgot_password.php">đây</a> để lấy lại mật khẩu ';
	}
}

?>

<?php

include_once('include/_header.inc');
include_once('include/_menu.inc');

$redirect = $_pgR["r"];
?>
<div id="login-page">
	<form method="POST" id="form-login"  class="form-horizontal">
<?php
if($redirect)
{
	
		?>
		<div class="row-fluid">
			<div class="span12 ">
				<div class="control-group">
					<div class="controls">
						<label class="m-wrap">Bạn chưa đăng nhập và không có quyền truy cập. <br>Nếu chưa có tài khoản xin vui lòng đăng ký theo link bên dưới,
						 hoặc liên hệ với ban quản trị</label>
					</div>
					
				</div>
			</div>
		</div>
	<?php
}
		?>
		<div class="row-fluid">
			<div class="span6 ">
				<div class="table-login">
					<div class="control-group">
						<div class="controls">
							<h1 class="m-wrap title"> Đăng nhập</h1>
						</div>
					</div>
<?php
if($message)
{
	echo '<div class="control-group input-error"><div class="controls"><div class="help-inline message">'.$message.'</div></div></div>';
}
					?>
					
					<div class="control-group">
						<label class="control-label">Tên đăng nhập</label>
						<div class="controls">
							<input type="text" name="txtUserName" id="txtUserName" class="text" maxlength="250" />
							<div class="help-block message"></div>		
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Mật khẩu</label>
						<div class="controls">
							<input type="password" name="txtPassword" id="txtPassword" class="text" maxlength="250" />
							<div class="help-block message"></div>	
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls">
							<a  href="forgot_password.php" name="btnForgot" id="btnForgot" class="link" >Quên mật khẩu?</a>
						</div>
					</div>
					<div class="control-group">
					
						<div class="controls">
							<label class="radio line m-wrap l-remember">
								<input type="checkbox" class="remember" name="ckRemember" id="ckRemember" value="1"/>
								Ghi nhớ?
							</label>
							<input type="submit" name="btnOK" id="btnOK" class="btn" value="Đăng nhập"/>
							
						</div>
					</div>
<?php
echo '<input type="hidden" name="act" id="act" value="'.Model_User::ACT_LOGIN.'"/>';
					?>
				</div>
			</div>
			<div class="span6" >
				<div class="table-register">					
					<h1 class="m-wrap title">Đăng ký tài khoản</h1>
					<ul class="promo-info">
						<li><i class=" icon-thumbs-up"></i>Đăng ký miễn phí đơn giản & nhanh chóng</li>
						<li><i class=" icon-thumbs-up"></i>Đăng tin khuyến mãi miễn phí</li>
						<li><i class=" icon-thumbs-up"></i>Đưa bài viết lên đầu trang 3 lần trong 1 ngày</li>
						<li><i class=" icon-thumbs-up"></i>Gửi phản hồi</li>
						<li><i class=" icon-thumbs-up"></i>Quản lý khuyến mãi</li>
					</ul>
					<div class="action-register">
						<a href="register.php" name="btnRegister" id="btnRegister" class="link" ><i class="icon-hand-right white"></i> Đăng ký Ngay</a>
					</div>				
				</div>
			</div>
		</div>
	</form>
</div>
<script language="javascript" type="text/javascript">
    $(document).ready(function () {
		core.util.getObjectByID("form-login").submit(function () {
                return user.login();	
            });
        core.util.getObjectByID("btnOK").click(function () {
               //user.login();
				//return false;
            });
    });
</script>
<?php 
//footer
include_once('include/_footer.inc');
?>
