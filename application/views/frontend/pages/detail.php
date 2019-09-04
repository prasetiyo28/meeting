  <section class="blog_area single-post-area">
    <div class="container">
       <div class="section_title text-center">
        <h2 class="title_color"><?php echo $ruang->nama_mitra; ?></h2>
        <p><?php echo $ruang->alamat; ?></p>
    </div>
    <div class="row">

        <div class="col-lg-8 posts-list">
            <div class="single-post row">
                <div class="col-lg-12">
                    <div class="feature-img">
                        <img class="img-fluid" src="" alt="">
                    </div>                                  
                </div>
                <div class="col-lg-3  col-md-3">
                    <div class="blog_info text-right">

                        <ul class="blog_meta list_style">
                            <li><a ><?php echo $ruang->keterangan; ?><i class="fa fa-user"></i></a></li>
                            <li><a>Rp.<?php echo $ruang->harga; ?> / Jam<i class="fa fa-money"></i></a></li>
                            <li><b>Fasilitas: </b><br><?php echo $ruang->fasilitas ?></li>

                        </ul>
                        
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 blog_details">
                    <h2><Center><?php echo $ruang->nama_ruangan; ?></Center></h2>
                    <img src="<?php echo base_url() ?>foto_ruang/<?php echo $ruang->foto ?>" class="img-thumbnail" >

                    <h2>Makanan & Minuman</h2>    
                    <div class="row">
                        <?php foreach ($makmin as $row) : ?>
                            <div class="col-md-4" style="margin: 5%">
                                <div class="thumbnail">
                                    <img height="200" src="<?php echo base_url().'foto_makanan_minuman/'.$row->foto;?>">
                                    <div class="caption">
                                        <h4><?php echo $row->nama;?></h4>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <h4><?php echo 'Rp '.number_format($row->harga);?></h4>
                                                <p><?php echo $row->deskripsi; ?></p>
                                            </div>

                                            <div class="col-md-12">
                                                <input type="number" name="quantity" id="<?php echo $row->id_mak_min;?>" value="0" class="quantity form-control">
                                            </div>
                                        </div>
                                        <button class="add_cart btn btn-success btn-block" data-produkid="<?php echo $row->id_mak_min;?>" data-produknama="<?php echo $row->nama;?>" data-produkharga="<?php echo $row->harga;?>">Tambahkan</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>

                    </div>


                    <center>
                        <?php if ($this->session->userdata('user_id')=='') {?>
                            <a href="<?php echo base_url() ?>frontend/login" class="genric-btn primary">
                                Booking Now
                            </a>
                        <?php }else{ ?>


                            <a href="javascript:;"
                            data-id_ruang="<?php echo $ruang->id_ruang ?>"
                            data-nama="<?php echo $ruang->nama_ruangan ?>"
                            data-harga="<?php echo $ruang->harga ?>"
                            data-toggle="modal" data-target="#exampleModal" class="genric-btn primary">Booking</a>
                        <?php } ?>
                        <a href="hasilpencarian.html" class="genric-btn primary-border">Batal</a>
                    </center>
                </div>

            </div>
            <div class="navigation-area">
                <div class="row">
                    <center>

                    </center>
                </div>
            </div>


        </div>
        <div class="col-lg-4">
            <div class="blog_right_sidebar">
                <aside class="single_sidebar_widget search_widget">
                    <center><h2>Temukan di Peta</h2></center>
                    <div class="br"></div>
                </aside>
                <aside class="single_sidebar_widget author_widget">
                 <map>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15844.700854494906!2d109.1285756!3d-6.8695975!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4d130a049b5b7860!2sJ.Co+Donuts+Coffee+Tegal!5e0!3m2!1sen!2sid!4v1553703504503" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
                </map>
            </aside>
            <div>
                <h4>Makanan & Minuman </h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="detail_cart">

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>
</section>







<script type="text/javascript">
    $(document).ready(function(){
        $('.add_cart').click(function(){
            var produk_id    = $(this).data("produkid");
            var produk_nama  = $(this).data("produknama");
            var produk_harga = $(this).data("produkharga");
            var quantity     = $('#' + produk_id).val();
            $.ajax({
                url : "<?php echo base_url();?>frontend/add_to_cart",
                method : "POST",
                data : {produk_id: produk_id, produk_nama: produk_nama, produk_harga: produk_harga, quantity: quantity},
                success: function(data){
                    $('#detail_cart').html(data);
                }
            });
        });

        $('.add_makanan').click(function(){
            var produk_id    = $(this).data("produkid");
            var produk_nama  = $(this).data("produknama");
            var produk_harga = $(this).data("produkharga");
            var quantity     = $('#' + produk_id).val();
            $.ajax({
                url : "<?php echo base_url();?>frontend/add_to_cart",
                method : "POST",
                data : {produk_id: produk_id, produk_nama: produk_nama, produk_harga: produk_harga, quantity: quantity},
                success: function(data){
                    $('#detail_cart').html(data);
                }
            });
        });

        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url();?>frontend/load_cart");

        //Hapus Item Cart
        $(document).on('click','.hapus_cart',function(){
            var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url : "<?php echo base_url();?>frontend/hapus_cart",
                method : "POST",
                data : {row_id : row_id},
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });
    });
</script>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Minuman</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <form action='<?php echo base_url() ?>frontend/save_booking' method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Nama Ruangan</label>
                        <input id="id_ruang" value="<?php echo $ruang->id_ruang ?>" name="id_ruang" type="hidden" class="form-control">
                        <input id="nama" name="nama" type="text" class="form-control" value="<?php echo $ruang->nama_ruangan ?>" readonly>

                    </div>

                    <div>
                        <label for="inputText3" class="col-form-label">Lama Penggunaan</label>
                        <input id="lama" name="lama" type="text" class="form-control" value="<?php echo $this->session->userdata('lama') ?>" required readonly>

                    </div>

                    <div>
                        <label for="inputText3" class="col-form-label">Tanggal</label>
                        <input id="tanggal" name="tanggal" type="text" readonly class="form-control" value="<?php echo $this->session->userdata('tanggal') ?>" required>

                    </div>


                    <div>
                        <label for="inputText3" class="col-form-label">jam</label>
                        <input id="jam" name="jam" type="time" class="form-control" value="<?php echo $this->session->userdata('jam') ?>" required readonly>

                    </div>

                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Harga per jam</label>
                        <input id="harga" name="harga" type="number" class="form-control" value="<?php echo $ruang->harga ?>" readonly>

                    </div>

                    <div>
                        <label for="inputText3" class="col-form-label">Catatan</label>
                        <textarea class="form-control" name="catatan" rows="5" id="detail" readonly></textarea>

                    </div>

                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Catatan Khusus</label>
                        <input id="khusus" name="khusus" type="text" class="form-control" placeholder="Catatan Khusus...">

                    </div>

                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Total</label>
                        <input id="total" name="total" type="number" class="form-control" placeholder="Total Rp..." readonly>

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
        var makanan = 0;
        var total = 0;
        var lama = 0;
        var harga = $('#harga').val();



        $('#exampleModal').on('show.bs.modal', function (e) {


            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)

            // Isi nilai pada field
            modal.find('#id_ruang').attr("value",div.data('id_ruang'));
            modal.find('#nama').attr("value",div.data('nama'));
            modal.find('#harga').attr("value",div.data('harga'));
            
            lama = $('#lama').val();
            total = parseInt(harga) * parseInt(lama) + parseInt(makanan);
            $('#total').val(total);

            $.ajax({
                type : 'post',
                url : '<?php echo base_url() ?>frontend/show_order',
                success : function(data){
                $('#detail').val(data);//menampilkan data ke dalam modal
            }
        });

            $.ajax({
                type : 'post',
                url : '<?php echo base_url() ?>frontend/show_total',
                success : function(data){
                    makanan = data;
                    console.log(makanan);
                // $('#total').val(data);//menampilkan data ke dalam modal
            }
        });


        });





    });
</script>
