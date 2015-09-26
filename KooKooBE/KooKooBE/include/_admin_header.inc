<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TimKM Dashboard</title>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('jquery-1.10.1.min.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('jquery-migrate-1.2.1.min.js');?>"></script>

<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('jquery-ui/jquery-ui-1.10.3.custom.min.css');?>">
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('jquery-ui/jquery-ui-1.10.3.custom.min.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('jquery-ui/components/jquery.ui.core.min.js');?>"></script>


<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('bootstrap/css/bootstrap.css');?>"/>
<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('font-awesome/css/font-awesome.min.css');?>"/>
<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('bootstrap/css/bootstrap-responsive.min.css');?>"/>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('bootstrap/js/bootstrap.min.js');?>"></script>

<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('modernizr.custom.24574.js');?>"></script>

<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('bootstrap-datepicker/js/bootstrap-datepicker.js');?>"></script>
<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('bootstrap-datepicker/css/datepicker.css');?>"/>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('bootstrap-daterangepicker/daterangepicker.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('bootstrap-daterangepicker/date.js');?>"></script>
<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('bootstrap-daterangepicker/daterangepicker.css');?>"/>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js');?>"></script>
<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('bootstrap-datetimepicker/css/datetimepicker.css');?>"/>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('bootstrap-timepicker/js/bootstrap-timepicker.js');?>"></script>
<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('bootstrap-timepicker/compiled/timepicker.css');?>"/>

<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('jquery-inputmask/jquery.inputmask.bundle.min.js');?>"></script>

<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('jquery-multi-select/css/multi-select-metro.css');?>"/>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('jquery-multi-select/js/jquery.multi-select.js');?>"></script>

<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('chosen-bootstrap/chosen/chosen.css');?>"/>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('chosen-bootstrap/chosen/chosen.jquery.min.js');?>"></script>

<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('bootstrap-fileupload/bootstrap-fileupload.css');?>"/>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('bootstrap-fileupload/bootstrap-fileupload.js');?>"></script>

<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('bootstrap-fileupload/bootstrap-fileupload.css');?>"/>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('bootstrap-fileupload/bootstrap-fileupload.js');?>"></script>

<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('data-tables/DT_bootstrap.css');?>"/>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('data-tables/jquery.dataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('data-tables/DT_bootstrap.js');?>"></script>

<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('FlexSlider/flexslider.css');?>">
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('FlexSlider/jquery.flexslider-min.js');?>"></script>

<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('ckeditor/ckeditor.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('ckeditor/adapters/jquery.js');?>"></script>

<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('bootstrap-modal/css/bootstrap-modal.css');?>">
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('bootstrap-modal/js/bootstrap-modal.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('bootstrap-modal/js/bootstrap-modalmanager.js');?>"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyD99k32UTA3js7a2aaSbAmJxwwO2K5QIpk&sensor=true"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('gmaps/gmaps.js');?>"></script>


<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('ckeditor/ckeditor.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJPlugin('ckeditor/adapters/jquery.js');?>"></script>

<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateJPlugin('theme/css/style.css');?>">

<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateCss('style.css');?>">

<link type="text/css" rel="stylesheet"  href="<?php echo $_objSystem->locateCss('ChromeSafariFix.css');?>">

<script type="text/javascript" src="<?php echo $_objSystem->locateJs('ajax.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJs('global_config.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJs('global_core.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJs('app.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJs('form-components.js');?>"></script>
<script type="text/javascript" src="<?php echo $_objSystem->locateJs('user_user.js');?>"></script>
</head>
<script>
		jQuery(document).ready(function() {
			// initiate layout and plugins
			App.init();
			FormComponents.init();
		});
	</script>
<?php

?>
<body >
<div id="admin" align="center" style="margin:0px 5px;">
    <!--div id="subcontent" -->
    <div id="admin-header" align="">
		<a class="menu" href="../index.php">TimKM</a>
		<a class="menu" href="admin_article.php">Manage Article</a>
		<a class="menu" href="admin_commentbad.php">Manage Comment</a>
		<a class="menu" href="admin_advertising.php">Manage Advertising</a>
        <a class="menu" href="admin_crawl.php">Crawl Data</a>
    </div>
	<div class="wrapper">		
       
       