 <div class="container-fluid">






 	<!-- Content Row -->
 	<div class="row">

 		<!-- Content Column -->
 		<div class="col-lg-12 mb-4">

 			<!-- Project Card Example -->
 			<div class="card shadow mb-4">
 				<div class="card-header py-3">
 					<h6 class="m-0 font-weight-bold text-primary">Welcome</h6>
 				</div>
 				<?php if (empty($mitra)) { ?>
 					<div class="card-body">
 						<h1>Silahkan lengkapi data Mitra anda dengan klik <a  href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">lengkapi data anda</a> untuk dapat menjadi mitra kami </h1>
 					</div>

 				<?php }else{		 ?>
 					<div class="card-body">
 						<h1>Hai <?php echo $this->session->userdata('nama_mitra') ?>, Mitra Meeting</h1>
 					</div>
 				<?php } ?>



 			</div>


 		</div>

 	</div>
 </div>

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Lengkapi Data Mitra</h5>
 				<a href="#" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</a>
 			</div>
 			<div class="modal-body">
 				<form action='<?php echo base_url() ?>Mitra/save_mitra' method="POST" enctype="multipart/form-data">

 					<div class="form-group">
 						<label for="inputText3" class="col-form-label">Nama Mitra</label>
 						<input id="inputText3" name="nama" type="text" required class="form-control" placeholder="Nama Mitra...">

 					</div>
 					<div class="form-group">
 						<label for="inputText3" class="col-form-label">SIUP</label>
 						<input id="inputText3" name="foto" type="file" required class="form-control">

 					</div>


 					<div class="form-group">
 						<label class="col-form-label control-label">Koordinat :</label>
 						<div class="col-sm-12">
 							<input id="input-calendar" required type="text" name="latitude" class="form-control"  placeholder="latitude">
 							
 						</div>
 						<div class="col-sm-12">
 							<input id="input-calendar" required type="text" name="longitude" class="form-control"  placeholder="longitude">
 						</div>
 						<div class="col-sm-12">
 							<?php echo $map['html'] ?>
 						</div>
 					</div>


 					<div class="form-group">
 						<label for="inputText3" class="col-form-label">Alamat</label>
 						<textarea class="form-control" required id="alamat" name="alamat" placeholder="Alamat Mitra..."></textarea>
 					</div>

 					<div class="form-group">
 						<label for="inputText3" class="col-form-label">No Telp</label>
 						<input id="inputText3" required name="nomor" type="text" class="form-control" placeholder="No Telp Mitra...">

 					</div>

 					<div class="form-group">
 						<label for="inputText3" class="col-form-label">Nama Pemilik Mitra</label>
 						<input id="inputText3" required name="pemilik" type="text" class="form-control" placeholder="Nama Pemilik Mitra...">

 					</div>
 					

 					<div class="form-group">
 						<label for="inputText3" class="col-form-label">Nama Bank</label>

 						<select name="bank" required class="form-control">
 							<option value="">-Pilih Bank-</option>
 							<option>BCA (Bank Central Asia)</option>
 							<option>BRI (Bank Rakyat Indonesia)</option>
 							<option>BNI (BANK Nasional Indonesia)</option>
 							<option>CIMB</option>
 							<option>MAYBANK</option>
 							<option>UOB</option>
 						</select>

 					</div>

 					<div class="form-group">
 						<label for="inputText3" class="col-form-label">Nomor Rekening</label>
 						<input required id="inputText3" name="rekening" type="text" class="form-control" placeholder="Nomor Rekening Mitra...">


 					</div>

 					<div class="form-group">
 						<label for="inputText3" class="col-form-label">Nama Account Bank</label>
 						<input required id="inputText3" name="nama_rekening" type="text" class="form-control" placeholder="Nama Account Bank...">

 					</div>





 					


					<!-- <div class="form-group">
						<label for="inputText3" class="col-form-label">Detail Foto</label>
						<p>*file yang diterima hanya berekstensi .jpg, .jpeg, .png</p>
						<input type="file" accept="image/jpg, image/jpeg, image/png" name="foto">

					</div> -->

					
					<div class="modal-footer">
						<a href="#" class="btn btn-secondary" data-dismiss="modal">Batal</a>
						<input type="submit" value="Simpan" class="btn btn-primary">
					</div>


				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function setMapToForm(latitude, longitude) 
	{
		$('input[name="latitude"]').val(latitude);
		$('input[name="longitude"]').val(longitude);

		var geocoder = new google.maps.Geocoder;
		var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
		geocoder.geocode({'location': latlng}, function(results, status) {
			if (status === 'OK') {
				if (results[1]) {
					var kalimat = results[1].formatted_address;
					var cari = kalimat.toLowerCase().search("tegal");
					var cari2 = kalimat.toLowerCase().search("tegal");

					if (cari>0) {
						// $('#form_produksi')[0].reset();
						// $('#modal_add_produksi').modal('show');
						document.getElementById('alamat').value =results[1].formatted_address;
					}else if (cari2>0) {
						// $('#form_produksi')[0].reset();
						// $('#modal_add_produksi').modal('show');
						document.getElementById('alamat').value =results[1].formatted_address;
					}else {
						window.alert("Wilayah Mitra hanya di Tegal.", "");
					}
				} else {
					window.alert('No results found');
				}
			} else {
				window.alert('Geocoder failed due to: ' + status);
			}
		});


	}
</script>