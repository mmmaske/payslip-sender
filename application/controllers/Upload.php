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
			if(!empty($csv)) {
				if(count($csv) < 500 || count($csv) > 2) {
					unset($data['uploaded'][0]);
					$ctr	=	0;
					foreach($csv as $rowctr=>$row) {
						if($row[3] == "" || $row[4] == "") unset($data['uploaded'][$rowctr]); // removes rows with blank email and filename columns
						if($row[3] != "" && $row[4] != "") {
							$multiInsert[]	=	[
								"full_name"		=>	$row[2],
								"recipient"		=>	$row[3],
								"attachment"	=>	$row[4],
								"created_on"	=>	date('Y-m-d H:i:s'),
							];
							//~ debug($row);
							$ctr++;
						}
					}
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
