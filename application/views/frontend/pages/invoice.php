    <section class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Invoice</h2>
                <p>Terima kasih atas kepercayaan bertransaksi</p>
            </div>
            <div class = "container">
                <table class="table table-striped">
                    <tr>
                        <td>Nama Ruangan</td>
                        <td>:</td>
                        <td><?php echo $invoice->nama_ruangan?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><?php echo $invoice->tanggal ?></td>
                    </tr>
                    <tr>
                        <td>Jam</td>
                        <td>:</td>
                        <td><?php echo $invoice->jam ?></td>
                    </tr>
                    <tr>
                        <td>Lama</td>
                        <td>:</td>
                        <td><?php echo $invoice->lama ?> Jam</td>
                    </tr>
                    <tr>
                        <td>Makan-Minum</td>
                        <td>:</td>
                        <td><?php echo $invoice->makan_minum ?></td>
                    </tr>

                    <tr>
                        <td>Batas Pembayaran</td>
                        <td>:</td>
                        <td><?php $timestamp = strtotime($invoice->tanggal_booking); echo $time = date("d/m/Y h:i",strtotime($invoice->tanggal_booking. ' + 2 days')); ?></td>
                    </tr>

                    <tr >
                        <td colspan="3">
                            <a href="<?php echo $invoice->url ?>" class="btn btn-info" target="_blank">Klik link berikut untuk melakukan pembayaran</a>
                        </td>
                    </tr>
                </table>


                <center>
                    <a href="<?php echo base_url() ?>/frontend/profil" class="btn btn-back"><i class="fa fa-key"></i>Kembali</a>
                </center>
            </div>
        </div>
    </section>