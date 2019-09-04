<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Data makanan Meeting</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">

			<h6 class="m-0 font-weight-bold text-primary">Data makanan  Meeting 
				<?php if (!empty($mitra)) { ?>
					<a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fa fa-plus"></i> Tambah makanan</a>
				<?php } ?>
			</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>

							<th>Nama makanan</th>
							<th>Harga</th>
							<th>Deskripsi</th>
							<th>Foto</th>
							<th>Action</th>
						</tr>
					</thead>


					<tbody>
						<?php foreach ($makanan as $r) { ?>
							<tr>
								<td><?php echo $r->nama; ?></td>
								<td><?php echo $r->harga; ?></td>
								<td><?php echo $r->deskripsi; ?></td>
								<td><img style="height: 10%" src="<?php echo base_url() ?>foto_makanan_minuman/<?php echo $r->foto  ?>"></td>
								
								<td>
									<a href="<?php echo base_url() ?>Mitra/hapus_makanan_minuman/<?php echo $r->id_mak_min ?>" class="btn btn-danger">Delete</a>
									<a 
									href="javascript:;"
									data-id="<?php echo $r->id_mak_min ?>"
									data-nama="<?php echo $r->nama ?>"
									data-deskripsi="<?php echo $r->deskripsi ?>"
									data-harga="<?php echo $r->harga ?>"
									data-foto="<?php echo $r->foto ?>"
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
				<h5 class="modal-title" id="exampleModalLabel">Tambah Makanan / Minuman</h5>
				<a href="#" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form action='<?php echo base_url() ?>Mitra/save_makanan_minuman' method="POST" enctype="multipart/form-data">

					<div class="form-group">
						<label for="inputText3" class="col-form-label">Nama makanan / minuman</label>
						<input id="inputText3" name="nama" type="text" class="form-control" placeholder="Nama makanan/minuman...">

					</div>

					<div class="form-group">
						<label for="inputText3" class="col-form-label">Harga</label>
						<input id="inputText3" name="harga" type="number" class="form-control" placeholder="Harga Rp...">

					</div>
					<div class="form-group">
						<label for="inputText3" class="col-form-label">Deskripsi</label>
						<!--<input id="inputText3" name="harga" type="number" class="form-control" placeholder="Isi Jika Diperlukan...">-->
						<textarea name="deskripsi" class="form-control"></textarea>

					</div>

					



					<div class="form-group">
						<label for="inputText3" class="col-form-label">Foto</label>
						<p>*file yang diterima hanya berekstensi .jpg, .jpeg, .png</p>
						<input type="file" accept="image/jpg, image/jpeg, image/png" name="foto">

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
			<form class="form-horizontal" action="<?php echo base_url('Mitra/update_makmin')?>" method="post" enctype="multipart/form-data" role="form">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">Nama</label>

						<div class="col-lg-12">
							<input type="hidden" id="id" name="id">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Cabang">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">Harga</label>
						<div class="col-lg-12">
							<input type="text" class="form-control" id="harga" name="harga" placeholder="Harga">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-4 col-sm-4 control-label">deksripsi</label>
						<div class="col-lg-12">
							<input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="deskripsi">
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
            modal.find('#deskripsi').attr("value",div.data('deskripsi'));
            modal.find('#harga').attr("value",div.data('harga'));
            modal.find('#foto').attr('src','<?php echo base_url()?>foto_makanan_minuman/'+div.data('foto'));


        });
    });
</script>