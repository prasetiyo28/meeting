<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('MMeeting');

	}

	public function index(){
		$data['email'] = $_POST['email'];
		$data['password'] = md5($_POST['password']);
		$data['verifikasi'] = '1';
		
		$cek_login = $this->MMeeting->cek_login($data);
		if (!isset($cek_login))	 {
			$this->session->set_flashdata('alert','gagal');
			redirect('Frontend/login');
		}else{

			$datauser = array(
				'user_id' => $cek_login->id_user,
				'nama' => $cek_login->nama,
				'no_hp' => $cek_login->no_hp,
				'email' => $cek_login->email,
				'jenis_user' => $cek_login->jenis_user
			);

			

			$this->session->set_userdata($datauser);
			
			if ($cek_login->jenis_user == 0) {
				redirect('Frontend');
			}elseif($cek_login->jenis_user == 1){
				$cek_mitra = $this->MMeeting->get_mitra($cek_login->id_user);
				if(!empty($cek_mitra)){
					$datauser2 = array(
						'id_mitra' => $cek_mitra->id_mitra,
						'nama_mitra' => $cek_mitra->nama_mitra,
						'alamat_mitra' => $cek_mitra->alamat,
						'no_telp_mitra' => $cek_mitra->no_telp
					);
					$this->session->set_userdata($datauser2);
				}
				// echo json_encode($datauser2);
				redirect('Mitra');
			}else{
				redirect('SuperAdmin');
			}
		}




	}

	public function kirim_reset(){
		$data['email'] = $_POST['email'];
		

		$cek_email = $this->MMeeting->cek_login($data);
		if (isset($cek_email))	 {

			$this->send($data['email'],$cek_email->id_user);
			$this->session->set_flashdata('alerts','Link Reset Password telah dikirim melalaui email');
			redirect('Frontend/login');
		}else{
			$this->session->set_flashdata('alerts','Email anda tidak terdaftar');
			redirect('Frontend/login');
		}
	}

	public function send($email,$id){
		$htmlContent = '<center><h1>Klik Link di bawah ini untuk mereset password akun anda</h1>';
		$htmlContent .= '<p>*abaikan jika ini bukan permintaan anda</p>';
		$htmlContent .= '<a href='.base_url().'Frontend/reset_password/'.$id.'><button>Reset Password </button></a></center>';


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
		$ci->email->from('meetingtegal@mzthree.id', 'Reset Passsword');
		$list = array($email);
		$ci->email->to($list);
		$ci->email->subject('Reset Passsword');


		$ci->email->message($htmlContent);
		if ($this->email->send()) {
			// echo 'Email sent.';
		} else {
			// show_error($this->email->print_debugger());
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect ('frontend');
	}
}

