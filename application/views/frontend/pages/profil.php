    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Profil</h2>
                <p>Temukan Ruang Meeting di terbaikmu</p>
            </div>
            <div class = "container">
                <table class="table table-striped">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo $profil->nama?></td>
                    </tr>
                  <!--   <tr>
                        <td>No.HP</td>
                        <td>:</td>
                        <td><?php echo $profil->no_hp?></td>
                    </tr> -->
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $profil->email?></td>
                    </tr>
                </table>
                <center>
                    <a 
                    href="javascript:;"
                    data-id="<?php echo $profil->id_user ?>"
                    data-nama="<?php echo $profil->nama ?>"
                    data-toggle="modal" data-target="#edit-data">
                    <button  data-toggle="modal" data-target="#ubah-data" class="btn btn-warning">Edit Profil</button></a>
                </center>
            </div>
            <div class="container" style="margin-top: 10%">

                <h1>Histori Pesanan Anda</h1>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ruang</th>
                            <th>Lama</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Makanan/Minuman</th>
                            <th>Total</th>

                        </tr>
                    </thead>


                    <tbody>
                        <?php $no=1; foreach ($booking as $r) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $r->nama_ruangan; ?></td>
                                <td><?php echo $r->lama; ?> jam</td>
                                <td><?php echo $r->tanggal; ?></td>
                                <td><?php echo $r->jam; ?></td>
                                <td><?php echo $r->makan_minum; ?></td>
                                <td>Rp. <?php echo $r->total; ?></td>


                            </tr>
                        <?php } ?>



                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-data" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Profil</h4>
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>

                </div>
                <form class="form-horizontal" action="<?php echo base_url('Frontend/update_profil')?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-lg-4 col-sm-4 control-label">Nama</label>

                            <div class="col-lg-12">
                                <input type="hidden" id="id" name="id_user">
                                <input type="text" required class="form-control" id="nama" name="nama" placeholder="Nama Cabang">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-4 col-sm-4 control-label">Password</label>

                            <div class="col-lg-12">
                                <input type="hidden" id="id" name="id">
                                <input type="text" class="form-control" id="password" name="password" placeholder="Kosongkan Jika ingin mengganti password">
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

            <?php if (!empty($this->session->flashdata('alert'))) {     ?>
                alert("Berhasil Merubah Profil");
            <?php }?>


        // Untuk sunting
        $('#edit-data').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("value",div.data('id'));
            modal.find('#nama').attr("value",div.data('nama'));


        });
    });
</script>