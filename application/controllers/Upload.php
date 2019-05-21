<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	public function index() {
		redirect(SITEURL);
	}
	public function payslips() {
		$data['viewfile']	=	'payslips.php';
		$this->load->view('container.php', $data);
	}
	public function reference() {
		$data['viewfile']	=	'references.php';
		$this->load->view('container.php', $data);
	}
	function upload_file() {

	}
}
