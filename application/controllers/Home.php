<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->output->enable_profiler(FALSE);
	}
	public function index() {$data=array();
		sendEmail('mmjmaske@yahoo.com.ph', 'Test Subject', 'Lorem ipsum dolor sit amet');
		$data['viewfile']	=	"home.php";
		$this->load->view("container.php",$data);
	}
	public function crontroller() {

	}
	public function send() {
		$emails	=	$this->db->query("SELECT * FROM emails WHERE is_sent<>1");
		$emails	=	$emails->result_array();
		debug($emails);
	}
} ?>
