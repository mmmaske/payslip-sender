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
	public function send($id='') {
		$send_to['is_sent']					=	0;
		$send_to['send_on>']				=	date('Y-m-d H:i:s', strtotime('-5 minutes'));
		$send_to['send_on<']				=	date('Y-m-d H:i:s', strtotime('+5 minutes'));
		if(is_numeric($id)) {
			unset($send_to);
			$send_to['id']	=	$id;
		}
		$emails				=	$this->db->get_where("emails", $send_to)->result_array();
		debug($this->db->last_query());
		$sendctr			=	0;
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
					//~ sendEmail($email['recipient'], 'Payslip', '<p>Hello '.$email['full_name'].'!</p><p>See attached.</p>', $file);
					$sendctr++;
					$update_emails[]	=	[
						'id' => $email['id'],
						'modified_on' => date('Y-m-d H:i:s'),
						'is_sent' => 1
					];
					//~ rename('"'.$file.'"', '"'.FCPATH.'assets/payslip/archive/'.date('Y-m-d').'/'.$email['attachment'].'"');
				}
			}
			if(!empty($update_emails)) $this->db->update_batch('emails', $update_emails, 'id');
		}
		echo "<h1>Emails sent: ".$sendctr."</h1>";
	}
} ?>
