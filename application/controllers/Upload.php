<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	public function index() {
		redirect(SITEURL);
	}
	public function payslips() {
		if(isset($_FILES['payslip'])) {
			debug($this->upload_file('payslip'));
		}
		$data['viewfile']	=	'payslips.php';
		$this->load->view('container.php', $data);
	}
	public function reference() {
		if(isset($_FILES['reference'])) {
			debug($this->upload_file('reference'));
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
