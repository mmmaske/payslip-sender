<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		//session_start();
		//print_r($_SESSION);
		$this->output->enable_profiler(FALSE);
		//$this->load->library('encrypt');
		$blacklist=$this->db->query("SELECT * FROM blacklist WHERE ip='".sanitize($_SERVER['REMOTE_ADDR'])."'");
		if($blacklist->row()) { die("You have been blacklisted!"); }
	}
	public function index() {$data=array();
		$data['viewfile']	=	"home.php";
		$this->load->view("container.php",$data);
	}
} ?>
