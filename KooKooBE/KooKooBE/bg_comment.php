<?php
/* TODO: Add code here */
require('config/globalconfig.php');
include_once('class/model_comment.php');
include_once('class/model_commentbad.php');
include_once('class/model_articletype.php');
include_once('class/model_article.php');
include_once('class/model_user.php');

$objComment = new Model_Comment($objConnection);
$objCommentBad = new Model_CommentBad($objConnection);
$objUser = new Model_User($objConnection);
$objArticle = new Model_Article($objConnection);
$objArticleType = new Model_ArticleType($objConnection);

if ($_pgR["act"] == model_Article::ACT_ADD || $_pgR["act"] == model_Article::ACT_UPDATE)
{
	
	if (global_common::isCLogin())
	{
		//get user info
		$c_userInfo = $_SESSION[global_common::SES_C_USERINFO];
		
		$articleid = $_pgR[global_mapping::ArticleID];
		$content = html_entity_decode($_pgR[global_mapping::Content],ENT_COMPAT ,'UTF-8' );
		$createdby = $c_userInfo[global_mapping::UserID];	
		$status = 1;
		
		if($_pgR["act"] == Model_Comment::ACT_ADD)
		{
			$createdBy = $c_userInfo[global_mapping::UserID];
			$resultID = $objComment->insert($articleid,$content,$createdby,$status);
			//echo global_common::convertToXML($arrHeader, array("rs","info"), array(0,$resultID), array(0,1));
			//return;
			if ($resultID)
			{
				$commentHTML = $objComment->getCommentHTMLByArticle($articleid);
				$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
				echo global_common::convertToXML(
						$arrHeader, array("rs", "inf","form"), 
						array(1, 'Gửi bình luận thành công',$commentHTML), 
						array( 0, 1, 1)
						);
				return;
			}
			else
			{
				echo global_common::convertToXML($arrHeader, array("rs","info"), array(0,"Input data is invalid"), array(0,1));
				return;
			}
		}
		else
		{
			$modifiedBy = $c_userInfo[global_mapping::UserID];
			$articleID = html_entity_decode($_pgR[global_mapping::ArticleID],ENT_COMPAT ,'UTF-8' );
			$currentArticle = $objArticle->getArticleByID($articleID);
			$resultID = $objArticle->update($articleID,null,$title,$fileName,$catalogueID, $content,null,$tags,null,null,$currentArticle[global_mapping::CreatedBy],
					$currentArticle[global_mapping::CreatedDate],$modifiedBy,global_common::nowSQL(),null,null,1,null,null,null,null,$companyName,
					$companyAddress,$companyWebsite,$companyPhone,$adType,$startDate,$endDate,$happyDays,
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
				echo global_common::convertToXML($arrHeader, array("rs","info"), array(0,"Input data is invalid"), array(0,1));
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
elseif($_pgR['act'] == Model_ArticleType::ACT_GET_ALL)
{
	$types = $objArticleType->getAllArticleType(0);
	echo json_encode($types);
	return ;
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

elseif($_pgR['act'] == Model_Comment::ACT_BAD_COMMENT)
{	
	if (global_common::isCLogin())
	{
		$c_userInfo = $_SESSION[global_common::SES_C_USERINFO];
		$commentID = $_pgR["id"];
		$isBad = $_pgR["isbad"];
		$strTableName = Model_CommentBad::TBL_SL_COMMENT_BAD;
		
		$comment = $objComment->getCommentByID($commentID);
		$user = $objUser->getUserByID($comment[global_mapping::CreatedBy]);
		
		if($user && $comment)
		{
			$isSent = true;
			$description = "Restore Comment";
			if($isBad)
			{
				$description = "Bad Comment";
				$userEmail = $user[global_mapping::Email];
				$fullName = $user[global_mapping::FullName];
				$linkArticle = global_common::getHostName().'/article_detail.php?aid='.$comment[global_mapping::ArticleID];
				$commentDate = global_common::formatDateTimeVN($comment[global_mapping::CreatedDate]);
				$commentContent = $comment[global_mapping::Content];
				$linkPolicy = global_common::getHostName().'/'.global_common::PAGE_TERM_KM;
				
				$arrMailContent = global_common::formatMailContent(global_common::TEAMPLATE_BAD_COMMENT,
						null, array(global_common::formatOutputText($fullName),$linkArticle, $commentDate,$commentContent, $linkPolicy));
				$emailSubject = $arrMailContent[0];
				$emailContent = $arrMailContent[1];
				
				$isSent = global_mail::send($userEmail,$fullName,$emailSubject,$emailContent,null,
						global_common::SUPPORT_MAIL_USERNAME,global_common::SUPPORT_MAIL_PASSWORD,
						global_common::SUPPORT_MAIL_DISPLAY_NAME);
			}
			if($isSent)
			{
				$badComment = $objCommentBad->getCommentBadByID($commentID);
				if(count($badComment) <= 0)
				{				
					$createdBy = $c_userInfo[global_mapping::UserID];
					$resultID = $objCommentBad->insert($commentID,$description, $createdBy,$isBad);
				}
				else
				{
					$updatedBy = $c_userInfo[global_mapping::UserID];
					$resultID = $objCommentBad->activateBadComment($commentID,$description, $updatedBy,$isBad);
				}
				
				if ($resultID)
				{				
					$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
					
					echo global_common::convertToXML(
							$arrHeader, array("rs", "inf","form"), 
							array(1, 'Xử lý bad comment thành công'), 
							array( 0, 1)
							);
					return;
				}
			}
		}
		
		echo global_common::convertToXML($arrHeader, array("rs","inf"), array(0,"Xử lý thất bại. Xin vui lòng thử lại sau."), array(0,1));
		return;
	}
	return;
}
?>