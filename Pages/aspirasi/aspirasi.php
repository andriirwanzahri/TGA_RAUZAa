<!-- <script src="
    vendor/jquery/jquery.min.js"></script> -->
<!-- <script>
        //Inisiasi awal penggunaan jQuery
        $(document).ready(function() {
            //Pertama sembunyikan elemen class gambar
            $('#hasil').hide();

            //Ketika elemen class tampil di klik maka elemen class gambar tampil
            $('#tekan').click(function() {
                $('#hasil').show();
            });
        });
    </script> -->

<!-- Outer Row -->
<div class="row mt-0">

    <div class="col-lg-4">

        <div class="card o-hidden border-0 shadow-lg ">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg col-4">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">NAMA JALAN</h1>
                            </div>
                            <form class="user" method="post" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="emailHelp" placeholder="Masukan nama..." autocomplete="off" maxlength="25" required">

                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="suhu" name="suhu" aria-describedby="emailHelp" placeholder="Masukan nilai Suhu...(Celcius)" autocomplete="off" required">

                                </div>
                                <div class=" form-group">
                                    <input type="text" class="form-control form-control-user" id="kadar_air" name="kadar_air" aria-describedby="emailHelp" placeholder="Masukan nilai Kadar Air... (%)" autocomplete="off" required">

                                </div>
                                <div class=" form-group">
                                    <input type="text" class="form-control form-control-user" id="curah_hujan" name="curah_hujan" aria-describedby="emailHelp" placeholder="Masukan nilai Curah Hujan...(mm/hari)" autocomplete="off" required">

                                </div>
                                <div class=" form-group">
                                    <input type="text" class="form-control form-control-user" id="ph" name="ph" aria-describedby="emailHelp" placeholder="Masukan nilai pH..." autocomplete="off" required">

                                </div>
                                <div class=" form-group">
                                    <input type="text" class="form-control form-control-user" id="topografi" name="topografi" aria-describedby="emailHelp" placeholder="Masukan nilai Topografi...(mdpl)" autocomplete="off" required">

                                </div>
                                <div class=" row">
                                    <div class="col-lg col-3">
                                        <input type="reset" class="btn btn-info btn-user btn-block" value="Bersihkan">
                                        </input>
                                    </div>
                                    <div class="col-lg col-3">
                                        <button type="submit" class="btn btn-info btn-user btn-block" id="tekan">
                                            Prediksi
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center">
                                <a class="small" href="#">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-8  mb-3" id="hasil">

        <div class="card o-hidden border-0 shadow-lg ">
            <div class="card-body">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg col-8">
                        <div class="p-3">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">ASPIRASI</h1>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4>
                                        Hasil Belum Ada
                                    </h4>
                                    <h6><b>Silahkan Isi Form dengan Benar untuk Melihat Hasil Prediksi</b></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>