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


                </table>


            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function(){
            document.getElementById("footer_front").style.display = "none";
            window.print();
        });

    </script>