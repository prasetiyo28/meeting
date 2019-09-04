    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Hasil Pencarian</h2>
                <p>Temukan Ruang Meeting Terbaikmu</p>
            </div>
            <div class="row mb_30">
                <?php foreach($ruang as $row){ ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="accomodation_item text-center">
                            <div class="hotel_img">
                                <img style="height: 20%" src="<?php echo base_url()?>foto_ruang/<?php echo $row->foto?>" alt="">
                                <?php if($row->status == '0'){ ?>
                                    <a href="<?php echo base_url()?>/frontend/detail/<?php echo $row->id_ruang?>" class="btn theme_btn button_hover">Pesan</a>
                                <?php }else{ ?>
                                    <a href="#" class="btn theme_btn_two">Booked</a>
                                <?php } ?>
                            </div>
                            <a href="#"><h4 class="sec_h4"><?php echo $row->nama_ruangan?></h4></a>
                            <h5><?php echo $row->keterangan?></h5>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>