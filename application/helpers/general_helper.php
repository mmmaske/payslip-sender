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
		$ci->load->library('email');
		// $config['protocol'] = 'sendmail';
		// $config['protocol'] = 'smtp';

		// $config['mailpath'] = '/usr/sbin/sendmail';

		// $config['charset'] = 'iso-8859-1';
		$config['charset'] = 'utf-8';

		// $config['content-type'] = 'text';
		$config['content-type'] = 'html';
		// $config['content-type'] = 'text/html';

		$config['wordwrap'] = TRUE;

		$debug_string	=	"";
		if(ENVIRONMENT == "development") {
			$debug	=	debug_backtrace();
			$file	=	$debug[0]['file'];
			$line	=	$debug[0]['line'];
			$debug_string	.= "<br/><br/><pre>";
			$debug_string	.=	"Send email in ".$file." at ".$line;
			$debug_string	.= "</pre>";
		}

		$email_config	=	array(
			'protocol' => 'smtp',
			'smtp_host' => EMAIL_HOST,
			'smtp_port' => 25,
			'smtp_user' => EMAIL_SENDER,
			'smtp_pass' => SENDER_PWORD,
			'mailtype'  => 'html',
			'charset'   => 'iso-8859-1'
		);

		$ci->email->initialize($email_config);
		$ci->email->from(EMAIL_SENDER);
		$ci->email->to($to);
		$ci->email->subject($subject);
		$ci->email->message("<html><body>".$msg.$debug_string."</body></html>");

		if(file_exists(WPATH."uploads/".$attachment)) {
			$this->email->attach(WPATH."uploads/".$attachment);
		}
		return $ci->email->send();
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
?>
