<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->library('googlemaps');
		$this->load->model('MMeeting');

	}
	
	public function index()
	{
		// $data['banner'] = 'true';

		$config['map_div_id'] = "map-add";
		$config['map_height'] = "250px";
		$config['center'] = '-6.880029,109.124192';
		$config['zoom'] = '12';
		$config['map_height'] = '300px;';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '-6.880029,109.124192';
		$marker['draggable'] = true;
		$marker['ondragend'] = 'setMapToForm(event.latLng.lat(), event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();

		$id = $this->session->userdata('user_id');

		$data['mitra'] = $this->MMeeting->get_mitra($id);
		$data2['booking'] = $this->MMeeting->get_booking($data['mitra']->id_mitra);
		$data['jml_booking'] = intval(count($data2['booking']));
		
		$data['content'] = $this->load->view('mitra/pages/dashboard',$data,true);
		$this->load->view('mitra/default',$data);
	}

	public function konfirmasi_selesai($id){
		$this->MMeeting->konfirmasi_selesai($id);
		redirect('Mitra/booking');
	}

	public function dataruang()
	{
		$id = $this->session->userdata('user_id');
		$data2['mitra'] = $this->MMeeting->get_mitra($id);
		$id_mitra = $this->session->userdata('id_mitra');
		$data2['kapasitas'] = $this->MMeeting->get_kapasitas();
		$data2['ruangan'] = $this->MMeeting->get_ruangan($id_mitra);
		$data2['booking'] = $this->MMeeting->get_booking($id_mitra);
		$data['jml_booking'] = intval(count($data2['booking']));
		$data['content'] = $this->load->view('mitra/pages/data_ruang',$data2,true);
		$this->load->view('mitra/default',$data);

		// echo json_encode($data2);
	}

	public function update_profil()
	{
		$id_mitra = $this->input->post('id_mitra');
		$id_user = $this->input->post('id_user');
		$data['longitude'] = $this->input->post('longitude');
		$data['latitude'] = $this->input->post('latitude');
		$data['alamat'] = $this->input->post('alamat');
		$data['no_telp'] = $this->input->post('no_telp');
		
		
		if ($this->input->post('password') != '') {
			$data2['password'] = md5($this->input->post('password'));

			$tabel = 'user';
			$this->MMeeting->update_data($tabel,$id_user,'id_user',$data2);
		}

		$tabel = 'mitra';
		$this->MMeeting->update_data($tabel,$id_mitra,'id_mitra',$data);
		$this->session->set_flashdata('alert','berhasil');
		redirect($_SERVER['HTTP_REFERER']);
		
	}

	public function profil()
	{
		$id = $this->session->userdata('user_id');
		$data2['mitra'] = $this->MMeeting->get_mitra($id);

		$long = $data2['mitra']->longitude;
		$lat = $data2['mitra']->latitude;
		$config['map_div_id'] = "map-add";
		$config['map_height'] = "250px";
		$config['center'] = '-6.880029,109.124192';
		$config['zoom'] = '12';
		$config['map_height'] = '300px;';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = $lat.','.$long;
		$marker['draggable'] = true;
		$marker['ondragend'] = 'setMapToForm(event.latLng.lat(), event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data2['map'] = $this->googlemaps->create_map();

		
		$id_mitra = $this->session->userdata('id_mitra');
		$data2['booking'] = $this->MMeeting->get_booking($id_mitra);
		$data['jml_booking'] = intval(count($data2['booking']));
		$data['content'] = $this->load->view('mitra/pages/profil',$data2,true);
		$this->load->view('mitra/default',$data);

		// echo json_encode($data2['mitra']);
	}

	public function dataminuman()
	{
		$id = $this->session->userdata('user_id');
		$data2['mitra'] = $this->MMeeting->get_mitra($id);
		$id_mitra = $this->session->userdata('id_mitra');
		$data2['minuman'] = $this->MMeeting->get_minuman($id_mitra);
		$data['content'] = $this->load->view('mitra/pages/data_minuman',$data2,true);
		$this->load->view('mitra/default',$data);

		// echo json_encode($data2);
	}

	public function booking(){
		$id = $this->session->userdata('user_id');
		$data2['mitra'] = $this->MMeeting->get_mitra($id);
		$id_mitra = $this->session->userdata('id_mitra');
		$data2['ruangan'] = $this->MMeeting->get_ruangan($id_mitra);
		$data2['offline'] = $this->MMeeting->get_booking_offline($id_mitra);
		$data2['booking'] = $this->MMeeting->get_booking($id_mitra);
		$data['jml_booking'] = intval(count($data2['booking']));
		$data['content'] = $this->load->view('mitra/pages/data_booking',$data2,true);

		// echo $data['jml_booking'];
		$this->load->view('mitra/default',$data);

		// echo json_encode($data2);
	}

	public function save_booking($value='')
	{

		$tanggal = strtotime($this->input->post('tanggal'));
		$tgl = date('Y-m-d',$tanggal);
		$jam = date("H:i",$tanggal);
		
		$data['id_user'] = '0';
		$data['status'] = '1';
		$data['id_ruang'] = $this->input->post('id_ruang');
		$data['lama'] = $this->input->post('lama');
		$data['tanggal'] = $tgl;
		$data['jam'] = $jam;
		$data['makan_minum'] = $this->input->post('catatan');
		$data['catatan_khusus'] = $this->input->post('khusus');
		$data['bayar'] = $this->input->post('total');
		$data['total'] = $this->input->post('total');
		$cek = $this->cek_ruangan($data['id_ruang'],$tgl);

		if ($cek == 0) {
			
			$this->MMeeting->tambah_data('booking',$data);
			redirect('Mitra/booking');
		}else{
			echo "gagal";
		}



	}

	public function cek_ruangan($id,$tanggal){
	// $id = '2';
	// $tanggal = '2019-07-03';
		$cek = $this->MMeeting->cek_ruangan($id,$tanggal);
	// echo json_encode($cek);
		return $cek;
	}


	public function datamakanan_minuman()
	{
		$id = $this->session->userdata('user_id');
		$data2['mitra'] = $this->MMeeting->get_mitra($id);
		$id_mitra = $this->session->userdata('id_mitra');
		$data2['makanan'] = $this->MMeeting->get_makanan_minuman($id_mitra);
		$data2['booking'] = $this->MMeeting->get_booking($id_mitra);
		$data['jml_booking'] = intval(count($data2['booking']));
		$data['content'] = $this->load->view('mitra/pages/data_makanan_minuman',$data2,true);
		$this->load->view('mitra/default',$data);

		// echo json_encode($data2);
	}

	public function hapus_ruang($id){
		$table = 'ruang';
		$param = 'id_ruang';
		$this->MMeeting->hapus($table,$id,$param);
		redirect('Mitra/dataruang');
	}



	public function hapus_makanan_minuman($id){
		$table = 'makanan_minuman';
		$param = 'id_mak_min';
		$this->MMeeting->hapus($table,$id,$param);
		redirect('Mitra/datamakanan');
	}



	public function save_ruang(){

		$id_mitra = $this->session->userdata('id_mitra');
		$new_name = 'ruang_mitra'.$id_mitra.time();

		$nama_file = $_FILES["foto"]['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$nama_upload = $new_name.".".$ext;


		$data['nama_ruangan'] = $_POST['nama'];
		$data['id_mitra'] = $id_mitra;
		$data['kapasitas'] = $_POST['kapasitas'];
		$data['fasilitas'] = $_POST['fasilitas'];
		$data['harga'] = $_POST['harga'];
		$data['foto']=$nama_upload;
		$data['detail_foto']='default.jpeg';

		$config['upload_path']          = './foto_ruang/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
		$config['max_size']             = 5000;
		$config['file_name']             = $new_name;


		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('alert','gagal');
			// redirect('guru/indonesia_apetizer');
			// redirect($_SERVER['HTTP_REFERER']);

			echo json_encode($error);
		}else{
			$datas = array('upload_data' => $this->upload->data());
			$tabel = 'ruang';
			$this->MMeeting->tambah_data($tabel,$data);
			$this->session->set_flashdata('alert','berhasil');
			redirect($_SERVER['HTTP_REFERER']);

		}


	}

	public function update_ruangan(){

		$id = $this->input->post('id');
		$data['nama_ruangan'] = $this->input->post('nama');
		$data['harga'] = $this->input->post('harga');
		$data['fasilitas'] = $this->input->post('fasilitas');
		if (!empty($nama_file = $_FILES["foto"]['name'])) {
			$new_name = 'ruang_mitra'.$this->session->userdata('id_mitra').time();

			$nama_file = $_FILES["foto"]['name'];
			$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
			$nama_upload = $new_name.".".$ext;



			$data['foto']=$nama_upload;

			$config['upload_path']          = './foto_ruang/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
			$config['max_size']             = 5000;
			$config['file_name']             = $new_name;


			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('foto')){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('alert','gagal');
			// redirect('guru/indonesia_apetizer');
			// redirect($_SERVER['HTTP_REFERER']);

				echo json_encode($error);
			}else{
				$datas = array('upload_data' => $this->upload->data());
				$tabel = 'ruang';
				$this->MMeeting->update_data($tabel,$id,'id_ruang',$data);
				$this->session->set_flashdata('alert','berhasil');
				redirect($_SERVER['HTTP_REFERER']);

			}
		}else{
			$tabel = 'ruang';
			$this->MMeeting->update_data($tabel,$id,'id_ruang',$data);
			$this->session->set_flashdata('alert','berhasil');
			redirect($_SERVER['HTTP_REFERER']);
		}



	}

	public function update_makmin(){

		$id = $this->input->post('id');
		$data['nama'] = $this->input->post('nama');
		$data['harga'] = $this->input->post('harga');
		$data['deskripsi'] = $this->input->post('deskripsi');
		if (!empty($nama_file = $_FILES["foto"]['name'])) {
			$new_name = 'ruang_mitra'.$this->session->userdata('id_mitra').time();

			$nama_file = $_FILES["foto"]['name'];
			$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
			$nama_upload = $new_name.".".$ext;



			$data['foto']=$nama_upload;

			$config['upload_path']          = './foto_makanan_minuman/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
			$config['max_size']             = 5000;
			$config['file_name']             = $new_name;


			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('foto')){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('alert','gagal');
			// redirect('guru/indonesia_apetizer');
			// redirect($_SERVER['HTTP_REFERER']);

				echo json_encode($error);
			}else{
				$datas = array('upload_data' => $this->upload->data());
				$tabel = 'makanan_minuman';
				$this->MMeeting->update_data($tabel,$id,'id_mak_min',$data);
				$this->session->set_flashdata('alert','berhasil');
				redirect($_SERVER['HTTP_REFERER']);

			}
		}else{
			$tabel = 'makanan_minuman';
			$this->MMeeting->update_data($tabel,$id,'id_mak_min',$data);
			$this->session->set_flashdata('alert','berhasil');
			redirect($_SERVER['HTTP_REFERER']);
		}



	}

	public function save_makanan_minuman(){

		$id_mitra = $this->session->userdata('id_mitra');
		$new_name = 'foodbev_'.$id_mitra.time();

		$nama_file = $_FILES["foto"]['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$nama_upload = $new_name.".".$ext;


		$data['nama'] = $_POST['nama'];
		$data['id_mitra'] = $id_mitra;
		$data['harga'] = $_POST['harga'];
		$data['deskripsi'] = $_POST['deskripsi'];

		$data['foto']=$nama_upload;

		$config['upload_path']          = './foto_makanan_minuman/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 5000;
		$config['file_name']             = $new_name;


		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('alert','gagal');
			// redirect('guru/indonesia_apetizer');
			// redirect($_SERVER['HTTP_REFERER']);

			echo json_encode($error);
		}else{
			$datas = array('upload_data' => $this->upload->data());
			$tabel = 'makanan_minuman';
			$this->MMeeting->tambah_data($tabel,$data);
			$this->session->set_flashdata('alert','berhasil');
			redirect($_SERVER['HTTP_REFERER']);

		}


	}

	public function save_makanan(){

		$id_mitra = $this->session->userdata('id_mitra');
		$new_name = 'makanan'.$id_mitra.time();

		$nama_file = $_FILES["foto"]['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$nama_upload = $new_name.".".$ext;


		$data['nama'] = $_POST['nama'];
		$data['id_mitra'] = $id_mitra;
		$data['harga'] = $_POST['harga'];
		$data['deskripsi'] = $_POST['deskripsi'];
		$data['foto']=$nama_upload;

		$config['upload_path']          = './foto_makanan_minuman/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 5000;
		$config['file_name']             = $new_name;


		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('alert','gagal');
			// redirect('guru/indonesia_apetizer');
			// redirect($_SERVER['HTTP_REFERER']);

			echo json_encode($error);
		}else{
			$datas = array('upload_data' => $this->upload->data());
			$tabel = 'makanan';
			$this->MMeeting->tambah_data($tabel,$data);
			$this->session->set_flashdata('alert','berhasil');
			redirect($_SERVER['HTTP_REFERER']);

		}


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
		</table>';


	}

	public function save_mitra(){
		$data['id_user'] = $this->session->userdata('user_id');
		$data['nama_mitra'] = $_POST['nama'];
		$data['alamat'] = $_POST['alamat'];
		$data['longitude'] = $_POST['longitude'];
		$data['latitude'] = $_POST['latitude'];
		$data['no_telp'] = $_POST['nomor'];
		$data['nama_pemilik'] = $_POST['pemilik'];
		$data['nama_bank'] = $_POST['bank'];
		$data['nomor_rekening'] = $_POST['rekening'];

		$data['nama_akun_bank'] = $_POST['nama_rekening'];

		$tabel = 'mitra';
		$new_name = 'siup'.time();

		$nama_file = $_FILES["foto"]['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$nama_upload = $new_name.".".$ext;

		$data['siup']=$nama_upload;

		$config['upload_path']          = './foto_siup/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 5000;
		$config['file_name']             = $new_name;


		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('alert','gagal');
			// redirect('guru/indonesia_apetizer');
			// redirect($_SERVER['HTTP_REFERER']);

			echo json_encode($error);
		}else{

			$this->MMeeting->tambah_data($tabel,$data);
			$this->session->set_flashdata('alert','berhasil');
			// redirect('mitra');
			redirect($_SERVER['HTTP_REFERER']);

		}
	}
}
