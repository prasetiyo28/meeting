<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Data Ruangan Meeting</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">

			<h6 class="m-0 font-weight-bold text-primary">Data Ruangan  Meeting 
				<?php if (!empty($mitra)) { ?>
					<a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Ruangan</a>
				<?php } ?>
			</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>

							<th>Nama Tempat</th>
							<th>Kapasitas</th>
							<th>Fasilitas</th>
							<th>Harga Sewa</th>
							<th>Foto</th>
							<th>keterangan</th>
							<th>Action</th>
						</tr>
					</thead>


					<tbody>
						<?php foreach ($ruangan as $r) { ?>
							<tr>
								<td><?php echo $r->nama_ruangan; ?></td>
								<td><?php echo $r->keterangan; ?></td>
								<td><?php echo $r->fasilitas; ?></td>
								<td><?php echo $r->harga; ?></td>
								<td><img style="height: 10%" src="<?php echo base_url() ?>foto_ruang/<?php echo $r->foto  ?>"</td>
								<td>
									<?php if ($r->verif == 1) { ?>
										<label class="btn btn-success"><i class="fas fa-check"></i>Verified</label>
									<?php }else{ ?>
										<label class="btn btn-danger btn-sm"><i class="fas fa-exclamation-triangle"></i>Unverified</label>
									<?php } ?>
								</td>
								<td>
									<a href='#DetailRuang' id='custId' data-toggle='modal' data-id="<?php echo $r->id_ruang ?>" class="btn btn-info">Detail</a>
									<a href="<?php echo base_url() ?>Mitra/hapus_ruang/<?php echo $r->id_ruang ?>" class="btn btn-danger">Delete</a>
									<a 
									href="javascript:;"
									data-id="<?php echo $r->id_ruang ?>"
									data-nama="<?php echo $r->nama_ruangan ?>"
									data-harga="<?php echo $r->harga ?>"
									data-foto="<?php echo $r->foto ?>"
									data-fasilitas="<?php echo $r->fasilitas ?>"
									data-toggle="modal" data-target="#edit-data">
									<button  data-toggle="modal" data-target="#ubah-data" class="btn btn-warning">Edit</button>
									
								</td>

							</tr>
						<?php } ?>



					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Ruangan</h5>
				<a href="#" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form action='<?php echo base_url() ?>Mitra/save_ruang' method="POST" enctype="multipart/form-data">

					<div class="form-group">
						<label for="inputText3" class="col-form-label">Nama Ruangan</label>
						<input id="inputText3" name="nama" type="text" class="form-control" placeholder="Nama Ruangan...">

					</div>

					<div class="form-group">
						<label for="inputText3" class="col-form-label">Kapasitas</label>
						<select class="form-control" name="kapasitas">
							<option value="" disabled selected >Pilih Kapasitas</option>
							<?php foreach ($kapasitas as $kap) { ?>
								<option value="<?php echo $kap->id_kapasitas ?>" ><?php echo $kap->keterangan; ?></option>
							<?php } ?>
						</select>
					</div>


					<div class="form-group">
						<label for="inputText3" class="col-form-label">Nama Fasilitas</label>
						<input id="inputText3" required name="fasilitas" type="text" class="form-control" placeholder="Fasilitas...">


					</div>

					<div class="form-group">
						<label for="inputText3" class="col-form-label">Foto</label>
						<p>*file yang diterima hanya berekstensi .jpg, .jpeg, .png</p>
						<input type="file" required accept="image/jpg, image/jpeg, image/png" name="foto">

					</div>

					<!-- <div class="form-group">
						<label for="inputText3" class="col-form-label">Detail Foto</label>
						<p>*file yang diterima hanya berekstensi .jpg, .jpeg, .png</p>
						<input type="file" accept="image/jpg, image/jpeg, image/png" name="foto">

					</div> -->

					<div class="form-group">
						<label for="inputText3" class="col-form-label">Harga</label>
						<input id="inputText3" name="harga" required min="0" type="number" class="form-control" placeholder="Harga...">

					</div>

					<div class="modal-footer">
						<a href="#" class="btn btn-secondary" data-dismiss="modal">Batal</a>
						<input type="submit" value="Simpan" class="btn btn-success">
					</div>


				</form>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('#DetailRuang').on('show.bs.modal', function (e) {
			var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
            	type : 'post',
            	url : '<?php echo base_url() ?>mitra/detail',
            	data :  'id_ruang='+ rowid,
            	success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
            }
        });
        });
	});
</script>

<div class="modal fade" id="DetailRuang" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail Ruang</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="fetched-data"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
			</div>
		</div>
	</div>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Data</h4>
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				
			</div>
			<form class="form-horizontal" action="<?php echo base_url('Mitra/update_ruangan')?>" method="post" enctype="multipart/form-data" role="form">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">Nama Ruangan</label>

						<div class="col-lg-12">
							<input type="hidden" id="id" name="id">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Cabang">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">Fasilitas</label>
						<div class="col-lg-12">
							<input type="text" class="form-control" id="fasilitas" name="fasilitas" placeholder="Fasilitas">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">Harga</label>
						<div class="col-lg-12">
							<input type="text" class="form-control" id="harga" name="harga" placeholder="Harga">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">foto</label>
						<div class="col-lg-12">
							<img src="" style="height: 200px" id="foto">
							<p>kosongkan jika tidak ingin mengganti foto</p>
							<input type="file" class="form-control" name="foto">
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
            modal.find('#nama').attr("value",div.data('nama'));
            modal.find('#harga').attr("value",div.data('harga'));
            modal.find('#fasilitas').attr("value",div.data('fasilitas'));
            modal.find('#foto').attr('src','<?php echo base_url()?>foto_ruang/'+div.data('foto'));


        });
    });
</script>
