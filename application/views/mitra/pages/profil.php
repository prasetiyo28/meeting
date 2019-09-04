<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Profil</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" cellspacing="0">
					<tr>
						<td>Nama Mitra </td>
						<td>: </td>
						<td><?php echo  $mitra->nama_mitra?></td>
					</tr>
					<tr>
						<td>Alamat </td>
						<td>: </td>
						<td><?php echo  $mitra->alamat?></td>
					</tr>
					<tr>
						<td>Telpon </td>
						<td>: </td>
						<td><?php echo  $mitra->nama_mitra?></td>
					</tr>
					<tr>
						<td>Nama Bank </td>
						<td>: </td>
						<td><?php echo  $mitra->nama_bank?></td>
					</tr>
					<tr>
						<td>Nama Akun Bank </td>
						<td>: </td>
						<td><?php echo  $mitra->nama_akun_bank?></td>
					</tr>
					<tr>
						<td>Nomor Rekening </td>
						<td>: </td>
						<td><?php echo  $mitra->nomor_rekening?></td>
					</tr>
					<tr>
						<td>Nama Pemilik </td>
						<td>: </td>
						<td><?php echo  $mitra->nama_pemilik?></td>
					</tr>
				</table>
			</div>

			<a 
			href="javascript:;"
			data-id="<?php echo $mitra->id_mitra ?>"
			data-id_user="<?php echo $mitra->id_user ?>"
			data-alamat="<?php echo $mitra->alamat ?>"
			data-nama="<?php echo $mitra->nama_mitra ?>"
			data-long="<?php echo $mitra->longitude ?>"
			data-lat="<?php echo $mitra->latitude ?>"
			data-telpon="<?php echo $mitra->no_telp ?>"
			data-toggle="modal" data-target="#edit-data">
			<button  data-toggle="modal" data-target="#ubah-data" class="btn btn-warning">Edit Profil</button>
		</a>
	</div>
</div>

</div>
<!-- /.container-fluid -->





<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Profil</h4>
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				
			</div>
			<form class="form-horizontal" action="<?php echo base_url('Mitra/update_profil')?>" method="post" enctype="multipart/form-data" role="form">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">Nama Mitra</label>

						<div class="col-lg-12">
							<input type="hidden" id="id" name="id_mitra">
							<input type="hidden" id="id_user" name="id_user">
							<input type="text" class="form-control" id="nama" name="nama"  readonly placeholder="Nama Mitra">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">Alamat</label>
						<div class="col-lg-12">
							<input type="text" readonly class="form-control" id="alamat" name="alamat" placeholder="alamat">
						</div>
					</div>

					<div class="col-sm-12">
						<?php echo $map['html'] ?>
					</div>

					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">Longitude</label>
						<div class="col-lg-12">
							<input type="text" class="form-control" id="longitude" readonly name="longitude" placeholder="longitude">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">Latitude</label>
						<div class="col-lg-12">
							<input readonly type="text" class="form-control" id="latitude" name="latitude" placeholder="latitude">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">Telpon</label>
						<div class="col-lg-12">
							<input type="text" pattern="[0-9+]+" class="form-control" id="telpon" name="no_telp" placeholder="No_telp">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">Password</label>
						<div class="col-lg-12">
							<input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan Jika tidak ingin mengganti password">
						</div>
					</div>


					

				</div>
				<div class="modal-footer">
					<button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- END Modal Ubah -->

<script>
	$(document).ready(function() {
        // Untuk sunting
        $('#edit-data').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("value",div.data('id'));
            modal.find('#id_user').attr("value",div.data('id_user'));
            modal.find('#nama').attr("value",div.data('nama'));
            modal.find('#alamat').attr("value",div.data('alamat'));
            modal.find('#telpon').attr("value",div.data('telpon'));
            modal.find('#longitude').attr("value",div.data('long'));
            modal.find('#latitude').attr("value",div.data('lat'));


        });
    });
</script>

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
