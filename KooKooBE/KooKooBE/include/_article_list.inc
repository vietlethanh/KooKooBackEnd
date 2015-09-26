<?php
$objArticleType = new model_ArticleType($objConnection);
$objArticle = new model_Article($objConnection);

$catID = $_pgR['cid'];
//Just get from "article_list.php"
//$city = $_pgR['ct'];
//$district = $_pgR['ds'];
//$keyword =  $_pgR['kw'];

$allCats = $objArticleType->getAllArticleType(0,null,'ParentID='.$catID,null);
if(count($allCats)<=0)
{
	$allCatIDs = $catID;
}
else
{
	$allCatIDs = global_common::getArrayColumn($allCats,global_mapping::ArticleTypeID);
}
//print_r($allCats);

//print_r($allCatIDs);
$search = '';
if($city)
{
	$search = '`'.global_mapping::Cities.'` like \'%'.global_common::escape_mysql_string($city).'%\' ';
}
if($district)
{
	if($search)
	{
		$search .= ' and `'.global_mapping::Dictricts.'` like \'%'.global_common::escape_mysql_string($district).'%\' ';
	}
	else
	{
		$search .= '`'.global_mapping::Dictricts.'` like \'%'.global_common::escape_mysql_string($district).'%\' ';
	}
}

if($keyword)
{
	if($search)
	{
		$search .= ' and (`'.global_mapping::CompanyName.'` like \'%'.global_common::escape_mysql_string($keyword).'%\' or `'.global_mapping::Title.'` like \'%'.global_common::escape_mysql_string($keyword).'%\' or `'.global_mapping::Content.'` like \'%'.global_common::escape_mysql_string($keyword).'%\')' ;
	}
	else
	{
		$search .= '(`'.global_mapping::CompanyName.'` like \'%'.global_common::escape_mysql_string($keyword).'%\' or  `'.global_mapping::Title.'` like \'%'.global_common::escape_mysql_string($keyword).'%\' or `'.global_mapping::Content.'` like \'%'.global_common::escape_mysql_string($keyword).'%\')' ;
	}
}
$condidtion = '('. global_mapping::EndDate.' >= \''.global_common::nowDateSQL().'\' Or '.global_mapping::EndDate.' is null)';
$condidtion .= ' And `Status` = 1';

if($search)
{
	$condidtion .= ' And '.$search;
}

//echo $condidtion;

$articles = $objArticle->getTopArticleByType($allCatIDs,global_common::DEFAULT_TOP_ITEMS,null,$condidtion);
//print_r($articles);
?>
<style>
 

</style>
<div id="article-list">	
	<div id="articles">
<?php
foreach($articles as $item)
{
	$thumbnail = $item[global_mapping::FileName];
	if(!$thumbnail)
	{
		$thumbnail = '/images/150x150.gif';
	}
	echo '
			<div class="item">	
			<div class="info article-thumbnail">
			<a href="article_detail.php?aid='.$item[global_mapping::ArticleID].'" title="'.$item[global_mapping::Title].'"><img src="'.$thumbnail.'" /></a>
			</div>		
			<div class="info price"><a href="#">'.$item[global_mapping::AdType].'</a></div>
			<div class="info name">
			<a href="article_detail.php?aid='.$item[global_mapping::ArticleID].'">'.$item[global_mapping::CompanyName].'</a>
			</div>
			<div class="info artcile-title">'.$item[global_mapping::Title].'</div>
			<div class="info">Từ: '.global_common::formatDateVN($item[global_mapping::StartDate]).'</div>
			'.($item[global_mapping::EndDate]?('<div class="info">Đến: '.global_common::formatDateVN($item[global_mapping::EndDate]).'</div>'):'').'		
			</div>';
}
		?>	
	</div>
	<div id="advertises">
<?php 
//article
include_once('_advertises.inc');
		?>	
	</div>
</div>