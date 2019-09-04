<section class="banner_area">
    <div class="booking_table d_flex align-items-center">
     <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
     <div class="container">
        <center>
            <div class="col-4">

                <div class="comment-form">
                 <?php if ($this->session->flashdata('alert') == 'berhasil') { ?>
                    <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Registrasi Berhasil !, Cek Email Untuk Verifikasi
                    </div>
                <?php }?>

                <?php if ($this->session->flashdata('alert') == 'gagal') { ?>
                    <div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        email/password yang anda masukan tidak sesuai
                    </div>
                <?php }?>

                <img style="height: 5%" src="<?php echo base_url() ?>assets/image/co.png">
                <h1>Reset Password</h1>
                <form action="<?php echo base_url() ?>Frontend/reset" method="post">


                    <input type="hidden" value="<?php echo $this->uri->segment(3) ?>" name="id_user">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control mb-10" rows="5" name="password" placeholder="masukan password baru" onfocus="this.placeholder = ''" onblur="this.placeholder = 'masukan password baru'" required="">
                    </div>

                    <button type="submit" class="primary-btn button_hover">Reset Passowrd</button>   
                </form>
            </div>
        </div>
    </center>
</div>
</div>
</section>


<script>
    $(document).ready(function() {

        <?php if (!empty($this->session->flashdata('alerts'))) {     ?>
            alert("<?php echo $this->session->flashdata('alerts'); ?>");
        <?php }?>


    });
</script>