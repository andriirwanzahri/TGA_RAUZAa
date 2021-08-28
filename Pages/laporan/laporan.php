    <form action="Pages/laporan/cetak_laporan.php" target="_blank" method="post">
        <div class="row mt-5 mb-5 justify-content-center shadow-lg">
            <div class="col-md-12 bg-success ">
                <h2 class="text-center" style="color: white;">Cetak Laporan Data Jalan</h2>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Dari</label>
                    <input type="text" name="dari" class="form-control" placeholder="dari tahun">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Sampai</label>
                    <input type="text" name="sampai" class="form-control" placeholder="sampai tahun">
                </div>
            </div>
            <div class="col-md-10 mb-5">
                <button type="submit" name="kirim" class="btn btn-outline-success float-right"><i class="fa fa-print"></i> Lihat</button>
            </div>
        </div>
    </form>