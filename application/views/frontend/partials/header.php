<header class="header_area">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="<?php echo base_url() ?>"><img style="height: 5%"  src="<?php echo base_url()?>assets/image/co.png"  alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
             
                <?php if ($this->session->userdata('jenis_user') == '0') { ?>
                    <ul class="nav navbar-nav menu_nav ml-auto">

                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello , <?php echo $this->session->userdata('nama') ?> !</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>frontend/profil">Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>frontend/invoice">Invoice</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>login/logout">Logout</a></li>
                            </ul>
                        </li>  

                    </ul>                 
                <?php }else{ ?>
                  <ul class="nav navbar-nav menu_nav ml-auto">
                      
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>">Home</a></li> 
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>frontend/login">Login</a></li> 
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>frontend/register">Register</a></li> 

                </ul>
            <?php } ?>

        </div> 
    </nav>
</div>
</header>   