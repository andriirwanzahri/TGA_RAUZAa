<div class="row mt-5 card shadow-lg">
    <div class="col-md-12 bg-success ">
        <h2 class="text-center" style="color: white;">Cetak Laporan Data Jalan</h2>
    </div>
    <form>
        <div class="row justify-content-center mt-3 mb-5">
            <form action="Pages/laporan/cetak_laporan.php" target="_blank" method="get">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Dari</label>
                        <input type="date" name="dari" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Sampai</label>
                        <input type="date" name="sampai" class="form-control" id="formGroupExampleInput" placeholder="Example input">
                    </div>
                </div>
                <div class="col-md-10">
                    <button type="submit" name="submit" class="btn btn-outline-success float-right"><i class="fa fa-print"></i> Lihat</button>
                </div>
            </form>
        </div>
    </form>
</div>