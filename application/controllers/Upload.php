<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload extends CI_Controller {
	public function index() {
		redirect(SITEURL);
	}
	public function payslips() {
		if(isset($_FILES['payslip'])) {
			$payslip	=	$this->upload_file('payslip');
			$data['uploaded']	=	$payslip;
			$insert	=	[
				"new_name"		=>	$payslip['file_name'],
				"old_name"		=>	$payslip['orig_name'],
				"type"			=>	$payslip['file_ext'],
				"size"			=>	$payslip['file_size'],
				"created_on"	=>	date('Y-m-d H:i:s')
			];
			$inserted	=	dbInsert('payslips', $insert, 'Add new payslip');
			debug($inserted);
		}
		$data['viewfile']	=	'payslips.php';
		$this->load->view('container.php', $data);
	}
	public function reference() {
		if(isset($_FILES['reference'])) {
			$uploaded	=	$this->upload_file('reference');
			$csv		=	array_map('str_getcsv', file($uploaded['full_path']));
			$data['uploaded']	=	$csv;
			$data['filedata']	=	$uploaded;
			$multiInsert		=	[];
			$latest_email_schedule	=	$this->db->query("SELECT MAX(send_on) FROM emails");
			$latest_email_schedule	=	(array)$latest_email_schedule->row();
			$latest_email_schedule	=	$latest_email_schedule['MAX(send_on)'];
			$schedule_offset		=	60;
			$schedule_interval		=	5;
			$email_interval			=	5;
			$interval				=	6;
			if(!empty($csv)) {
				if(count($csv) < 500 || count($csv) > 2) {
					unset($csv[0]);
					$ctr	=	0;
					$insertstring	=	'';
					foreach($csv as $rowctr=>$row) {
						if($row[3] == "" || $row[4] == "") unset($data['uploaded'][$rowctr]); // removes rows with blank email and filename columns
						if($row[3] != "" && $row[4] != "") {
							$ctr++;
							$interval--;
							if($interval==0) {
								$interval=5;
								$schedule_interval	=	$schedule_interval + 5;
							}
							$multiInsert[$ctr]	=	[
								"full_name"		=>	$row[2],
								"recipient"		=>	$row[3],
								"attachment"	=>	$row[4],
								"send_on"		=>	date('Y-m-d H:i:s', strtotime('+'.($schedule_interval+$schedule_offset).' minutes')),
								"created_on"	=>	date('Y-m-d H:i:s'),
							];
							$insertstring	.=	$this->db->insert_string('emails', $multiInsert[$ctr]).'; ';
						}
					}
					$this->db->insert_batch('emails',$multiInsert);
				}
			}
		}
		$data['viewfile']	=	'references.php';
		$this->load->view('container.php', $data);
	}
	function upload_file($filetype) {
		$config['upload_path'] = WPATH .'assets'.'/'.$filetype;
		$config['allowed_types'] = '*';
		$this->load->library('upload');
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($filetype)) {
			$upload_data = array('error' => $this->upload->display_errors());
		}
		else {
			$upload_data=$this->upload->data();
		}
		return $upload_data;
	}
}
