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
if(!function_exists('multiInsert')) {
	function multiInsert($table, $array, $action="") {
		/*
		 *
		 * $array - a 2-dimensional array as rows and columns. e.g:
		 * 	array(
		 *		"1"=> array("1st_column_name", "2nd_column_name", etc),
		 *		"2"=> array("1st_column_name", "2nd_column_name", etc)
		 *
		 *
		 */
		$keystring	=	"";
		$valstring	=	"";
		$done		=	false;
		foreach($array as $single_record) {
			$valstring	.=	"(";
			foreach($single_record as $k=>$v) {
				if($done==false) { $keystring	.= $k.", "; }
				$valstring	.= "'".$v."', ";
			}
			$done	=	true;
			$valstring = rtrim($valstring, ", ");
			$valstring	.=	"), ";
		}
		$keystring = rtrim($keystring, ", ");
		$valstring = rtrim($valstring, ", ");
		$query	= "INSERT INTO $table ($keystring) VALUES $valstring;";
		if($action=="debug") {
			debug($query);
			return false;
		}
		$res	= query($query, $action);
		return ($res)?TRUE:FALSE;
	}
}
if(!function_exists('dbInsert')) {
	function dbInsert($table, $array, $action="") {
	/*
	 *
	 * $array - USAGE IS AS FOLLOWS: $insert['db_field'] = $value_to_be_inserted;
	 *
	 */
		$keystring	= "";
		$valstring	= "";
		foreach($array as $k=>$v) {
			$keystring	.= $k.", ";
			$valstring	.= "'".$v."', ";
		}
		$keystring = rtrim($keystring, ", ");
		$valstring = rtrim($valstring, ", ");
		$query	= "INSERT INTO $table ($keystring) VALUES ($valstring)";

		if($action=="debug") {
			debug($query);die();
		}
		$res	= query($query, $action);

		return ($res)?TRUE:FALSE;
	}
}
if(!function_exists('query')) {
	function query($sql, /*$type="array",*/ $action="") { //returns object of query
	/*
		MySQL table requirement:

		This function uses the following table...

		MySQL >	CREATE TABLE IF NOT EXISTS `db_activity` (`id` int(111) NOT NULL
				AUTO_INCREMENT,`ip` varchar(100) NOT NULL,`timestamp` timestamp NOT NULL DEFAULT
				CURRENT_TIMESTAMP,`query` text NOT NULL,`action` varchar(1000) DEFAULT
				NULL,`page` varchar(256) DEFAULT NULL, `referrer` varchar(256) DEFAULT NULL,
				PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1

	*/
		$ci =& get_instance();
		$debug	=	debug_backtrace();
		$file	=	$debug[0]['file'];
		$line	=	$debug[0]['line'];
		if($action=="" || $action==null || empty($action)) { die("Your query at line ".$line." in ".$file." does not have an action!"); }
		if(!isset($_SESSION['uniqid'])) { $uniqid=md5(uniqid()); }
		else { $uniqid=$_SESSION['uniqid']; }


		$source = 'Line '.$line.' in file '.$file;
		$referer= isset($_SERVER['HTTP_REFERER']) ? sanitize($_SERVER['HTTP_REFERER']):"" ;
		$tracker = '
			INSERT INTO db_activity (
				ip,
				session_id,
				timestamp,
				query,
				action,
				page,
				referrer,
				source
			)
			VALUES (
				"'.$_SERVER['REMOTE_ADDR'].'",
				"'.$uniqid.'",
				"'.date("Y-m-d H:i:s").'",
				"'.sanitize($sql).'",
				"'.sanitize($action).'",
				"'.sanitize($_SERVER['REQUEST_URI']).'",
				"'.$referer.'",
				"'.$source.'"
			)
		';
		$q = $ci->db->query($tracker);
		$response = $ci->db->query($sql);
		return $response;
	}
}
?>
