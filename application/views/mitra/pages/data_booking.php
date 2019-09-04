<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Data Booking Masuk</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">

			<h6 class="m-0 font-weight-bold text-primary">Data Booking Ruang Meeting 
				<?php if (!empty($mitra)) { ?>
					
				<?php } ?>
				<br>

			</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>

							<th>Pemesan</th>
							<th>Ruang</th>
							<th>Lama</th>
							<th>Tanggal</th>
							<th>Jam</th>
							<th>Harga</th>
							<th>Makanan/Minuman</th>
							<th>Catatan Khususu</th>
							<th>Total</th>
							<th>Action</th>
						</tr>
					</thead>


					<tbody>
						<?php foreach ($booking as $r) { ?>
							<tr>
								<td><?php echo $r->nama; ?></td>
								<td><?php echo $r->nama_ruangan; ?></td>
								<td><?php echo $r->lama; ?> jam</td>
								<td><?php echo $r->tanggal; ?></td>
								<td><?php echo $r->jam; ?></td>
								<td><?php echo $r->harga; ?> /Jam</td>
								<td><?php echo $r->makan_minum; ?></td>
								<td><?php echo $r->catatan_khusus; ?></td>
								<td>Rp. <?php echo $r->total; ?></td>
								
								<td>
									<?php if ($r->status=='1'): ?>
										<a href="<?php echo base_url() ?>Mitra/konfirmasi_selesai/<?php echo $r->id_booking ?>" class="btn btn-danger">Konfirmasi</a>										
										<?php else: ?>
											Selesai
										<?php endif ?>


									</td>

								</tr>
							<?php } ?>



						</tbody>
					</table>
				</div>
			</div>


		</div>

		<div class="card shadow mb-4">
			<div class="card-header py-3">

				<h6 class="m-0 font-weight-bold text-primary">Data Booking Offline Ruang Meeting 
					<?php if (!empty($mitra)) { ?>

					<?php } ?>
					<br>

					<a href="#" data-toggle="modal" data-target="#exampleModal"class="btn btn-info">Booking Ruangan</a>
				</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>

								<th>Ruang</th>
								<th>Lama</th>
								<th>Tanggal</th>
								<th>Jam</th>
								<th>Harga</th>
								<th>Makanan/Minuman</th>
								<th>Catatan Khususu</th>
								<th>Total</th>
								<th>Action</th>
							</tr>
						</thead>


						<tbody>
							<?php foreach ($offline as $r) { ?>
								<tr>
									<td><?php echo $r->nama_ruangan; ?></td>
									<td><?php echo $r->lama; ?> jam</td>
									<td><?php echo $r->tanggal; ?></td>
									<td><?php echo $r->jam; ?></td>
									<td><?php echo $r->harga; ?> /Jam</td>
									<td><?php echo $r->makan_minum; ?></td>
									<td><?php echo $r->catatan_khusus; ?></td>
									<td>Rp. <?php echo $r->total; ?></td>

									<td>
										<?php if ($r->status=='1'): ?>
											<a href="<?php echo base_url() ?>Mitra/konfirmasi_selesai/<?php echo $r->id_booking ?>" class="btn btn-danger">Konfirmasi</a>										
											<?php else: ?>
												Selesai
											<?php endif ?>


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
						<h5 class="modal-title" id="exampleModalLabel">Booking Ruangan</h5>
						<a href="#" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</a>
					</div>
					<div class="modal-body">
						<form action='<?php echo base_url() ?>Mitra/save_booking' method="POST" enctype="multipart/form-data">

							<div class="form-group">
								<label for="inputText3" class="col-form-label">Pilih Ruangan</label>
								<select name="id_ruang" class="form-control">
									<option value="">-Pilih Ruangan-</option>
									<?php foreach ($ruangan as $r) { ?>
										<option value="<?php echo $r->id_ruang ?>"><?php echo $r->nama_ruangan; ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label for="inputText3" class="col-form-label">Tanggal Booking</label>
								<div class='input-group date' id='datetimepicker2'>
									<input required name="tanggal" type='text' class="form-control" placeholder="Tanggal Booking"/>
									<span class="input-group-addon">
										<i class="fa fa-calendar" aria-hidden="true"></i>
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="inputText3" class="col-form-label">Lama</label>
								<select name="lama" required class="form-control">
									<option value="1">1 Jam</option>
									<option value="2">2 Jam</option>
									<option value="3">3 Jam</option>
									<option value="4">4 Jam</option>
									<option value="5">5 Jam</option>

								</select>

							</div>


							<div class="form-group">
								<label for="inputText3" class="col-form-label">Catatan Makanan</label>
								<textarea name="catatan" class="form-control" placeholder="Catatan Makanan"></textarea>

							</div>

							<div class="form-group">
								<label for="inputText3" class="col-form-label">Catatan Khusus</label>
								<input required name="khusus" type='text' class="form-control" placeholder="Catatan Khusus"/>

							</div>
							<div class="form-group">
								<label for="inputText3" class="col-form-label">Total</label>
								<input required name="total" type='number' class="form-control" placeholder="Total"/>
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

				var date2 = new Date();

				$('#datetimepicker2').datetimepicker({
					startDate: date2,

				});

			});
		</script>

		<script src="<?php echo base_url()?>assets/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js"></script>

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
