<?php
/* TODO: Add code here */
require('config/globalconfig.php');
include_once('class/model_article.php');
include_once('class/model_articletype.php');
include_once('class/model_store.php');
require_once __DIR__.'/lib/facebook/src/Facebook/autoload.php';
$objArticle = new Model_Article($objConnection);
$objArticleType = new Model_ArticleType($objConnection);
$objStore = new Model_Store($objConnection);



if ($_pgR["act"] == Model_Article::ACT_ADD || $_pgR["act"] == Model_Article::ACT_UPDATE)
{
	
	if (global_common::isCLogin())
	{
		//get user info
		$c_userInfo = $_SESSION[global_common::SES_C_USERINFO];
		//print_r($c_userInfo);
		//if ($objMenu->getMenuByName($_pgR['name'])) {
		//	echo global_common::convertToXML($arrHeader, array("rs",'info'), array(0,global_common::STRING_NAME_EXIST), array(0,1));
		//	return;
		//}
		//print_r($_pgR);
		$title = $_pgR[global_mapping::Title];
		$title = html_entity_decode($title,ENT_COMPAT ,'UTF-8' );
		$content = $_pgR[global_mapping::Content];
		//$content = html_entity_decode($content,ENT_COMPAT ,'UTF-8' );
		$tags = $_pgR[global_mapping::Tags];
		$tags = html_entity_decode($tags,ENT_COMPAT ,'UTF-8' );
		$catalogueID = $_pgR[global_mapping::CatalogueID];
		
		$sectionID = $_pgR[global_mapping::SectionID];
		
		$renewedNum = 0;
		$companyName = html_entity_decode($_pgR[global_mapping::CompanyName],ENT_COMPAT ,'UTF-8' );
		$companyAddress = html_entity_decode($_pgR[global_mapping::CompanyAddress],ENT_COMPAT ,'UTF-8' );
		$companyWebsite = html_entity_decode($_pgR[global_mapping::CompanyWebsite],ENT_COMPAT ,'UTF-8' );
		$companyPhone = html_entity_decode($_pgR[global_mapping::CompanyPhone],ENT_COMPAT ,'UTF-8' );
		$adType = html_entity_decode($_pgR[global_mapping::AdType],ENT_COMPAT ,'UTF-8' );
		$startDate = html_entity_decode($_pgR[global_mapping::StartDate],ENT_COMPAT ,'UTF-8' );
		$endDate = html_entity_decode($_pgR[global_mapping::EndDate],ENT_COMPAT ,'UTF-8' );
		$happyDays = html_entity_decode($_pgR[global_mapping::HappyDays],ENT_COMPAT ,'UTF-8' );
		$startHappyHour = html_entity_decode($_pgR[global_mapping::StartHappyHour],ENT_COMPAT ,'UTF-8' );
		$endHappyHour = html_entity_decode($_pgR[global_mapping::EndHappyHour],ENT_COMPAT ,'UTF-8' );
		$addresses = html_entity_decode($_pgR[global_mapping::Addresses],ENT_COMPAT ,'UTF-8' );
		$dictricts = html_entity_decode($_pgR[global_mapping::Dictricts],ENT_COMPAT ,'UTF-8' );
		$cities = html_entity_decode($_pgR[global_mapping::Cities],ENT_COMPAT ,'UTF-8' );
		$fileName = html_entity_decode($_pgR[global_mapping::FileName],ENT_COMPAT ,'UTF-8' );
		$status = 1;
		if($_pgR["act"] == model_Article::ACT_ADD)
		{
			$createdBy = $c_userInfo[global_mapping::UserID];
			
			$resultID = $objArticle->insert($title,$fileName, $content,null,$tags,$catalogueID,$createdBy,$renewedNum,$companyName,
					$companyAddress,$companyWebsite,$companyPhone,$adType,$startDate,$endDate,$happyDays,
					$startHappyHour,$endHappyHour, $addresses,$dictricts,$cities,$status);
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
			$articleID = html_entity_decode($_pgR[global_mapping::ArticleID],ENT_COMPAT ,'UTF-8' );
			$currentArticle = $objArticle->getArticleByID($articleID);
			$resultID = $objArticle->update($articleID,null,$title,$fileName,$catalogueID, $content,null,$tags,null,null,$currentArticle[global_mapping::CreatedBy],
					$currentArticle[global_mapping::CreatedDate],$modifiedBy,global_common::nowSQL(),null,null,0,null,null,
					$currentArticle[global_mapping::RenewedDate], $currentArticle[global_mapping::RenewedNum],
					$companyName,$companyAddress,$companyWebsite,$companyPhone,$adType,$startDate,$endDate,$happyDays,
					$startHappyHour,$endHappyHour, $addresses,$dictricts,$cities);
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
	}
	//else
	//{
	//	echo global_common::convertToXML($arrHeader, array("rs",'info'), array(0,global_common::STRING_REQUIRE_LOGIN), array(0,1));
	//}
	return;
}
if ($_pgR["act"] == model_Article::ACT_APPROVE )
{
	
	if (global_common::isCLogin())
	{
	   	$postID = $_pgR[global_mapping::fbpostid];
        $pageID = $_pgR[global_mapping::fbid];
        $existedArticle = $objArticle->getArticleByRefID($postID);
	   	if ($existedArticle)
		{
			$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
			echo global_common::convertToXML(
					$arrHeader, array("rs", "inf"), 
					array(1, 'Article was added before'), 
					array( 0, 1 )
					);
			return;
		}
        $accessToken= $_facebookToken;
        $fb = new Facebook\Facebook([
        'app_id' => $_facebookAppID,
        'app_secret' => $_facebookSecrect,
        'default_graph_version' => $_facebookVersion,
        'default_access_token'=>$accessToken
        ]);
       
        //echo $postID;
        //print_r($res);;
        //echo '<br>Data<br>';
        //echo '/'.$postID.'?fields=description,attachments';
        $response= $fb->get('/'.$postID.'?fields=message,description,attachments');
        //var_dump($response);
        $posts= $response->getGraphObject() ->asArray() ;
        //var_dump($posts);
        //echo $posts;
        // echo $posts['headers:protected'];
       // print_r($posts);
        //return;
		//get user info
		$c_userInfo = $_SESSION[global_common::SES_C_USERINFO];
		//print_r($c_userInfo);
		//if ($objMenu->getMenuByName($_pgR['name'])) {
		//	echo global_common::convertToXML($arrHeader, array("rs",'info'), array(0,global_common::STRING_NAME_EXIST), array(0,1));
		//	return;
		//}
		//print_r($_pgR);
        $content = $posts[global_mapping::fbmessage];
        $content = str_replace(array("\r\n", "\r", "\n"), '<br>', $content);
        //print_r($posts[global_mapping::fbattachments]);
        foreach($posts[global_mapping::fbattachments] as $item)
        {
            $content.= '<img src="'.$item[global_mapping::fbmedia][global_mapping::fbimage][global_mapping::fbsrc].'"/>';
        }
        
		$title =$posts[global_mapping::fbdescription];
		$title = html_entity_decode($title,ENT_COMPAT ,'UTF-8' );
		//$content = $posts[global_mapping::fbmessage];
		$content = html_entity_decode($content,ENT_COMPAT ,'UTF-8' );
        //echo $content;
		$tags = $_pgR[global_mapping::Tags];
		$tags = html_entity_decode($tags,ENT_COMPAT ,'UTF-8' );
		$catalogueID = $_pgR[global_mapping::CatalogueID];
		
		$sectionID = $_pgR[global_mapping::SectionID];
		
		$renewedNum = 0;
		$companyName = html_entity_decode($_pgR[global_mapping::CompanyName],ENT_COMPAT ,'UTF-8' );
		$companyAddress = html_entity_decode($_pgR[global_mapping::CompanyAddress],ENT_COMPAT ,'UTF-8' );
		$companyWebsite = html_entity_decode($_pgR[global_mapping::CompanyWebsite],ENT_COMPAT ,'UTF-8' );
		$companyPhone = html_entity_decode($_pgR[global_mapping::CompanyPhone],ENT_COMPAT ,'UTF-8' );
		$adType = html_entity_decode($_pgR[global_mapping::AdType],ENT_COMPAT ,'UTF-8' );
		$startDate = html_entity_decode($_pgR[global_mapping::StartDate],ENT_COMPAT ,'UTF-8' );
		$endDate = html_entity_decode($_pgR[global_mapping::EndDate],ENT_COMPAT ,'UTF-8' );
		$happyDays = html_entity_decode($_pgR[global_mapping::HappyDays],ENT_COMPAT ,'UTF-8' );
		$startHappyHour = html_entity_decode($_pgR[global_mapping::StartHappyHour],ENT_COMPAT ,'UTF-8' );
		$endHappyHour = html_entity_decode($_pgR[global_mapping::EndHappyHour],ENT_COMPAT ,'UTF-8' );
		$addresses = html_entity_decode($_pgR[global_mapping::Addresses],ENT_COMPAT ,'UTF-8' );
		$dictricts = html_entity_decode($_pgR[global_mapping::Dictricts],ENT_COMPAT ,'UTF-8' );
		$cities = html_entity_decode($_pgR[global_mapping::Cities],ENT_COMPAT ,'UTF-8' );
		$fileName = html_entity_decode($_pgR[global_mapping::FileName],ENT_COMPAT ,'UTF-8' );
		$status = 1;
        
		$createdBy = $c_userInfo[global_mapping::UserID];
		$arrCat = global_common::splitString($catalogueID);
        
        $stores = $objStore->getStoreByFBID($pageID);
        $arrStoreID = global_common::getArrayColumn($stores,global_mapping::StoreID);
		$resultID = $objArticle->insert($title,$fileName, $content,null,$tags,$arrCat,$createdBy,$renewedNum,$companyName,
				$companyAddress,$companyWebsite,$companyPhone,$adType,$startDate,$endDate,$happyDays,
				$startHappyHour,$endHappyHour, $addresses,$dictricts,$cities,$status,$arrStoreID,$postID);
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
	//else
	//{
	//	echo global_common::convertToXML($arrHeader, array("rs",'info'), array(0,global_common::STRING_REQUIRE_LOGIN), array(0,1));
	//}
	return;
}
elseif($_pgR['act'] == Model_ArticleType::ACT_GET_ALL)
{
	$types = $objArticleType->getAllArticleType(0);
	echo json_encode($types);
	return ;
}
elseif($_pgR['act'] == Model_Article::ACT_ACTIVE)
{
	$articleID = $_pgR['id'];
	$isActivate = $_pgR['isactivate'];
	$result = $objArticle->activeArticle($articleID,$isActivate);
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
elseif($_pgR['act'] == Model_Article::ACT_REFRESH)
{
	$articleID = $_pgR['id'];
	$c_userInfo = $_SESSION[global_common::SES_C_USERINFO];
	$result = $objArticle->refreshArticle($articleID,$c_userInfo);
	if ($result >=0 )
	{
		$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
		echo global_common::convertToXML(
				$arrHeader, array("rs", "inf"), 
				array(1, 'Bạn còn '.$result.' lần làm mới trong ngày'), 
				array( 0, 1 )
				);
		return;
	}
	else
	{
		echo global_common::convertToXML($arrHeader, array("rs","inf"), array(0,'Bạn đã sử dụng hết '.Model_Article::NUM_REFRESH.' lần làm mới trong ngày'), array(0,1));
		return;
	}
	
}
elseif($_pgR['act'] == model_Article::ACT_CHANGE_PAGE)
{
	$intPage = $_pgR['p'];
	
	$outPutHTML =  $objArticle->getListArticle($intPage);
	echo global_common::convertToXML($strMessageHeader, array('rs','inf'), array(1,$outPutHTML),array(0,1));
	return ;
}
elseif($_pgR['act'] == model_Article::ACT_SHOW_EDIT)
{
	
	$strArticleID = $_pgR['id'];
	$arrArticle =  $objArticle->getArticleByID($strArticleID);
	
	echo global_common::convertToXML($strMessageHeader, array('rs','ArticleID','Prefix','Title','FileName','ArticleType','Content','NotificationType','Tags','CatalogueID','SectionID','NumView','NumComment','Status','comments','RenewedDate','RenewedNum'), array(1,'ArticleID','Prefix','Title','FileName','ArticleType','Content','NotificationType','Tags','CatalogueID','SectionID','NumView','NumComment','Status','comments','RenewedDate','RenewedNum'),array(0,1,1,1,1,1,1,1,1,1,1,0,0,1,1,1,0));
	return ;
}
elseif ($_pgR["act"] == model_Article::ACT_GET)
{		
	$sectionID = $_pgR["sect"];
	$arrSection= $objMenu->getAllMenuBySection($sectionID);
	if($arrSection)
	{
		$strHTML = $objMenu->outputHTMLMenu($arrSection);
		echo global_common::convertToXML($arrHeader, array("rs", "inf"), 
				array(1, $strHTML), array(0, 1));
		return;	
	}
	else
	{
		echo global_common::convertToXML($arrHeader, array("rs",'inf'),array(0,'Kh?ng c? nh?m h?ng'),array(0,0));
		return ;
	}
}
elseif($_pgR['act'] == model_Article::ACT_DELETE)
{
	
	$IDName = "menu_id";
	$contentID = $_pgR["aid"];
	$strTableName = user_menu::TBL_T_MENU;
	$result = global_common::updateDeleteFlag($contentID,$IDName,$strTableName ,$_pgR["status"],$objConnection);
	if($result)
	{
		$IDName = "content_id";
		$strTableName = user_faq::TBL_T_FAQ;
		$result = global_common::updateDeleteFlag($contentID,$IDName,$strTableName ,$_pgR["status"],$objConnection);
	}
	$arrHeader = global_common::getMessageHeaderArr($banCode=0,0);
	$arrKey = array("rs","id");
	$arrValue = array($result?1:0,$contentID);
	$arrIsMetaData = array(0, 1);
	echo global_common::convertToXML($arrHeader, $arrKey, $arrValue, $arrIsMetaData);
	
	return;
}
?>