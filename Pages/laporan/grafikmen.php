<?php
include 'koneksi.php'; ?>
<div class="container mt-3">
    <h1 class="text-center">Grafik Data Kondisi Jalan</h1>
    <div class="row">
        <div class="col-md-9 card">
            <div style="width: 700px;margin: 0px auto;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="col-md-3 card mt-10">
            <ul>
                <li><button class="btn btn-success"></button> Kondisi Baik</li>
                <li><button class="btn btn-info"></button> Kondisi Sedang</li>
                <li><button class="btn btn-warning"></button> Kondisi Rusak Ringan</li>
                <li><button class="btn btn-danger"></button> Kondisi Rusak Berat</li>
            </ul>
        </div>
    </div>
</div>