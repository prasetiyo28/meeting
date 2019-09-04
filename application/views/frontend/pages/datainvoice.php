    <section class="accomodation_area section_gap">
        <div class="container">

            <div class="container" style="margin-top: 10%">
                <div class="section_title text-center">

                    <h1>Invoice Pesanan Anda</h1>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ruang</th>
                            <th>Lama</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Makanan/Minuman</th>
                            <th>Status</th>
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
                                <td><?php if ($r->status == '1') { ?>
                                    <a target="_blank" class="btn btn-success" href="<?php echo base_url() ?>Frontend/cetak_invoice/<?php echo $r->id_booking ?>">Cetak</a>
                                </td>
                            <?php }else{ ?>
                                <a target="_blank" class="btn btn-info" href="<?php echo $r->url ?>">Bayar</a>
                                <?php } ?></td>
                                <td>Rp. <?php echo $r->total; ?></td>


                            </tr>
                        <?php } ?>



                    </tbody>
                </table>
            </div>
        </div>
    </section>