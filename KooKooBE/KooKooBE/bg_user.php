<?php

/* TODO: Add code here */
require('config/globalconfig.php');
include_once('class/model_user.php');
include_once('class/model_resetpassword.php');
include_once('class/model_partner.php');

$objUser = new Model_User($objConnection);
$objReset = new Model_ResetPassword($objConnection);
$objPartner = new Model_Partner($objConnection);
//echo 'bg_user';
global_common::cors();
//echo '$_pgR';
//echo $_pgR['UserName'];
//print_r($_pgR);
//print_r($_REQUEST);
//print_r(file_get_contents("php://input"));
//$request_body= file_get_contents("php://input");
//  print_r($request_body);
//$_pgR = json_decode($request_body, true) ;
//print_r($_pgR);
//echo $_pgR["act"];
$request_body= file_get_contents("php://input");
//echo $request_body;
if($request_body && global_common::isJson($request_body))
{
    $_pgR = json_decode($request_body, true) ;
}
if ($_pgR["act"] == Model_User::ACT_REGISTER)
{
   
	//echo 'ACT_REGISTER';
	$userName = $_pgR['UserName'];
    //echo $userName;
	$userName = html_entity_decode($userName,ENT_COMPAT ,'UTF-8' );
	$password = $_pgR['Password'];
	$password = html_entity_decode($password,ENT_COMPAT ,'UTF-8' );
	
	$fullname = $_pgR['FullName'];
	$fullname = html_entity_decode($fullname,ENT_COMPAT ,'UTF-8' );
	$birthDate = $_pgR['BirthDate'];
	$birthDate = html_entity_decode($birthDate,ENT_COMPAT ,'UTF-8' );
	$email = $_pgR['Email'];
	$email = html_entity_decode($email,ENT_COMPAT ,'UTF-8' );
	$sex = $_pgR['Sex'];
	$sex = html_entity_decode($sex,ENT_COMPAT ,'UTF-8' );
	$externalID =  $_pgR['ExternalID'];
    $externalType =  $_pgR['ExternalType'];
	if($objUser->checkExistUserName($userName)){
		$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
		echo global_common::convertToXML(
				$arrHeader, array('rs', 'inf'), 
				array(2, 'Tên đăng nhập đã tồn tại'), 
				array( 0, 1 )
				);
		return;
	}
	if($objUser->checkExistEmail($email)){
		$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
		echo global_common::convertToXML(
				$arrHeader, array('rs', 'inf'), 
				array(3, 'Email đã tồn tại'), 
				array( 0, 1 )
				);
		return;
	}
	$resultID = $objUser->register($userName,$password,$fullname,$birthDate,$email,$sex,$externalID, $externalType);
	if ($resultID)
	{
		//login after register
		$result = $objUser->login($userName,$password);
		if ($result)
		{
			$_SESSION[global_common::SES_C_USERINFO] = $result;		
		}
		$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
		echo global_common::convertToXML(
				$arrHeader, array('rs', 'inf','rurl'), 
				array(1, 'Đăng ký thành công',$_SESSION[global_common::SES_C_CUR_PAGE]), 
				array( 0, 1,1 )
				);
		return;
	}
	else
	{
		echo global_common::convertToXML($arrHeader, array('rs','inf'), array(0,'Đăng ký thất bại'), array(0,1));
		return;
	}
}
else if ($_pgR["act"] == Model_User::ACT_UPDATE_PROFILE)
	{
		$fullname = $_pgR['fullname'];
		$fullname = html_entity_decode($fullname,ENT_COMPAT ,'UTF-8' );
		$birthDate = $_pgR['birthdate'];
		$birthDate = html_entity_decode($birthDate,ENT_COMPAT ,'UTF-8' );
		$email = $_pgR['email'];
		$email = html_entity_decode($email,ENT_COMPAT ,'UTF-8' );
		$sex = $_pgR['sex'];
		$sex = html_entity_decode($sex,ENT_COMPAT ,'UTF-8' );
		$phone = $_pgR['phone'];
		$phone = html_entity_decode($phone,ENT_COMPAT ,'UTF-8' );
		$address = $_pgR['address'];
		$address = html_entity_decode($address,ENT_COMPAT ,'UTF-8' );
		
		$companyName = html_entity_decode($_pgR['companyName'],ENT_COMPAT ,'UTF-8' );
		$companyAddress = html_entity_decode($_pgR['companyAddress'],ENT_COMPAT ,'UTF-8' );
		$companyPhone = html_entity_decode($_pgR['companyPhone'],ENT_COMPAT ,'UTF-8' );
		$companyWebsite = html_entity_decode($_pgR['companyWebsite'],ENT_COMPAT ,'UTF-8' );
		
		$currentUser = $_SESSION[global_common::SES_C_USERINFO];
		if($objUser->checkExistEmail($email,$currentUser[global_mapping::UserID])){
			$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
			echo global_common::convertToXML(
					$arrHeader, array('rs', 'inf'), 
					array(3, 'Email đã tồn tại'), 
					array( 0, 1 )
					);
			return;
		}
		$userUpdate = $objUser->getUserByID($currentUser[global_mapping::UserID]);
		$userUpdate[global_mapping::FullName] = $fullname;
		$userUpdate[global_mapping::BirthDate] = $birthDate;
		$userUpdate[global_mapping::Address] = $address;
		$userUpdate[global_mapping::Phone] = $phone;
		$userUpdate[global_mapping::Email] = $email;
		$userUpdate[global_mapping::Sex] = $sex;
		$result = $objUser->update($userUpdate[global_mapping::UserID],$userUpdate[global_mapping::UserName],$userUpdate[global_mapping::Password],
				$userUpdate[global_mapping::FullName],$userUpdate[global_mapping::BirthDate],$userUpdate[global_mapping::Address],
				$userUpdate[global_mapping::Phone],$userUpdate[global_mapping::Email],$userUpdate[global_mapping::Sex],
				$userUpdate[global_mapping::Identity],$userUpdate[global_mapping::RoleID],$userUpdate[global_mapping::UserRankID],
				$userUpdate[global_mapping::Avatar],$userUpdate[global_mapping::AccountID],$userUpdate[global_mapping::IsActive]);
		if ($result)
		{
			$_SESSION[global_common::SES_C_USERINFO] = $objUser->getUserByID($currentUser[global_mapping::UserID]);
			$curentPartner = $objPartner->getPartnerByUserID($currentUser[global_mapping::UserID]);
			//print_r($curentPartner);
			if($curentPartner != null)
			{
				//echo 'update:'.$curentPartner[global_mapping::PartnerID];
				$objPartner->update($curentPartner[global_mapping::PartnerID],$currentUser[global_mapping::UserID], 
						$companyName,$companyName,
						$companyAddress,null,$companyPhone,$companyWebsite,$currentUser[global_mapping::UserID]);
			}
			else
			{
				$objPartner->insert($currentUser[global_mapping::UserID], $companyName,$companyName,
						$companyAddress,null,$companyPhone,$companyWebsite,$currentUser[global_mapping::UserID]);
			}
			
			$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
			echo global_common::convertToXML(
					$arrHeader, array('rs', 'inf'), 
					array(1, 'Cập nhật thành công'), 
					array( 0, 1 )
					);
			return;
		}
		else
		{
			echo global_common::convertToXML($arrHeader, array('rs','inf'), array(0,'Cập nhật thất bại'), array(0,1));
			return;
		}
	}
	else if ($_pgR["act"] == Model_User::ACT_CHANGE_PASS)
		{
			$currentpass = $_pgR['currentpass'];
			$currentpass = html_entity_decode($currentpass,ENT_COMPAT ,'UTF-8' );
			$password = $_pgR['password'];
			$password = html_entity_decode($password,ENT_COMPAT ,'UTF-8' );
			$confirmpass = $_pgR['confirmpass'];
			$confirmpass = html_entity_decode($confirmpass,ENT_COMPAT ,'UTF-8' );
			if($password == $confirmpass)
			{
				$currentUser = $_SESSION[global_common::SES_C_USERINFO];
				$result = $objUser->changePassword($currentUser[global_mapping::UserID],$currentpass,$password);
				//echo $result;
				if ($result > 0)
				{
					$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
					echo global_common::convertToXML(
							$arrHeader, array('rs', 'inf'), 
							array(1, 'Cập nhật thành công'), 
							array( 0, 1 )
							);
					return;
				}
				else if($result == 0 )
					{
						echo global_common::convertToXML($arrHeader, array('rs','inf'), array(0,'Mật khẩu không đúng'), array(0,1));
						return;
					}
					else
					{
						echo global_common::convertToXML($arrHeader, array('rs','inf'), array(0,'Cập nhật thất bại. Xin vui lòng thử lại sau!'), array(0,1));
						return;
					}
			}
			else
			{
				echo global_common::convertToXML($arrHeader, array('rs','inf'), array(2,'Mật khẩu mới không trùng nhau'), array(0,1));
				return;
			}
		}
		else if ($_pgR["act"] == Model_User::ACT_UPDATE_RESET_PASS)
			{
				$password = $_pgR['password'];
				$password = html_entity_decode($password,ENT_COMPAT ,'UTF-8' );
				
				$confirmpass = $_pgR['confirmpass'];
				$confirmpass = html_entity_decode($confirmpass,ENT_COMPAT ,'UTF-8' );
				
				$resetid = $_pgR['resetid'];
				$resetid = html_entity_decode($resetid,ENT_COMPAT ,'UTF-8' );
				
				if($password == $confirmpass)
				{
					$resetPw = $objReset->getResetPasswordByID($resetid);
					$result = $objUser->changeResetPassword($resetPw[global_mapping::UserID],$password);
					//echo $result;
					if ($result > 0)
					{
						$resetPw[global_mapping::ResetDate] = global_common::nowSQL();
						$resetPw[global_mapping::IsDeleted] = 1;
						$objReset->update($resetid,$resetPw[global_mapping::UserID],$resetPw[global_mapping::CreatedDate],
								$resetPw[global_mapping::ExpireDate],$resetPw[global_mapping::ResetDate],   
								$resetPw[global_mapping::IsDeleted]);
						
						$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
						echo global_common::convertToXML(
								$arrHeader, array('rs', 'inf'), 
								array(1, 'Cập nhật thành công'), 
								array( 0, 1 )
								);
						return;
					}
					else
					{
						echo global_common::convertToXML($arrHeader, array('rs','inf'), array(0,'Cập nhật thất bại. Xin vui lòng thử lại sau!'), array(0,1));
						return;
					}
				}
				else
				{
					echo global_common::convertToXML($arrHeader, array('rs','inf'), array(2,'Mật khẩu mới không trùng nhau'), array(0,1));
					return;
				}
			}
			else if ($_pgR["act"] == Model_User::ACT_RESET_PASS)
				{
					$userName = $_pgR['username'];
					$userName = html_entity_decode($userName,ENT_COMPAT ,'UTF-8' );
					$email = $_pgR['email'];
					$email = html_entity_decode($email,ENT_COMPAT ,'UTF-8' );
					
					if($userName)
					{
						$fieldName = global_mapping::UserName;
						$fieldValue = $userName;
					}
					else
					{
						$fieldName = global_mapping::Email;
						$fieldValue = $email;
					}
					
					$result = $objUser->getUserByField($fieldName,$fieldValue);
					//echo $result;
					if ($result)
					{
						$guid = $objReset->insert($result[0][global_mapping::UserID]);
						if($guid)
						{
							$userEmail = $result[0][global_mapping::Email];
							$fullName = $result[0][global_mapping::FullName];
							$linkReset = global_common::getHostName().'/change_password.php?id='.$guid;
							$arrMailContent = global_common::formatMailContent(global_common::TEAMPLATE_RESET_PASSWORD,
									null,
									array(global_common::formatOutputText($result[0][global_mapping::FullName]),
										$linkReset, global_common::RESET_EXPIRE_DAYS));
							$emailSubject = $arrMailContent[0];
							$emailContent = $arrMailContent[1];
							$isSent = global_mail::send($userEmail,$fullName,$emailSubject,$emailContent,null,
									global_common::SUPPORT_MAIL_USERNAME,global_common::SUPPORT_MAIL_PASSWORD,
									global_common::SUPPORT_MAIL_DISPLAY_NAME);
							if($isSent)
							{
								$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
								echo global_common::convertToXML(
										$arrHeader, array('rs', 'inf'), 
										array(1, 'Vui lòng kiểm tra email để cập nhật lại mật khẩu'), 
										array( 0, 1 )
										);
								return;
							}
						}
						echo global_common::convertToXML($arrHeader, array('rs','inf'), array(0,'Xử lý thất bại. Xin vui lòng thử lại sau!'), array(0,1));
						return;
					}				
					else
					{
						echo global_common::convertToXML($arrHeader, array('rs','inf'), array(0,'Tên đăng nhập hoặc email không tồn tại.'), array(0,1));
						return;
					}
				}
				else if ($_pgR["act"] == Model_User::ACT_CONTACT_US)
					{
						$fullName = $_pgR['fullName'];
						$fullName = html_entity_decode($fullName,ENT_COMPAT ,'UTF-8' );
						$email = $_pgR['email'];
						$email = html_entity_decode($email,ENT_COMPAT ,'UTF-8' );
						$subject = $_pgR['subject'];
						$subject = html_entity_decode($subject,ENT_COMPAT ,'UTF-8' );
						$content = $_pgR['content'];
						$content = html_entity_decode($content,ENT_COMPAT ,'UTF-8' );
						
						
						$emailContent = 'From:'. $fullName.'<br>'.'Email:'.$email.'<br>'.'Content: <br>'.$content;
						$isSent = global_mail::send(global_common::SUPPORT_MAIL_USERNAME,global_common::SUPPORT_MAIL_DISPLAY_NAME,$subject,$emailContent,null,
								global_common::SUPPORT_MAIL_USERNAME,global_common::SUPPORT_MAIL_PASSWORD,
								global_common::SUPPORT_MAIL_DISPLAY_NAME);
						if($isSent)
						{
							$arrHeader = global_common::getMessageHeaderArr($banCode);//$banCode
							echo global_common::convertToXML(
									$arrHeader, array('rs', 'inf'), 
									array(1, 'Đã gửi thành công.'), 
									array( 0, 1 )
									);
							return;
						}
						else
						{
							echo global_common::convertToXML($arrHeader, array('rs','inf'), array(0,'Xử lý thất bại. Xin vui lòng thử lại sau!'), array(0,1));
							return;
						}
						
					}
					else if ($_pgR["act"] == Model_User::ACT_LOGOUT)
						{
							
							echo global_common::convertToXML(
									$arrHeader, array('rs', 'inf','rurl'), 
									array(1, '',$_SESSION[global_common::SES_C_CUR_PAGE]), 
									array( 0, 1,1 )
									);
							global_common::clearSession();
							return;
						}
                        
                        

?>