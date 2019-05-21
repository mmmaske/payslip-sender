<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		//session_start();
		//print_r($_SESSION);
		$this->output->enable_profiler(FALSE);
		//$this->load->library('encrypt');
		$this->load->model('Mmm');
		$visited=$this->mmm->userTracking();
		$blacklist=$this->db->query("SELECT * FROM blacklist WHERE ip='".$this->mmm->sanitize($_SERVER['REMOTE_ADDR'])."'");
		if($blacklist->row()) { die("You have been blacklisted!"); }
	}
	// public function index() { $data=array(); $this->load->view("parallax-home.php",$data); }
	public function index() {$data=array();
		$data['viewfile']	=	"minimal-homepage.php";
		$this->load->view("container.php",$data);
	}
	public function contactinfo() {
		$return	=	array();
		if(isset($_POST['capt'])) {
			if($_POST['capt'] != "") {
				if(isset($_POST['cinfo'])) {
					if($_POST['cinfo'] != "") {
						$msg	=	"
							<h1>New Contact Info</h1>
							<pre>".$_POST['cinfo']."</pre>
							<p>Sent on ".date("H:i - j F Y")."</p>
						";
						$this->mmm->sendEmail("admin@mmmaske.com", "Contact Info from mmmaske.com", $msg);
					}
					else {
						$return = array("error"=>"No contact information recieved");
					}
				}
				else {
					$return = array("error"=>"No contact information recieved");
				}
			}
			else {
				$return = array("error"=>"No captcha recieved");
			}
		}
		else {
			$return = array("error"=>"No captcha recieved");
		}
		echo json_encode($return);
	}
} ?>
