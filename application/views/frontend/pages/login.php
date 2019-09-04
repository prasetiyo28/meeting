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
                <h1>Login</h1>
                <form action="<?php echo base_url() ?>login" method="post">


                    <div class="form-group">
                        <input type="text" name="email" class="form-control" id="email" placeholder="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'email'" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control mb-10" rows="5" name="password" placeholder="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'password'" required="">
                    </div>
                    lupa pasword ? <a  href="#" data-toggle="modal" data-target="#exampleModal" >klik disini</a>
                    <button type="submit" class="primary-btn button_hover">Login</button>   
                </form>
            </div>
        </div>
    </center>
</div>
</div>
</section>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <form action='<?php echo base_url() ?>Login/kirim_reset' method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Masukan Email Anda</label>
                        <input id="inputText3" name="email" type="email" class="form-control" placeholder="Masukan Email Anda">

                    </div>
                    <button type="submit" class="btn btn-block btn-warning">Reset password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        <?php if (!empty($this->session->flashdata('alerts'))) {     ?>
            alert("<?php echo $this->session->flashdata('alerts'); ?>");
        <?php }?>


    });
</script>