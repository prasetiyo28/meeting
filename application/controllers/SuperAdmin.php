<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('MMeeting');

	}

	public function index()
	{
		// $data['banner'] = 'true';
		$data['content'] = $this->load->view('super/pages/dashboard','',true);
		$this->load->view('super/default',$data);

	}

	public function dataruang()
	{

		$data2['kapasitas'] = $this->MMeeting->get_kapasitas();
		$data2['ruangan'] = $this->MMeeting->get_ruangan_all();
		$data['content'] = $this->load->view('super/pages/data_ruang',$data2,true);
		$this->load->view('super/default',$data);

		// echo json_encode($data2);
	}

	public function datamitra()
	{

		$data2['mitra'] = $this->MMeeting->get_mitra_all();
		$data['content'] = $this->load->view('super/pages/data_mitra',$data2,true);
		$this->load->view('super/default',$data);

		// echo json_encode($data2);
	}

	public function datauser()
	{

		$data2['user'] = $this->MMeeting->get_user_all();
		$data['content'] = $this->load->view('super/pages/data_user',$data2,true);
		$this->load->view('super/default',$data);

		// echo json_encode($data2);
	}

	public function datatransaksi()
	{

		$data2['transaksi'] = $this->MMeeting->get_transaksi_all();
		$data['content'] = $this->load->view('super/pages/data_transaksi',$data2,true);
		$this->load->view('super/default',$data);

		// echo json_encode($data2);
	}

	public function detail(){
		$id = $_POST['id_ruang'];
		// $id = 1;
		// $table = 'ruang';
		$data = $this->MMeeting->get_detail_ruangan($id);

		if ($data->keterangan == 1) {
			$ket =  '<label class="btn btn-success"><i class="fas fa-check"></i>Verified</label>';
		}else{
			$ket = '<label class="btn btn-danger btn-sm"><i class="fas fa-exclamation-triangle"></i>Unverified</label>';
		}

		if ($data->verif == 0) {
			$ver =  '<tr>
			<td colspan="3">
			<center>
			<a href="'.base_url().'SuperAdmin/verifikasi/'.$data->id_ruang.'" class="btn btn-success">V e r i f i k a s i </a>
			</center>
			</td>
			</tr>';
		}else{
			$ver = '';
		}

		echo '
		<table class="table table-striped">
		<tr>
		<td colspan="3"><img style="text-align: center;" class="img-thumbnail" src="'. base_url().'foto_ruang/'. $data->foto.'"></td>
		</tr>
		<tr>
		<td>Nama Ruangan</td>
		<td>:</td>
		<td>'.$data->nama_ruangan.'</td>
		</tr>
		<td>Nama Mitra</td>
		<td>:</td>
		<td>'.$data->nama_mitra.'</td>
		</tr>
		<tr>
		<td>Kapasitas</td>
		<td>:</td>
		<td>'.$data->keterangan.'</td>
		</tr>
		<tr>
		<td>Harga</td>
		<td>:</td>
		<td>Rp.'.$data->harga.'/Jam</td>
		</tr>
		<tr>
		<td>Keterangan</td>
		<td>:</td>
		<td>'.$ket.'</td>
		</tr>
		'.$ver.'
		</table>';


	}

	public function detailmitra(){
		$id = $_POST['id_mitra'];
		// $id = 1;
		// $table = 'ruang';
		$data = $this->MMeeting->get_detail_mitra($id);

		if ($data->verif == 0) {
			$ver =  '<tr>
			<td colspan="3">
			<center>
			<a href="'.base_url().'SuperAdmin/verifikasimitra/'.$data->id_mitra.'" class="btn btn-success">V e r i f i k a s i </a>
			</center>
			</td>
			</tr>';
		}else{
			$ver = '';
		}

		echo '
		<table class="table table-striped">
		<tr>
		<td>Nama Mitra</td>
		<td>:</td>
		<td>'.$data->nama_mitra.'</td>
		</tr>
		<td>Alamat</td>
		<td>:</td>
		<td>'.$data->alamat.'</td>
		</tr>
		<tr>
		<td>No_telp</td>
		<td>:</td>
		<td>'.$data->no_telp.'</td>
		</tr>
		<tr>
		<td>Nama Bank</td>
		<td>:</td>
		<td>'.$data->nama_bank.'</td>
		</tr>
		<tr>
		<td>Nomor Rekening</td>
		<td>:</td>
		<td>'.$data->nomor_rekening.'</td>
		</tr>
		<td>Nama Akun Bank</td>
		<td>:</td>
		<td>'.$data->nama_akun_bank.'</td>
		</tr>
		'.$ver.'
		</table>';


	}

	public function verifikasi($id){
		$table = 'ruang';
		$param = 'id_ruang';
		$this->MMeeting->verif($table,$id,$param);

		redirect('SuperAdmin/dataruang');
	}

	public function verifikasimitra($id){
		$table = 'mitra';
		$param = 'id_mitra';
		$this->MMeeting->verif($table,$id,$param);

		redirect('SuperAdmin/datamitra');
	}

	public function hapus_ruang($id){
		$table = 'ruang';
		$param = 'id_ruang';
		$this->MMeeting->hapus($table,$id,$param);
		redirect('SuperAdmin/dataruang');
	}

	public function hapus_user($id){
		$table = 'user';
		$param = 'id_user';
		$this->MMeeting->hapus($table,$id,$param);
		redirect('SuperAdmin/datauser');
	}

	public function hapus_mitra($id){
		$table = 'mitra';
		$param = 'id_mitra';
		$this->MMeeting->hapus($table,$id,$param);
		redirect('SuperAdmin/datamitra');
	}

}
