<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('sanitize')) {
	function sanitize($string) {
		// $string =str_replace(';','',$string);
		// $string =str_replace('"','&quot;',$string);
		// $string =str_replace('&','&amp;',$string);
		// $string =str_replace('>','&lt;',$string);
		// $string =str_replace('<','&gt;',$string);
		//$string =str_replace('/','',$string);
		// $string =str_replace('--','-',$string);
		$string =addslashes($string);
		$string =trim($string);
		$string =preg_replace('/\s+/', ' ',$string);
		//$this->db->escape($string);
		//$this->db->escape_str($string);
		//$this->db->escape_like_str($string);
		return $string;
	}
}
if(!function_exists('debug')) {
	function debug($var) {
		if(ENVIRONMENT == "development") {
			echo "<pre>";
			$debug	=	debug_backtrace();
			$file	=	$debug[0]['file'];
			$line	=	$debug[0]['line'];
			echo "Debug in ".$file." at ".$line."<br/>";
			print_r($var);
			echo "</pre>";
		}
	}
}
if(!function_exists('sendEmail')) {
	function sendEmail($to, $subject, $msg, $attachment='') {
		$ci =& get_instance();
		require_once FCPATH.'vendor/phpmailer/phpmailer/src/PHPMailer.php';
		require_once FCPATH.'vendor/phpmailer/phpmailer/src/Exception.php';
		require_once FCPATH.'vendor/phpmailer/phpmailer/src/SMTP.php';
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		try {
			//Server settings
			$mail->SMTPDebug	=	2;					// Enable verbose debug output
			$mail->isSMTP();							// Set mailer to use SMTP
			$mail->Host			=	EMAIL_HOST;			// Specify main and backup SMTP servers
			$mail->SMTPAuth		=	true;				// Enable SMTP authentication
			$mail->Username		=	EMAIL_SENDER;		// SMTP username
			$mail->Password		=	SENDER_PWORD;		// SMTP password
			$mail->SMTPSecure	=	'tls';				// Enable TLS encryption, `ssl` also accepted
			$mail->Port			=	EMAIL_HOST_PORT;	// TCP port to connect to
			$mail->setFrom(EMAIL_SENDER, 'Auto-Mailer');

			$mail->addAddress($to);						// Add a recipient

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Payslip';
			$mail->Body    = 'Your payslip is attached to this email.';
			if(file_exists($attachment)) $mail->addAttachment($attachment);
			$mail->send();
		} catch (Exception $e) {
			debug("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
		}
	}
}
if(!function_exists('checkLogin')) {
	function checkLogin() {
		if(!isset($_SESSION['pss']['login'])) {

		}
	}
}
if(!function_exists('redirect')) {
	function redirect($destination) {
		header("location:".$destination);
		echo "<script>window.location='".$destination."'</script>";
		die("<script>window.location='".$destination."'</script>");
		return true;
	}
}
if(!function_exists('swalert')) {
	function swalert($title, $text, $type) {
		$_SESSION['pss']['alert']	=	[
			'icon'		=>	$type,
			'title'		=>	$title,
			'text'	=>	$text
		];
	}
}

?>
