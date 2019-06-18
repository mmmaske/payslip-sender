<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->output->enable_profiler(FALSE);

	}
	public function index() {$data=array();
		$data['csv']		=	$this->db->get('emails')->result_array();
		$data['uploaded']	=	count($this->db->get('emails')->result_array());
		$data['viewfile']	=	"home.php";
		$this->load->view("container.php",$data);
	}
	public function crontroller() {
		$this->send();
	}
	public function send() {
		$emails	=	$this->db->query("SELECT e.* FROM emails as e WHERE e.is_sent=0 AND e.send_on <= '".date('Y-m-d H:i:s')."'");
		$emails	=	$emails->result_array();
		$sendctr	=	0;
		$update_emails		=	[];
		$update_payslips	=	[];
		if(count($emails)) {
			foreach($emails as $email) {
				if(ENVIRONMENT == 'development') {
					$email['recipient']	=	'mark.maske@systemantech.com';
				}
				$file	=	FCPATH.'assets/payslip/'.$email['attachment'];
				if(file_exists($file)) {
					debug($email);
					sendEmail($email['recipient'], 'Payslip', '<p>Hello '.$email['full_name'].'!</p><p>See attached.</p>', $file);
					$sendctr++;
					$update_emails[]	=	[
						'id' => $email['id'],
						'modified_on' => date('Y-m-d H:i:s'),
						'is_sent' => 1
					];
					$update_payslips[]	=	[
						'id' => $email['payslip_id'],
						'modified_on' => date('Y-m-d H:i:s'),
						'is_sent' => 1
					];
				}
			}
			$this->db->update_batch('emails', $update_emails, 'id');
			$this->db->update_batch('payslips', $update_payslips, 'id');
		}
		echo "<h1>Emails sent: ".$sendctr."</h1>";
	}
} ?>
