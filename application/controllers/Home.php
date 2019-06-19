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
	public function test_send() {
		require_once FCPATH.'vendor/phpmailer/phpmailer/src/PHPMailer.php';
		require_once FCPATH.'vendor/phpmailer/phpmailer/src/Exception.php';
		require_once FCPATH.'vendor/phpmailer/phpmailer/src/SMTP.php';
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		try {
			//Server settings
			$mail->SMTPDebug = 2;                                       // Enable verbose debug output
			$mail->isSMTP();                                            // Set mailer to use SMTP
			$mail->Host       = EMAIL_HOST;  // Specify main and backup SMTP servers
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = EMAIL_SENDER;                     // SMTP username
			$mail->Password   = SENDER_PWORD;                               // SMTP password
			$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port       = EMAIL_HOST_PORT;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom('smti.developers@gmail.com', 'Mailer');
			$mail->addAddress('mmjmaske@gmail.com', 'mmm');     // Add a recipient
			$mail->addAddress('mark.maske@systemantech.com', 'mmm');     // Add a recipient
			$mail->addAddress('josh.gono@systemantech.com', 'jbg');     // Add a recipient

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	public function crontroller() {
		$this->send();
	}
	public function send($id='') {
		//~ $send_to['send_on<=']	=	date('Y-m-d H:i:s');
		if(is_numeric($id)) $send_to['id']	=	$id;
		$emails				=	$this->db->get_where("emails", $send_to)->result_array();
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
					sendEmail($email['recipient'], 'Payslip', '<p>Hello '.$email['full_name'].'!</p><p>See attached.</p>', $file);
					$sendctr++;
					$update_emails[]	=	[
						'id' => $email['id'],
						'modified_on' => date('Y-m-d H:i:s'),
						'is_sent' => 1
					];
				}
			}
			if(!empty($update_emails)) $this->db->update_batch('emails', $update_emails, 'id');
		}
		echo "<h1>Emails sent: ".$sendctr."</h1>";
	}
} ?>
