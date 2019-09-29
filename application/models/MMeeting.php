<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MMeeting extends CI_Model{

	function tambah_data($table,$data){
		$this->db->insert($table,$data);
	}

	function cek_login($data){
		$this->db->select('user.*');
		$this->db->from('user');
		$this->db->where($data);
		$query = $this->db->get();
		
		return $query->row();
	}

	

	function cek_id($email){
		$this->db->select('user.*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$this->db->order_by('id_user','DESC');
		$query = $this->db->get();
		
		return $query->row();
	}

	function get_profil($id){
		$this->db->select('user.*');
		$this->db->from('user');
		$this->db->where('id_user',$id);
		$query = $this->db->get();
		
		return $query->row();
	}

	function get_kapasitas(){
		$this->db->where('deleted','0');
		$query = $this->db->get('kapasitas');
		return $query->result();
	}

	function get_ruangan($id){
		$this->db->select('ruang.*, kapasitas.keterangan as keterangan');
		$this->db->from('ruang');
		$this->db->join('kapasitas','ruang.kapasitas = kapasitas.id_kapasitas');
		$this->db->where('ruang.id_mitra',$id);
		$this->db->where('ruang.deleted','0');
		// $this->db->where('ruang.verif','0');
		$query = $this->db->get();
		return $query->result();
	}

	function get_booking($id){
		$this->db->select('booking.*, ruang.nama_ruangan, ruang.harga, user.nama');
		$this->db->from('booking');
		$this->db->join('ruang','booking.id_ruang = ruang.id_ruang');
		$this->db->join('user','booking.id_user = user.id_user');
		$this->db->where('ruang.id_mitra',$id);
		$this->db->where('booking.status>','0');
		$this->db->order_by('booking.tanggal','DESC');
		// $this->db->where('ruang.verif','0');
		$query = $this->db->get();
		return $query->result();
	}

	function get_booking_count($id){
		$this->db->select('booking.*, ruang.nama_ruangan, ruang.harga, user.nama');
		$this->db->from('booking');
		$this->db->join('ruang','booking.id_ruang = ruang.id_ruang');
		$this->db->join('user','booking.id_user = user.id_user');
		$this->db->where('ruang.id_mitra',$id);
		$this->db->where('booking.status','1');
		$this->db->order_by('booking.tanggal','DESC');
		// $this->db->where('ruang.verif','0');
		$query = $this->db->get();
		return $query->result();
	}

	function get_data_booking_count($id){
		$this->db->select('count(*) as jumlah,booking.id_ruang, ruang.nama_ruangan');
		$this->db->from('booking');
		$this->db->join('ruang','booking.id_ruang = ruang.id_ruang');
		$this->db->where('ruang.id_mitra',$id);
		$this->db->where('booking.status > ','0');
		$this->db->group_by('booking.id_ruang');

		// $this->db->where('ruang.verif','0');
		$query = $this->db->get();
		return $query->result();
	}

	function get_booking_offline($id){
		$this->db->select('booking.*, ruang.nama_ruangan, ruang.harga');
		$this->db->from('booking');
		$this->db->join('ruang','booking.id_ruang = ruang.id_ruang');
		$this->db->where('ruang.id_mitra',$id);
		$this->db->where('booking.status>','0');
		$this->db->where('booking.id_user','0');
		$this->db->order_by('booking.tanggal','DESC');
		// $this->db->where('ruang.verif','0');
		$query = $this->db->get();
		return $query->result();
	}

	function get_transaksi_all(){
		$this->db->select('user.nama as pemesan,mitra.nama_mitra as mitra, ruang.nama_ruangan, ruang.harga , booking.status, booking.tanggal');
		$this->db->from('booking');
		$this->db->join('ruang','booking.id_ruang = ruang.id_ruang');
		$this->db->join('user','booking.id_user = user.id_user');
		$this->db->join('mitra','ruang.id_mitra = mitra.id_mitra');
		// $this->db->where('ruang.verif','0');
		$query = $this->db->get();
		return $query->result();
	}

	function get_grafik_transaksi_all(){
		$this->db->select('count(*) as jumlah,mitra.nama_mitra as nama_mitra');
		$this->db->from('booking');
		$this->db->join('ruang','booking.id_ruang = ruang.id_ruang');
		$this->db->join('mitra','ruang.id_mitra = mitra.id_mitra');
		$this->db->group_by('ruang.id_mitra');
		$this->db->where('booking.status >','0');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}

	function get_booking_user($id){
		$this->db->select('booking.*, ruang.nama_ruangan');
		$this->db->from('booking');
		$this->db->join('ruang','booking.id_ruang = ruang.id_ruang');
		$this->db->where('booking.id_user',$id);
		$this->db->order_by('booking.tanggal_booking','DESC');
		// $this->db->where('ruang.verif','0');
		$query = $this->db->get();
		return $query->result();
	}

	function get_id_booking($id){
		$this->db->where('id_user',$id);
		$this->db->order_by('id_booking','desc');
		$query = $this->db->get('booking');
		return $query->row();
	}

	function konfirmasi_selesai($id){
		$this->db->set('status','2');
		$this->db->where('id_booking',$id);
		$this->db->update('booking');
	}

	function cek_ruangan($id,$tanggal){
		$this->db->where('date(booking.tanggal)',date($tanggal));
		$this->db->where('booking.id_ruang',$id);
		$query = $this->db->get('booking');
		return $query->num_rows();
	}

	function get_invoice($id){
		$this->db->select('booking.*, ruang.nama_ruangan');
		$this->db->from('booking');
		$this->db->join('ruang','booking.id_ruang = ruang.id_ruang');
		$this->db->where('booking.id_booking',$id);
		// $this->db->order_by('booking.tanggal','DESC');
		// $this->db->where('ruang.verif','0');
		$query = $this->db->get();
		return $query->row();
	}

	function get_minuman($id){
		$this->db->where('id_mitra',$id);
		$this->db->where('deleted','0');
		$query = $this->db->get('minuman');
		return $query->result();
	}

	function get_makanan_minuman($id){
		$this->db->where('id_mitra',$id);
		$this->db->where('deleted','0');
		$query = $this->db->get('makanan_minuman');
		return $query->result();
	}

	function get_pencarian_ruangan($kapasitas){
		$this->db->select('ruang.*, kapasitas.keterangan as keterangan');
		$this->db->from('ruang');
		$this->db->join('kapasitas','ruang.kapasitas = kapasitas.id_kapasitas');
		$this->db->where('ruang.deleted','0');
		$this->db->where('ruang.verif','1');
		$this->db->where('ruang.kapasitas >=',$kapasitas);
		$query = $this->db->get();
		return $query->result();
	}

	function get_detail_ruangan($id){
		$this->db->select('ruang.*, kapasitas.keterangan as keterangan, mitra.nama_mitra');
		$this->db->from('ruang');
		$this->db->join('kapasitas','ruang.kapasitas = kapasitas.id_kapasitas');
		$this->db->join('mitra','ruang.id_mitra = mitra.id_mitra');
		$this->db->where('ruang.id_ruang',$id);
		// $this->db->where('ruang.deleted','0');
		// $this->db->where('ruang.verif','0');
		$query = $this->db->get();
		return $query->row();
	}

	function get_tampil_detail($id){
		$this->db->select('ruang.*, kapasitas.keterangan as keterangan, mitra.*');
		$this->db->from('ruang');
		$this->db->join('kapasitas','ruang.kapasitas = kapasitas.id_kapasitas');
		$this->db->join('mitra','ruang.id_mitra = mitra.id_mitra');
		$this->db->where('ruang.id_ruang',$id);
		// $this->db->where('ruang.deleted','0');
		// $this->db->where('ruang.verif','0');
		$query = $this->db->get();
		return $query->row();
	}

	function get_detail_mitra($id){
		$this->db->where('mitra.id_mitra',$id);
		// $this->db->where('ruang.deleted','0');
		// $this->db->where('ruang.verif','0');
		$query = $this->db->get('mitra');
		return $query->row();
	}


	function get_ruangan_all(){
		$this->db->select('ruang.*, kapasitas.keterangan as keterangan , mitra.nama_mitra');
		$this->db->from('ruang');
		$this->db->join('kapasitas','ruang.kapasitas = kapasitas.id_kapasitas');
		$this->db->join('mitra','ruang.id_mitra = mitra.id_mitra');
		$this->db->where('ruang.deleted','0');
		$query = $this->db->get();
		return $query->result();
	}

	function get_mitra_all(){

		$this->db->where('deleted','0');
		$query = $this->db->get('mitra');
		return $query->result();
	}

	function get_user_all(){

		$this->db->where_not_in('jenis_user','2');
		$this->db->where('deleted','0');
		$query = $this->db->get('user');
		return $query->result();
	}

	function get_ruangan_verif($id){
		$this->db->where('id_mitra',$id);
		$this->db->where('deleted','0');
		$this->db->where('verif','1');
		$query = $this->db->get('ruang');
		return $query->result();
	}

	function get_mitra($id){
		$this->db->where('id_user',$id);
		$query = $this->db->get('mitra');
		return $query->row();
	}

	function hapus($table,$id,$param){
		$this->db->set('deleted','1');
		$this->db->where($param,$id);
		$this->db->update($table);
	}

	function verifikasi($table,$id,$param){
		$this->db->set('verifikasi','1');
		$this->db->where($param,$id);
		$this->db->update($table);
	}

	function verif($table,$id,$param){
		$this->db->set('verif','1');
		$this->db->where($param,$id);
		$this->db->update($table);
	}


	function otokon($id){
		$this->db->set('status','1');
		$this->db->where('ipaymu',$id);
		$this->db->update('booking');
	}

	function update_data($table,$id,$param,$data){

		$this->db->where($param,$id);
		$this->db->update($table,$data);
	}


}
?>