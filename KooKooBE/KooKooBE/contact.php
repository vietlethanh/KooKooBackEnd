<?php

/* TODO: Add code here */
require('config/globalconfig.php');

?>

<?php

include_once('include/_header.inc');
include_once('include/_menu.inc');

$redirect = $_pgR["r"];
?>
<div id="login-page">
	<form method="POST" id="form-contact"  class="form-horizontal">
		<div class="row-fluid">
			<div class="span8 ">
				<div class="table-login" style="float:right; width:100%">
					<div class="control-group">
						<div class="controls">
							<h1 class="m-wrap title"> Liên hệ với chúng tôi</h1>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<label class="m-wrap">(*) là thông tin bắt buộc</label>
						</div>
					</div>				
					<div class="control-group">
						<label class="control-label">Họ tên (*)</label>
						<div class="controls">
							<input type="text" name="txtFullName" id="txtFullName" class="text" maxlength="250" style="width:400px" />
							<div class="help-block message"></div>		
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Email (*)</label>
						<div class="controls">
							<input type="text" name="txtEmail" id="txtEmail" class="text" maxlength="250" style="width:400px" />
							<div class="help-block message"></div>		
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Chủ đề (*)</label>
						<div class="controls">
							<input type="text" name="txtSubject" id="txtSubject" class="text" maxlength="250" style="width:400px"/>
							<div class="help-block message"></div>		
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Nội dung (*)</label>
						<div class="controls">
							<textarea name="txtContent" id="txtContent" rows="6" style="width:400px"></textarea>
							<div class="help-block message"></div>	
						</div>
					</div>
					<div class="control-group">
					
						<div class="controls">
							<input type="button" name="btnOK" id="btnOK" class="btn" value="Gửi" style="margin-left:340px"/>
							
						</div>
					</div>
				</div>
			</div>
			<div class="span4" >
				<div class="table-register">					
					<h1 class="m-wrap title">Thông tin công ty</h1>
					<ul class="promo-info">
						<li>TIMKM.vn</li>
						<li>Số Điện thoại: +084 94992 5616</li>
						<li>E-Mail: timkm.vn@gmail.com</li>
					</ul>
				</div>
			</div>
		</div>
	</form>
</div>
<script language="javascript" type="text/javascript">
    $(document).ready(function () {
		core.util.getObjectByID("form-contact").submit(function () {
                //return user.sendContactUs();
				
            });
        core.util.getObjectByID("btnOK").click(function () {
               user.sendContactUs();
			   return false;
            });
    });
</script>
<?php 
//footer
include_once('include/_footer.inc');
?>
