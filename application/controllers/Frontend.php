<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('MMeeting');

	}
	
	public function index()
	{
		$data['banner'] = 'true';
		$data['content'] = '';
		$this->load->view('frontend/default',$data);
	}

	public function hasilpencarian()
	{

		if ($this->input->post('tanggal') == '' || $this->input->post('lama')=='' || $this->input->post('jumlah')=='') {
			redirect('Frontend');
		}
		$tanggal = strtotime($this->input->post('tanggal'));
		$tgl = date('Y-m-d',$tanggal);
		$jam = date("H:i",$tanggal);
		$pencarian['tanggal'] = $tgl;
		$pencarian['jam'] = $jam;
		$pencarian['lama'] = $this->input->post('lama');
		$pencarian['kapasitas'] = $this->input->post('jumlah');

		$this->session->set_userdata($pencarian);
		$data['banner'] = 'false';
		$ruang = $this->MMeeting->get_pencarian_ruangan(intval($pencarian['kapasitas']));
		foreach ($ruang as $r) {
			$cek = $this->cek_ruangan($r->id_ruang,$tgl);
			$r->status = $cek;
			
		}
		$data2['ruang'] = $ruang;
		// echo json_encode($data2);

		$data['content'] = $this->load->view('frontend/pages/hasilpencarian',$data2,true);
		$this->load->view('frontend/default',$data);

		// echo json_encode($pencarian);
	}

	public function login()
	{
		$data['banner'] = 'false';
		$data['content'] = $this->load->view('frontend/pages/login','',true);
		$this->load->view('frontend/default',$data);
	}

	public function reset_password($id)
	{
		$data['banner'] = 'false';
		$data['content'] = $this->load->view('frontend/pages/reset_password','',true);
		$this->load->view('frontend/default',$data);
	}

	public function reset()
	{
		$id = $this->input->post('id_user');
		$data['password'] = md5($this->input->post('password'));

		$tabel = 'user';
		$this->MMeeting->update_data($tabel,$id,'id_user',$data);
		$this->session->set_flashdata('alerts','Password berhasil diganti');
		redirect('Frontend/login');	
	}

	public function register()
	{
		$data['banner'] = 'false';
		$data['content'] = $this->load->view('frontend/pages/register','',true);
		$this->load->view('frontend/default',$data);
	}

	public function profil(){
		$data['banner'] = 'false';
		$id = $this->session->userdata('user_id');
		$data2['profil'] = $this->MMeeting->get_profil($id);
		$data2['booking'] = $this->MMeeting->get_booking_user($id);
		$data['content'] = $this->load->view('frontend/pages/profil',$data2,true);
		$this->load->view('frontend/default',$data);

	}
	public function invoice(){
		$data['banner'] = 'false';
		$id = $this->session->userdata('user_id');

		$data2['booking'] = $this->MMeeting->get_booking_user($id);
		$data['content'] = $this->load->view('frontend/pages/datainvoice',$data2,true);
		$this->load->view('frontend/default',$data);

	}

	public function save_booking(){
		
		$data['id_ruang'] = $this->input->post('id_ruang');
		$data['id_user'] = $this->session->userdata('user_id');
		$data['lama'] = $this->input->post('lama');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['jam'] = $this->input->post('jam');
		$data['makan_minum'] = $this->input->post('catatan');
		$data['catatan_khusus'] = $this->input->post('khusus');
		$data['bayar'] = 0;
		$data['total'] = $this->input->post('total');

		


		$url = 'https://my.ipaymu.com/payment.htm';  // URL Payment iPaymu           
$params = array(   // Prepare Parameters            
    'key'      => '05E90629-28A8-420D-BE27-D6EBC6FF05B1', // API Key Merchant / Penjual
    'action'   => 'payment',
    'product'  => 'Booking Ruangan',
    'price'    => '0', // Total Harga
    //'price'    => $data['total'], // Total Harga
    'quantity' => 1,
    'comments' => 'Keterangan Produk', // Optional
    'ureturn'  => 'http://mzthree.id/meeting/frontend/invoice/',
    'unotify'  => 'http://mzthree.id/meeting/frontend/konfirmasi/',
    'ucancel'  => 'http://mzthree.id/meeting/frontend/konfirmasi/',

    /* Parameter tambahan untuk custom payment page (hanya menampilkan satu metode pembayaran)
    * ----------------------------------------------- */
    // 'pay_method'  => 'member', // Metode pembayaran yang akan ditampilkan (VA Niaga => niaga, VA BNI => 
    // 'buyer_name'  => 'Agus', // Nama pembeli(opsional) 
    // 'buyer_phone' => '085643281795', // No HP pembeli (opsional)
    'buyer_email' => 'kimballcho.id@mail.com', // Email pembeli (opsional)
    /* ----------------------------------------------- */

    'format'   => 'json' // Format: xml atau json. Default: xml
);

$params_string = http_build_query($params);

//open connection
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($params));
curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

//execute post
$request = curl_exec($ch);



if ( $request === false ) {
	echo 'Curl Error: ' . curl_error($ch);
} else {

	$result = json_decode($request, true);
	$data['url'] = $result['url'];
	$data['ipaymu'] = $result['sessionID'];


}

//close connection
curl_close($ch);




$this->MMeeting->tambah_data('booking',$data);

$id_invoice = $this->MMeeting->get_id_booking($data['id_user']);
$data['invoice'] = $this->MMeeting->get_invoice($id_invoice->id_booking);

$email = $this->session->userdata('email');
$data['banner'] = 'false';
$data2['content'] = $this->load->view('frontend/pages/invoice',$data,true);
$this->cart->destroy();
$invoice2 = $this->send($email,$data2['content']);
$this->load->view('frontend/default',$data2);

// echo json_encode($invoice2);
}

public function cetak_invoice($id)
{
	$data['invoice'] = $this->MMeeting->get_invoice($id);
	$email = $this->session->userdata('email');
	$data['banner'] = 'false';
	$data2['content'] = $this->load->view('frontend/pages/cetakinvoice',$data,true);
	$this->load->view('frontend/default',$data2);
}


public function konfirmasi(){
	// $data['trx_id'] =$this->input->post('trx_id');
	$data['sessionID'] =$this->input->post('sid');
	// $data['status'] =$this->input->post('status');
	// $data['via'] =$this->input->post('via');
	$this->MMeeting->otokon($data['sessionID']);
	// $this->MMeeting->tambah_data('log',$data);
	// echo json_encode($data);
}


public function cek_ruangan($id,$tanggal){
	// $id = '2';
	// $tanggal = '2019-07-03';
	$cek = $this->MMeeting->cek_ruangan($id,$tanggal);
	// echo json_encode($cek);
	return $cek;
}

public function send($email,$data){


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
	$ci->email->from('meetingtegal@mzthree.id', 'Meeting ning tegal');
	$list = array($email);
	$ci->email->to($list);
	$ci->email->subject('Invoice Meeting');


	$ci->email->message($data);
	if ($this->email->send()) {
		// echo 'Email sent.';
	} else {
		show_error($this->email->print_debugger());
	}
}

public function update_profil(){

	$id = $this->input->post('id_user');
	$data['nama'] = $this->input->post('nama');
	if ($this->input->post('password') != '') {
		$data['password'] = md5($this->input->post('password'));
	}

	// echo $id;
	$tabel = 'user';
	$this->MMeeting->update_data($tabel,$id,'id_user',$data);
	$this->session->set_flashdata('alert','berhasil');
	redirect($_SERVER['HTTP_REFERER']);


}


public function detail($id){
	$data['banner'] = 'false';
	$data2['ruang'] = $this->MMeeting->get_tampil_detail($id);
	$data2['makmin'] = $this->MMeeting->get_makanan_minuman($data2['ruang']->id_mitra);
	$data['content'] = $this->load->view('frontend/pages/detail',$data2,true);
	$this->load->view('frontend/default',$data);	
		// echo json_encode($data2);	
}

public function ipaymu()
{
$url = 'https://my.ipaymu.com/payment.htm';  // URL Payment iPaymu           
$params = array(   // Prepare Parameters            
    'key'      => '05E90629-28A8-420D-BE27-D6EBC6FF05B1', // API Key Merchant / Penjual
    'action'   => 'payment',
    'product'  => 'Nama Produk',
    'price'    => '100', // Total Harga
    'quantity' => 1,
    'comments' => 'Keterangan Produk', // Optional
    'ureturn'  => 'http://mzthree.id/meeting/frontend/invoice',
    'unotify'  => 'http://mzthree.id/meeting/frontend/konfirmasi',
    'ucancel'  => 'http://mzthree.id/meeting/frontend/konfirmasi',

    /* Parameter tambahan untuk custom payment page (hanya menampilkan satu metode pembayaran)
    * ----------------------------------------------- */
    'pay_method'  => 'member', // Metode pembayaran yang akan ditampilkan (VA Niaga => niaga, VA BNI => 
    'buyer_name'  => 'Agus', // Nama pembeli(opsional) 
    'buyer_phone' => '085643281795', // No HP pembeli (opsional)
    'buyer_email' => 'kimballcho.id@mail.com', // Email pembeli (opsional)
    /* ----------------------------------------------- */

    'format'   => 'json' // Format: xml atau json. Default: xml
);

$params_string = http_build_query($params);

//open connection
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($params));
curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

//execute post
$request = curl_exec($ch);



return $request;

//close connection
curl_close($ch);
}


	// cart

		function add_to_cart(){ //fungsi Add To Cart
			$data = array(
				'id' => $this->input->post('produk_id'), 
				'name' => $this->input->post('produk_nama'), 
				'price' => $this->input->post('produk_harga'), 
				'qty' => $this->input->post('quantity'), 
			);
			$this->cart->insert($data);
		echo $this->show_cart(); //tampilkan cart setelah added
	}

	function show_cart(){ //Fungsi untuk menampilkan Cart
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
			<tr>
			<td>'.$items['name'].'</td>
			<td>'.number_format($items['price']).'</td>
			<td>'.$items['qty'].'</td>
			<td>'.number_format($items['subtotal']).'</td>
			<td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
			</tr>
			';
		}
		$output .= '
		<tr>
		<th colspan="3">Total</th>
		<th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
		</tr>
		';
		return $output;
	}

	function show_order(){ //Fungsi untuk menampilkan Cart
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .=$items['name'].' : '.number_format($items['price']).' x '.$items['qty'].' = '.number_format($items['subtotal']) ."\r\n";

		}
		echo $output;
	}

	function show_total(){ //Fungsi untuk menampilkan Cart
		
		$output = $this->cart->total();

		echo $output;
	}

	function load_cart(){ //load data cart
		echo $this->show_cart();
	}

	function hapus_cart(){ //fungsi untuk menghapus item cart
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => 0, 
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}


}
