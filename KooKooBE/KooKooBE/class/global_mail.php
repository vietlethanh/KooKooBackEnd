<?php 

include("lib/mail/class.phpmailer.php");



class global_mail

{	
	var $objConnection;
	public function sendmail($objConnection)
	{
		$this->objConnection = $objConnection;
	}
	
	/**
	 * Method de gui mail
	 *
	 * @param string $to Email cua nguoi nhan
	 * @param string $toname Ten cua nguoi nhan
	 * @param string $subject Chu de cua mail
	 * @param string $content Noi dung cua mail
	 * @param string $attactment Attachment - hien tai ko co dung
	 * @param string $sender Email dung de login SMTP
	 * @param string $senderPass Pass cua email dung de login SMTP
	 * @param string $senderName Ten nguoi gui
	 * @param string $useGoogleSMTP Cho biet co dung SMTP cua google de gui hay khong. Chi co gui mail truc tiep moi dung
	 * @return bool true->thanh cong, false->that bai
	 *
	 */
	
	public function send($to,$toname,$subject,$content,$attactment,$sender,$senderPass,$senderName, $useGoogleSMTP = 1)
	{
		try{
			error_reporting(E_ALL);
			$mail = new PHPMailer();
			//$mail->AddReplyTo($replyto,$fullname);
			$mail->From       = $sender;
			$mail->FromName   = $senderName;
			$mail->Subject    = $subject;
			$mail->Body       = $content;
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->WordWrap   = 50; // set word wrap
			$mail->MsgHTML($content);
			
			$arrAddress = explode(";",$to);
			foreach ($arrAddress as $address)
			{
				$mail->AddAddress($address, $toname);
			}
			
			$mail->IsHTML(true); // send as HTML
			$mail->IsSMTP();
			$mail->SMTPAuth	  = true;
			$mail->SMTPSecure = "ssl";
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = '465';                   // set the SMTP port for the GMAIL server				
			$mail->Username   = $sender;			   
			$mail->Password   = $senderPass;
			$mail->CharSet = 'utf-8'; 
			
			if(!$mail->Send()) 
			{
				global_common::writeLog("Mailer Error: " . $mail->ErrorInfo,0,"sendmail.php");
				return false;
			} 
			else
			{
				return true;
			}
		}catch (Exception $e) {
			global_common::writeLog("Mailer Error: " .  $e->getMessage(),0,"sendmail.php");
			return false;
		}
	}
	
	
	
	
	
	/**
	 * Lay ve mxRecord dung de gui mail
	 *
	 * @return string Chuoi chua mxRecord dung de gui mail
	 * @author DoNguyen added [20100914]
	 */
	
	private function getSMTPServer()
	{
		// CONSTANT Ten cua file .app chua danh sach SMTPServer
		$smtpServerFileName = "smtpServerList";
		// Tao pathname
		$pathName = global_common::FOLDER_CONFIG.$smtpServerFileName;
		// Lay noi dung file
		$arrSMTPServer = Application::getVar($pathName);
		// Noi dung file khong ton tai hoac noi dung rong hoac doc file khong duoc
		if(empty($arrSMTPServer))
		{
			// Lay gia tri mac dinh
			$arrSMTPServer = self::getSMTPServerList();
		}
		
		// Di chuyen chi so mang den mxRecord tiep theo, neu no dang la mxRecord cuoi thi quay ve dau
		$arrSMTPServer[0]++;
		
		if ($arrSMTPServer[0] >= count($arrSMTPServer)){
			$arrSMTPServer[0] = 1;
		}
		
		// Cap nhat lai noi dung file
		Application::setVar($pathName, $arrSMTPServer);
		// Tra ve mxRecord
		return $arrSMTPServer[$arrSMTPServer[0]];
	}
	
	
	
	
	
	/**
		
	 * Lay ve danh sach mac dinh mxRecord se duoc su dung trong he thong
	 *
	 * @return array Mang chua danh sach cac mxRecord. Luu y: phan tu dau tien khong phai la mxRecord ma chi la chi so cua mxRecord vua su dung
	 * @author DoNguyen added [20100914]
	 */
	
	private function getSMTPServerList()
	{
		// [0]: Chi so cua mx record trong mang ma vua duoc dung
		// [1]->...: Cac mx record
		return array(1,"timkm.com");
	}
	
	public function isYahooMail($strEmail)
	{
		$strEmail = strtolower($strEmail);
		
		if (strpos($strEmail,"@yahoo.")===false && strpos($strEmail,"@ymail.")===false && strpos($strEmail,"@rocketmail.")===false) 
		{
			return false;
		}
		
		return true;
	}
	
	
	
	public function getSupportEmail()
	{
		// get email with min pos and time
		$strSQL	= global_common::prepareQuery(global_common::SQL_SELECT_BY_CONDITION,array("*",global_common::TBL_STA_EMAIL_SUPPORT,"times=(select min(times) from sta_email_support) ORDER BY email limit 0,1"));
		$result = $this->objConnection->selectCommand($strSQL);
		return $result[0];
	}
	
	public function updateSupportEmail($email_record)
	{
		if ($email_record["current_pos"]>=30)		
		{
			$strSql = global_common::prepareQuery(global_common::SQL_UPDATE_BY_CONDITION,array(global_common::TBL_EMAIL_SUPPORT,"current_pos='0',times='".($email_record["times"] + 1)."'","email='".$email_record["email"]."'"));
		}
		else
		{
			$strSql = global_common::prepareQuery(global_common::SQL_UPDATE_BY_CONDITION,array(global_common::TBL_EMAIL_SUPPORT,"current_pos='".($email_record["current_pos"] + 1)."'","email='".$email_record["email"]."'"));
		}
		$result = $this->objConnection->executeSQL($strSql);
		if ($result==-1)
		{
			return false;	
		}
		return true;
	}
}

?>



