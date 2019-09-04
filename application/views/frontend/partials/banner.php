<section class="banner_area">
    <div class="booking_table d_flex align-items-center">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="banner_content text-center">
                <h2>MEETING NING TEGAL</h2>
                <p>Tempat Booking Ruang Meeting Secara Mudah , Cepat & Aman</p>
                
            </div>
        </div>
    </div>
    <div class="hotel_booking_area position">
        <div class="container">
            <form action="<?php echo base_url() ?>frontend/hasilpencarian" method="POST">
                <div class="hotel_booking_table">
                    <div class="col-md-3">
                        <h2>Atur<br>Meetingmu</h2>
                    </div>
                    <div class="col-md-9">
                        <div class="boking_table">
                            <div class="row">

                                <div class="col-md-4">

                                    <div class="book_tabel_item">
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker11'>
                                                <input required name="tanggal" type='text' class="form-control" placeholder="Tanggal Booking"/>
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="book_tabel_item">
                                        <div class="input-group">
                                            <select required class="wide" name="jumlah">
                                                <option data-display="Jumlah Orang">Jumlah Orang</option>
                                                <option value="1"> 10-30 orang </option>
                                                <option value="2"> 30-50 orang</option>
                                                <option value="3"> >50 orang</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="book_tabel_item">
                                        <div class="input-group">
                                            <select required class="wide" name="lama">
                                                <option data-display="Lama Meeting">Lama Meeting</option>
                                                <option value="1">1 jam</option>
                                                <option value="2">2 jam</option>
                                                <option value="3">3 jam</option>
                                                <option value="4">4 jam</option>
                                                <option value="5">5 jam</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button class="book_now_btn button_hover" type="submit">Cari Sekarang</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>