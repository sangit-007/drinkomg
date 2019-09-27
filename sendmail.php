<?php
//CHANGE THE VARIALBLES BELOW TO YOUR SETTINGS
$from="noreply@mayoalumni.in"; // please specify the receiver email here (usually the webmail email id)
$SmtpUser="noreply@mayoalumni.in"; // write webmail user ID
$SmtpPass="q9K_l0nHG7=h"; // write user password for webmail.
$SmtpServer="mailserver.olivewebhosting.com"; //leave intact
$SmtpPort="25"; //default 25 considered. Do not change unless you what is other port you should be using.


//DO NOT CHANGE ANYTHING BELOW THIS LINE
class SMTPClient
{
	function SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body)
	{
		$this->SmtpServer = $SmtpServer;
		$this->SmtpUser = base64_encode ($SmtpUser);
		$this->SmtpPass = base64_encode ($SmtpPass);
		$this->from = $from;
		$this->to = $to;
		$this->subject = $subject;
		$this->body = $body;

		if ($SmtpPort == "") 
		{
			$this->PortSMTP = 25;
		} else {
			$this->PortSMTP = $SmtpPort;
		}
	}

	function SendMail ()
	{
		if ($SMTPIN = fsockopen ($this->SmtpServer, $this->PortSMTP)) 
		{
			fputs ($SMTPIN, "EHLO ".$HTTP_HOST."\r\n"); 
			$talk["hello"] = fgets ( $SMTPIN, 2048 ); 
			fputs($SMTPIN, "auth login\r\n");
			$talk["res"]=fgets($SMTPIN,2048);
			fputs($SMTPIN, $this->SmtpUser."\r\n");
			$talk["user"]=fgets($SMTPIN,2048);
			fputs($SMTPIN, $this->SmtpPass."\r\n");
			$talk["pass"]=fgets($SMTPIN,512);
			fputs ($SMTPIN, "MAIL FROM: <".$this->from.">\r\n"); 
			$talk["From"] = fgets ( $SMTPIN, 2048 ); 
			fputs ($SMTPIN, "RCPT TO: <".$this->to.">\r\n"); 
			$talk["To"] = fgets ($SMTPIN, 2048); 
			fputs($SMTPIN, "DATA\r\n");
			$talk["data"]=fgets( $SMTPIN,2048 );
			fputs($SMTPIN, "To: <".$this->to.">\r\nFrom: <".$this->from.">\r\nSubject:".$this->subject."\r\n\r\n\r\n".$this->body."\r\n.\r\n");
			$talk["send"]=fgets($SMTPIN,512);
			//CLOSE CONNECTION AND EXIT ... 
			fputs ($SMTPIN, "QUIT\r\n"); 
			fclose($SMTPIN); 
		} 
		return $talk;
	} 
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$to = $_POST['to'];
	$subject = $_POST['sub'];
	$body = $_POST['message'];
	if(empty($to) && empty($subject) && empty($body)){
		$msg .= "<div style='padding:7px;border:1px solid #fdd3ed;background:#fef1f9;color:#d22790;font-weight:normal;'>There is something missing before email could be delivered. Please consider filling all fields.</div>";
	} else {
		$SMTPMail = new SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body);
		$SMTPChat = $SMTPMail->SendMail();
		if($SMTPChat){
			$msg .= "<div style='padding:7px;border:1px solid #aad4fb;background:#ecf6ff;color:#05427a;'>Email successfully sent to ".$to."</div>";
		} else {
			$msg .= "<div style='padding:7px;border:1px solid #fdd3ed;background:#fef1f9;color:#d22790;font-weight:normal;'>Email couldn't be delivered. Please try again.</div>";
		}
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>SMTP Mail Script</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style type="text/css">
input{width:70%;padding:5px;font:bold 18px Trebuchet MS, Georgia, Arial;border:1px solid #e6e6e6;color:#343434;}
textarea{width:90%;padding:3px;font:bold 16px Trebuchet MS, Georgia, Arial;border:1px solid #e6e6e6;color:#343434;height:150px;}
button{background:#dee4eb;border:1px solid #cdcdcd;padding:5px;cursor:pointer;}
</style>
</head>
<body>
<form method="post" action="">
<div style='width:50%;margin:0px auto;'>	
	<table border='0' cellspacing='1' cellpadding='3' width='90%' align='center' style='font:bold 14px Trebuchet MS, georgia;'>
	<?php if($msg) echo "<tr><td colspan='2' style='padding:0px;font-weight:normal;'>".$msg."</td></tr>"; ?>
	<tr>
	<td style='width:27%;margin-bottom:5px;border:1px solid #e6e6e6;background:#f9f9f9;padding:4px;'>To:</td><td style='width:68%;margin-bottom:5px;border:1px solid #f5edd0;background:#f6f3e8;'><input type="text" name="to" /></td>
	</tr>
	<tr>
	<td style='width:27%;margin-bottom:5px;border:1px solid #e6e6e6;background:#f9f9f9;padding:4px;'>Subject :</td><td style='width:68%;margin-bottom:5px;border:1px solid #f5edd0;background:#f6f3e8;'><input type='text' name="sub" /></td>
	</tr>
	<tr>
	<td valign='top' style='width:27%;margin-bottom:5px;border:1px solid #e6e6e6;background:#f9f9f9;padding:4px;'>Message :</td><td style='width:68%;margin-bottom:5px;border:1px solid #f5edd0;background:#f6f3e8;'><textarea name="message"></textarea></td>
	</tr>
	<tr>
	<td style='width:27%;margin-bottom:5px;'></td><td style='width:68%;margin-bottom:5px;border:1px solid #f5edd0;background:#f6f3e8;'><button type="submit"> Send Mail </button></td>
	</tr>
	</table>
</div>
</form>
</body>
</html>