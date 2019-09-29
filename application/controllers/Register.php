<?php
class Register extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('MMeeting');

	}

	public function index(){
		$data['nama'] = $_POST['nama'];
		// $data['no_hp'] = $_POST['nomor'];
		$data['email'] = $_POST['email'];
		$data2['email'] = $_POST['email'];
		$data['password'] = md5($_POST['password']);
		$data['jenis_user'] = $_POST['level'];



		$cek_email = $this->MMeeting->cek_login($data2);
		if (isset($cek_email))	 {

			$this->session->set_flashdata('alert','gagal');
			redirect('frontend/register');
		}else{
			$tabel = 'user';

			$this->MMeeting->tambah_data($tabel,$data);
			$regis = $this->MMeeting->cek_id($data['email']);
			$this->send($regis->id_user,$data['email']);

			$this->session->set_flashdata('alert','berhasil');
			redirect('frontend/login');

		}

		

	}

	public function send($id,$email){
		$htmlContent = '<center><h1>Klik Link di bawah ini untuk memverifikasi akun anda</h1>';
		$htmlContent .= '<a href='.base_url().'register/verifikasi/'.$id.'><button>Verifikasi </button></a></center>';


		$ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://mail.mzthree.id";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "meetingtegal@mzthree.id";
		$config['smtp_pass'] = "alimuzni25";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$config['crlf'] = "\r\n";
		$ci->email->initialize($config);
		$ci->email->from('meetingtegal@mzthree.id', 'Verif Meeting');
		$list = array($email);
		$ci->email->to($list);
		$ci->email->subject('Verifikasi Meeting Akun');


		$ci->email->message($htmlContent);
		if ($this->email->send()) {
			// echo 'Email sent.';
		} else {
			// show_error($this->email->print_debugger());
		}
	}

	public function verifikasi($id){
		$this->MMeeting->verifikasi('user',$id,'id_user');
		redirect('frontend/login');
	}
}

