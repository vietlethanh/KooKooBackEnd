<?php
include_once('class/model_advertising.php');
$objAdvertising = new Model_Advertising($objConnection);
//$parentID get from _left_side.inc
$condition = global_mapping::AdTypeID.'=\'3\' and '.global_mapping::ArticleTypeID.'=\''.$parentID.'\'';
$allAds = $objAdvertising->getAllAdvertising(0,'',$condition,'');
foreach($allAds as $item)
{
	echo '<div class="advertise">';
	echo '<a href="'.$item[global_mapping::PreferLink].'" target="_blank"><img class="partner" src="'.$item[global_mapping::ImageLink].'" /></a>';
	echo '</div>';
}
?>	

