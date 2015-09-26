<?php
include_once('class/model_advertising.php');
$objAdvertising = new Model_Advertising($objConnection);
$condition = global_mapping::AdTypeID.'=\'1\' and '.global_mapping::ArticleTypeID.'=\''.$parentID.'\' and ('.global_mapping::IsDeleted.' =0 or '.global_mapping::IsDeleted.' is null)';
$allAds = $objAdvertising->getAllAdvertising(0,'',$condition,'');

?>	

<div id="right-slider" >
	<section class="slider">
		<div class="flexslider">
		  <ul class="slides">	
<?php

foreach($allAds as $item)
{
	echo '<li>';
	echo '	<a href="'.$item[global_mapping::PreferLink].'" target="_blank"><img src="'.$item[global_mapping::ImageLink].'" style="max-height:241px; max-width:642px" /></a>';
	echo '</li>';
	//echo '<div class="advertise">';
	//echo '<a href="'.$item[global_mapping::PreferLink].'" target="_blank"><img class="partner" src="'.$item[global_mapping::ImageLink].'" /></a>';
	//echo '</div>';
}
?>		
			
		  </ul>
		</div>
	</section>
</div>
<script type="text/javascript">
$(window).load(function(){
	$('.flexslider').flexslider({
		animation: "slide",
		prevText: "",
		nextText: "",
		start: function(slider){
		  $('body').removeClass('loading');
		}
	});
});
</script>
