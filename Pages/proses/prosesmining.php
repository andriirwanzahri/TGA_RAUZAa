<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED | E_USER_WARNING | E_PARSE));
error_reporting(0);
function format_decimal($value)
{
    return round($value, 3);
}
function proses_DT(
    $conn,
    $parent,
    $kasus_cabang1,
    $kasus_cabang2,
    $kasus_cabang3,
    $kasus_cabang4,
    $kasus_cabang5,
    $kasus_cabang6,
    $kasus_cabang7,
    $kasus_cabang8,
    $kasus_cabang9,
    $kasus_cabang10,
    $kasus_cabang11

) {
    if ($kasus_cabang3 == '') {
        echo "cabang 1<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang1);
        echo "cabang 2<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang2);
    } elseif ($kasus_cabang4 == '') {
        echo "cabang 1<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang1);
        echo "cabang 2<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang2);
        echo "cabang 3<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang3);
    } elseif ($kasus_cabang6 == '') {
        echo "cabang 1<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang1);
        echo "cabang 2<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang2);
        echo "cabang 3<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang3);
        echo "cabang 4<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang4);
        echo "cabang 5<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang5);
    } elseif ($kasus_cabang11 == '') {
        echo "cabang 1<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang1);
        echo "cabang 2<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang2);
        echo "cabang 3<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang3);
        echo "cabang 4<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang4);
        echo "cabang 5<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang5);
        echo "cabang 6<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang6);
        echo "cabang 7<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang7);
        echo "cabang 8<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang8);
        echo "cabang 9<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang9);
        echo "cabang 10<br>";
        pembentukan_tree($conn, $parent, $kasus_cabang10);
    }
}
function pembentukan_tree($conn, $N_parent, $kasus)
{
    //mengisi kondisi
    if ($N_parent != '') {
        $kondisi = $N_parent . " AND " . $kasus;
    } else {
        $kondisi = $kasus;
    }

    echo $kondisi . "<br>";
    //cek data heterogen / homogen???
    $cek = cek_heterohomogen($conn, 'target', $kondisi);
    if ($cek == 'homogen') {
        echo "<br>LEAF ||";
        $sql_keputusan = mysqli_query($conn, "SELECT DISTINCT(target) FROM "
            . "datapreprocessing WHERE $kondisi");
        $row_keputusan = mysqli_fetch_array($sql_keputusan);
        $keputusan = $row_keputusan['0'];
        //insert atau lakukan pemangkasan cabang
        pangkas($conn, $N_parent, $kasus, $keputusan);
    } //jika data masih heterogen
    else if ($cek == 'heterogen') {
        // echo "Data heterogen";
        $kondisi_target = '';
        if ($kondisi != '') {
            $kondisi_target = $kondisi . " AND ";
        }
        $jml_baik = jumlah_data($conn, "$kondisi_target target='B'");
        $jml_sedang = jumlah_data($conn, "$kondisi_target target='S'");
        $jml_rusak_ringan = jumlah_data($conn, "$kondisi_target target='RR'");
        $jml_rusak_berat = jumlah_data($conn, "$kondisi_target target='RB'");

        $jml_total = $jml_baik + $jml_sedang + $jml_rusak_ringan + $jml_rusak_berat;
        //jumlah data JNS PEN


        //Hitung Nilai nama lintas
        $nilai_namaLintas = array();
        $nilai_namaLintas = cek_nilaiAtribut($conn, 'namaLintas', $kondisi);
        $jmlnamaLintas = count($nilai_namaLintas);
        //Hitung Nilai nama ura dukung
        $nilai_ura_dukung = array();
        $nilai_ura_dukung = cek_nilaiAtribut($conn, 'ura_dukung', $kondisi);
        $jmlura_dukung = count($nilai_ura_dukung);
        //Hitung Nilai nama ura dukung
        $nilai_aspal = array();
        $nilai_aspal = cek_nilaiAtribut($conn, 'aspal', $kondisi);
        $jmlaspal = count($nilai_aspal);
        //hitung entropy semua
        $nilai_tanah_krikil = array();
        $nilai_tanah_krikil = cek_nilaiAtribut($conn, 'tanah_krikil', $kondisi);
        $jmltanah_krikil = count($nilai_tanah_krikil);
        $entropy_all = hitung_entropy($jml_baik, $jml_sedang, $jml_rusak_ringan, $jml_rusak_berat);
        // echo "Entropy All = " . $entropy_all . "<br>";
        echo "<table class='table table-bordered'width='100%' cellspacing='0'>";
        echo "<tr><th>Nilai Atribut</th> <th>Jumlah data</th> <th>Jumlah Baik</th> <th>Jumlah Sedang</th> "
            . "<th>Jumlah Rusak Ringan</th> <th>Jumlah Rusak Berat</th> <th>Entropy</th> <th>Gain</th><th>Split Info</th><th>Gain rasio</th><tr>";
        mysqli_query($conn, "TRUNCATE gain");
        totalData($jml_total, $jml_baik, $jml_sedang, $jml_rusak_ringan, $jml_rusak_berat, $entropy_all);
        //hitung gain atribut KATEGORIKAL
        if ($jmlura_dukung != 1) {
            $NA1ura_dukung = "ura_dukung='$nilai_ura_dukung[0]'";
            $NA2ura_dukung = "";
            $NA3ura_dukung = "";
            if ($jmlura_dukung == 2) {
                $NA2ura_dukung = "ura_dukung='$nilai_ura_dukung[1]'";
            } else if ($jmlura_dukung == 3) {
                $NA2ura_dukung = "ura_dukung='$nilai_ura_dukung[1]'";
                $NA3ura_dukung = "ura_dukung='$nilai_ura_dukung[2]'";
            } else if ($jmlura_dukung == 4) {
                $NA2ura_dukung = "ura_dukung='$nilai_ura_dukung[1]'";
                $NA3ura_dukung = "ura_dukung='$nilai_ura_dukung[2]'";
                $NA4ura_dukung = "ura_dukung='$nilai_ura_dukung[3]'";
            } else if ($jmlura_dukung == 5) {
                $NA2ura_dukung = "ura_dukung='$nilai_ura_dukung[1]'";
                $NA3ura_dukung = "ura_dukung='$nilai_ura_dukung[2]'";
                $NA4ura_dukung = "ura_dukung='$nilai_ura_dukung[3]'";
                $NA5ura_dukung = "ura_dukung='$nilai_ura_dukung[4]'";
            }
            // var_dump($nilai_ura_dukung);

            hitung_gain($conn, $kondisi, "ura_dukung", $entropy_all, $NA1ura_dukung, $NA2ura_dukung, $NA3ura_dukung, $NA4ura_dukung, $NA5ura_dukung, "", "", "", "", "", "");
        }
        if ($jmlnamaLintas != 1) {
            $NA1namaLintas = "namaLintas='$nilai_namaLintas[0]'";
            $NA2namaLintas = "";
            $NA3namaLintas = "";
            if ($jmlnamaLintas == 2) {
                $NA2namaLintas = "namaLintas='$nilai_namaLintas[1]'";
            } else if ($jmlnamaLintas == 3) {
                $NA2namaLintas = "namaLintas='$nilai_namaLintas[1]'";
                $NA3namaLintas = "namaLintas='$nilai_namaLintas[2]'";
            }
            hitung_gain($conn, $kondisi, "namaLintas", $entropy_all, $NA1namaLintas, $NA2namaLintas, $NA3namaLintas, "", "", "", "", "", "", "", "");
        }
        hitung_gain(
            $conn,
            $kondisi,
            "panjangRuas",
            $entropy_all,
            "panjangRuas='SPES'",
            "panjangRuas='SPE'",
            "panjangRuas='PE'",
            "panjangRuas='SS'",
            "panjangRuas='CS'",
            "panjangRuas='S'",
            "panjangRuas='PA'",
            "panjangRuas='CP'",
            "panjangRuas='SPA'",
            "panjangRuas='SPAS'",
            ""
        );
        hitung_gain($conn, $kondisi, "jns_pen", $entropy_all, "jns_pen='P'", "jns_pen='PB'", "", "", "", "", "", "", "", "", "");
        if ($jmltanah_krikil != 1) {
            $NA1tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[0]'";
            if ($jmltanah_krikil == 2) {
                $NA2tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[1]'";
            } else if ($jmltanah_krikil == 3) {
                $NA2tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[1]'";
                $NA3tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[2]'";
            } else if ($jmltanah_krikil == 4) {
                $NA2tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[1]'";
                $NA3tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[2]'";
                $NA4tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[3]'";
            } else if ($jmltanah_krikil == 5) {
                $NA2tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[1]'";
                $NA3tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[2]'";
                $NA4tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[3]'";
                $NA5tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[4]'";
            } else if ($jmltanah_krikil == 6) {
                $NA2tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[1]'";
                $NA3tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[2]'";
                $NA4tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[3]'";
                $NA5tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[4]'";
                $NA6tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[5]'";
            } else if ($jmltanah_krikil == 7) {
                $NA2tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[1]'";
                $NA3tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[2]'";
                $NA4tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[3]'";
                $NA5tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[4]'";
                $NA6tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[5]'";
                $NA7tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[6]'";
            } else if ($jmltanah_krikil == 8) {
                $NA2tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[1]'";
                $NA3tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[2]'";
                $NA4tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[3]'";
                $NA5tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[4]'";
                $NA6tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[5]'";
                $NA7tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[6]'";
                $NA8tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[7]'";
            } else if ($jmltanah_krikil == 9) {
                $NA2tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[1]'";
                $NA3tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[2]'";
                $NA4tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[3]'";
                $NA5tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[4]'";
                $NA6tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[5]'";
                $NA7tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[6]'";
                $NA8tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[7]'";
                $NA9tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[8]'";
            } else if ($jmltanah_krikil == 10) {
                $NA2tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[1]'";
                $NA3tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[2]'";
                $NA4tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[3]'";
                $NA5tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[4]'";
                $NA6tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[5]'";
                $NA7tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[6]'";
                $NA8tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[7]'";
                $NA9tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[8]'";
                $NA10tanah_krikil = "tanah_krikil='$nilai_tanah_krikil[9]'";
            }
            hitung_gain(
                $conn,
                $kondisi,
                "tanah_krikil",
                $entropy_all,
                $NA1tanah_krikil,
                $NA2tanah_krikil,
                $NA3tanah_krikil,
                $NA4tanah_krikil,
                $NA5tanah_krikil,
                $NA6tanah_krikil,
                $NA7tanah_krikil,
                $NA8tanah_krikil,
                $NA9tanah_krikil,
                $NA10tanah_krikil,
                ""
            );
        }
        if ($jmlaspal != 1) {
            $NA1aspal = "aspal='$nilai_aspal[0]'";
            if ($jmlaspal == 2) {
                $NA2aspal = "aspal='$nilai_aspal[1]'";
            } else if ($jmlaspal == 3) {
                $NA2aspal = "aspal='$nilai_aspal[1]'";
                $NA3aspal = "aspal='$nilai_aspal[2]'";
            } else if ($jmlaspal == 4) {
                $NA2aspal = "aspal='$nilai_aspal[1]'";
                $NA3aspal = "aspal='$nilai_aspal[2]'";
                $NA4aspal = "aspal='$nilai_aspal[3]'";
            } else if ($jmlaspal == 5) {
                $NA2aspal = "aspal='$nilai_aspal[1]'";
                $NA3aspal = "aspal='$nilai_aspal[2]'";
                $NA4aspal = "aspal='$nilai_aspal[3]'";
                $NA5aspal = "aspal='$nilai_aspal[4]'";
            } else if ($jmlaspal == 6) {
                $NA2aspal = "aspal='$nilai_aspal[1]'";
                $NA3aspal = "aspal='$nilai_aspal[2]'";
                $NA4aspal = "aspal='$nilai_aspal[3]'";
                $NA5aspal = "aspal='$nilai_aspal[4]'";
                $NA6aspal = "aspal='$nilai_aspal[5]'";
            } else if ($jmlaspal == 7) {
                $NA2aspal = "aspal='$nilai_aspal[1]'";
                $NA3aspal = "aspal='$nilai_aspal[2]'";
                $NA4aspal = "aspal='$nilai_aspal[3]'";
                $NA5aspal = "aspal='$nilai_aspal[4]'";
                $NA6aspal = "aspal='$nilai_aspal[5]'";
                $NA7aspal = "aspal='$nilai_aspal[6]'";
            } else if ($jmlaspal == 8) {
                $NA2aspal = "aspal='$nilai_aspal[1]'";
                $NA3aspal = "aspal='$nilai_aspal[2]'";
                $NA4aspal = "aspal='$nilai_aspal[3]'";
                $NA5aspal = "aspal='$nilai_aspal[4]'";
                $NA6aspal = "aspal='$nilai_aspal[5]'";
                $NA7aspal = "aspal='$nilai_aspal[6]'";
                $NA8aspal = "aspal='$nilai_aspal[7]'";
            } else if ($jmlaspal == 9) {
                $NA2aspal = "aspal='$nilai_aspal[1]'";
                $NA3aspal = "aspal='$nilai_aspal[2]'";
                $NA4aspal = "aspal='$nilai_aspal[3]'";
                $NA5aspal = "aspal='$nilai_aspal[4]'";
                $NA6aspal = "aspal='$nilai_aspal[5]'";
                $NA7aspal = "aspal='$nilai_aspal[6]'";
                $NA8aspal = "aspal='$nilai_aspal[7]'";
                $NA9aspal = "aspal='$nilai_aspal[8]'";
            } else if ($jmlaspal == 10) {
                $NA2aspal = "aspal='$nilai_aspal[1]'";
                $NA3aspal = "aspal='$nilai_aspal[2]'";
                $NA4aspal = "aspal='$nilai_aspal[3]'";
                $NA5aspal = "aspal='$nilai_aspal[4]'";
                $NA6aspal = "aspal='$nilai_aspal[5]'";
                $NA7aspal = "aspal='$nilai_aspal[6]'";
                $NA8aspal = "aspal='$nilai_aspal[7]'";
                $NA9aspal = "aspal='$nilai_aspal[8]'";
                $NA10aspal = "aspal='$nilai_aspal[9]'";
            }
            hitung_gain(
                $conn,
                $kondisi,
                "aspal",
                $entropy_all,
                $NA1aspal,
                $NA2aspal,
                $NA3aspal,
                $NA4aspal,
                $NA5aspal,
                $NA6aspal,
                $NA7aspal,
                $NA8aspal,
                $NA9aspal,
                $NA10aspal,
                ""
            );
        }
        hitung_gain($conn, $kondisi, "rigit", $entropy_all, "rigit='SPES'", "rigit='SPE'", "rigit='PE'", "rigit='SS'", "rigit='CS'", "rigit='S'", "rigit='PA'", "rigit='CP'", "rigit='SPA'", "rigit='SPAS'", "");
        echo "</table>";


        //ambil nilai gain terBesar
        $sql_max = mysqli_query($conn, "SELECT MAX(gain) FROM gain");
        $row_max = mysqli_fetch_array($sql_max);
        $max_gain = $row_max[0];
        $sql = mysqli_query($conn, "SELECT * FROM gain WHERE gain=$max_gain");
        $row = mysqli_fetch_array($sql);
        $atribut = $row[2];
        echo "<button>Atribut terpilih = " . $atribut . ", dengan nilai gain rasio= " . $max_gain . "</button><br>";
        echo "<br>================================<br>";

        if ($max_gain == 0) {
            echo "<br>LEAF ";
            // var_dump($kondisi);
            // die;
            $NB = $kondisi . " AND 'target'='B'";
            $NS = $kondisi . " AND 'target'='S'";
            $NRR = $kondisi . " AND 'target'='RR'";
            $NRB = $kondisi . " AND 'target'='RB'";
            $jumlahB = jumlah_data($conn, "$NB");
            $jumlahS = jumlah_data($conn, "$NS");
            $jumlahRR = jumlah_data($conn, "$NRR");
            $jumlahRB = jumlah_data($conn, "$NRB");
            if (
                $jumlahB >= $jumlahS &&
                $jumlahB >= $jumlahRR &&
                $jumlahB >= $jumlahRB
            ) {
                $keputusan = 'B';
            } elseif (
                $jumlahS >= $jumlahB &&
                $jumlahS >= $jumlahRR &&
                $jumlahS >= $jumlahRB
            ) {
                $keputusan = 'S';
            } elseif (
                $jumlahRR >= $jumlahB &&
                $jumlahRR >= $jumlahS &&
                $jumlahRR >= $jumlahRB
            ) {
                $keputusan = 'RR';
            } else {
                $keputusan = 'RB';
            }
            //insert atau lakukan pemangkasan cabang
            pangkas($conn, $N_parent, $kasus, $keputusan);
        } else {

            if ($atribut == "jns_pen") {
                proses_DT($conn, $kondisi, "(jns_pen ='PB')", "(jns_pen ='P')", "", "", "", "", "", "", "", "", "");
            }
            if ($atribut == "namaLintas") {
                proses_DT(
                    $conn,
                    $kondisi,
                    "(namaLintas='LJK')",
                    "(namaLintas ='LJN')",
                    "(namaLintas ='LJP')",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    ""
                );
            }
            if ($atribut == "ura_dukung") {
                proses_DT(
                    $conn,
                    $kondisi,
                    "(ura_dukung='KMI')",
                    "(ura_dukung ='KA')",
                    "(ura_dukung ='KP')",
                    "(ura_dukung ='KM')",
                    "(ura_dukung ='KCT')",
                    "",
                    "",
                    "",
                    "",
                    "",
                    ""
                );
            }
            if ($atribut == "aspal") {
                proses_DT(
                    $conn,
                    $kondisi,
                    "(aspal='SPES')",
                    "(aspal ='SPE')",
                    "(aspal ='PE')",
                    "(aspal ='SS')",
                    "(aspal ='CS')",
                    "(aspal ='S')",
                    "(aspal ='PA')",
                    "(aspal ='CP')",
                    "(aspal ='SPA')",
                    "(aspal ='SPAS')",
                    ""
                );
            }
            if ($atribut == "tanah_krikil") {
                proses_DT(
                    $conn,
                    $kondisi,
                    "(tanah_krikil='SPES')",
                    "(tanah_krikil ='SPE')",
                    "(tanah_krikil ='PE')",
                    "(tanah_krikil ='SS')",
                    "(tanah_krikil ='CS')",
                    "(tanah_krikil ='S')",
                    "(tanah_krikil ='PA')",
                    "(tanah_krikil ='CP')",
                    "(tanah_krikil ='SPA')",
                    "(tanah_krikil ='SPAS')",
                    ""
                );
            }
            if ($atribut == "rigit") {
                proses_DT(
                    $conn,
                    $kondisi,
                    "(rigit='SPES')",
                    "(rigit ='SPE')",
                    "(rigit ='PE')",
                    "(rigit ='SS')",
                    "(rigit ='CS')",
                    "(rigit ='S')",
                    "(rigit ='PA')",
                    "(rigit ='CP')",
                    "(rigit ='SPA')",
                    "(rigit ='SPAS')",
                    ""
                );
            }
            if ($atribut == "panjangRuas") {
                proses_DT(
                    $conn,
                    $kondisi,
                    "(panjangRuas='SPES')",
                    "(panjangRuas ='SPE')",
                    "(panjangRuas ='PE')",
                    "(panjangRuas ='SS')",
                    "(panjangRuas ='CS')",
                    "(panjangRuas ='S')",
                    "(panjangRuas ='PA')",
                    "(panjangRuas ='CP')",
                    "(panjangRuas ='SPA')",
                    "(panjangRuas ='SPAS')",
                    ""
                );
            }
        }
    }
}

function cek_heterohomogen($conn, $field, $kondisi)
{
    //sql disticnt
    if ($kondisi == '') {
        $sql = mysqli_query($conn, "SELECT DISTINCT($field) FROM datapreprocessing");
    } else {
        $sql = mysqli_query($conn, "SELECT DISTINCT($field) FROM datapreprocessing WHERE $kondisi");
    }
    //jika jumlah data 1 maka homogen
    if (mysqli_num_rows($sql) == 1) {
        $nilai = "homogen";
    } else {
        $nilai = "heterogen";
    }
    return $nilai;
}
function pangkas($conn, $PARENT, $KASUS, $LEAF)
{
    $sql_in = "INSERT INTO t_keputusan "
        . "(parent,akar,keputusan)"
        . " VALUES (\"$PARENT\" , \"$KASUS\" , \"$LEAF\")";
    mysqli_query($conn, $sql_in);
    echo "Keputusan = " . $LEAF . "<br>================================<br>";
}
function jumlah_data($conn, $kondisi)
{
    //sql
    if ($kondisi == '') {
        $sql = "SELECT COUNT(*) FROM datapreprocessing $kondisi";
    } else {
        $sql = "SELECT COUNT(*) FROM datapreprocessing WHERE $kondisi";
    }

    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $jml = $row['0'];
    // var_dump($query);
    return $jml;
}

function hitung_entropy($nilai1, $nilai2, $nilai3, $nilai4)
{

    $total = $nilai1 + $nilai2 + $nilai3 + $nilai4;
    $atribut1 = @(- ($nilai1 / $total) * (log(($nilai1 / $total), 2)));
    $atribut2 = @(- ($nilai2 / $total) * (log(($nilai2 / $total), 2)));
    $atribut3 = @(- ($nilai3 / $total) * (log(($nilai3 / $total), 2)));
    $atribut4 = @(- ($nilai4 / $total) * (log(($nilai4 / $total), 2)));

    $atribut1 = is_nan($atribut1) ? 0 : $atribut1;
    $atribut2 = is_nan($atribut2) ? 0 : $atribut2;
    $atribut3 = is_nan($atribut3) ? 0 : $atribut3;
    $atribut4 = is_nan($atribut4) ? 0 : $atribut4;

    // var_dump($atribut1, $atribut2, $atribut3, $atribut4);

    $entropy = $atribut1 + $atribut2 + $atribut3 + $atribut4;
    //    }
    //desimal 3 angka dibelakang koma
    $entropy = format_decimal($entropy);
    return $entropy;
}
function totalData($jml_total, $jml_baik, $jml_sedang, $jml_rusak_ringan, $jml_rusak_berat, $entropy_all)
{
    echo "<tr>";
    echo "<td>Total</td>";
    echo "<td>" . $jml_total . "</td>";
    echo "<td>" . $jml_baik . "</td>";
    echo "<td>" . $jml_sedang . "</td>";
    echo "<td>" . $jml_rusak_ringan . "</td>";
    echo "<td>" . $jml_rusak_berat . "</td>";
    echo "<td>" . $entropy_all . "</td>";
    echo "<td>&nbsp;</td>";
    echo "<td>&nbsp;</td>";
    echo "<td>&nbsp;</td>";
    echo "</tr>";
    echo "<tr><td colspan='16'></td></tr>";
}

function hitung_gain($conn, $kasus, $atribut, $ent_all, $kondisi1, $kondisi2, $kondisi3, $kondisi4, $kondisi5, $kondisi6, $kondisi7, $kondisi8, $kondisi9, $kondisi10, $kondisi11)
{

    $data_kasus = '';
    if ($kasus != '') {
        $data_kasus = $kasus . " AND ";
    }

    //untuk atribut 2 nilai atribut	
    if ($kondisi3 == '') {
        $j_B1 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi1");
        $j_S1 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi1");
        $j_RR1 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi1");
        $j_RB1 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi1");
        $jml1 = $j_B1 + $j_S1 + $j_RR1 + $j_RB1;

        $j_B2 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi2");
        $j_S2 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi2");
        $j_RR2 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi2");
        $j_RB2 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi2");
        $jml2 = $j_B2 + $j_S2 + $j_RR2 + $j_RB2;

        //hitung entropy masing-masing kondisi
        $jml_total = $jml1 + $jml2;
        $ent1 = hitung_entropy($j_B1, $j_S1, $j_RR1, $j_RB1);
        $ent2 = hitung_entropy($j_B2, $j_S2, $j_RR2, $j_RB2);
        $nilai1 = jumlah_data($conn, "$data_kasus $atribut='P'");
        $nilai2 = jumlah_data($conn, "$data_kasus $atribut='PB'");
        $gain = $ent_all - @((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2));
        $tot_opsi1 = $nilai1 + $nilai2;
        $atribut1 = @(- ($nilai1 / $tot_opsi1) * (log(($nilai1 / $tot_opsi1), 2))) + (- ($nilai2 / $tot_opsi1) * (log(($nilai2 / $tot_opsi1), 2)));
        $atribut1 = is_nan($atribut1) ? 0 : $atribut1;
        $splitinfo = format_decimal($atribut1);
        $gainRasio = @$gain / $splitinfo;
        $gainRasio = is_nan($gainRasio) ? 0 : $gainRasio;
        $gainRasio = format_decimal($gainRasio);
        //desimal 3 angka dibelakang koma
        $gain = format_decimal($gain);
        echo "<tr>";
        echo "<td>" . $kondisi1 . "</td>";
        echo "<td>" . $jml1 . "</td>";
        echo "<td>" . $j_B1 . "</td>";
        echo "<td>" . $j_S1 . "</td>";
        echo "<td>" . $j_RR1 . "</td>";
        echo "<td>" . $j_RB1 . "</td>";
        echo "<td>" . $ent1 . "</td>";
        echo "<td>" . $gain . "</td>";
        echo "<td>" . $splitinfo . "</td>";
        echo "<td>" . $gainRasio . "</td>";

        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $kondisi2 . "</td>";
        echo "<td>" . $jml2 . "</td>";
        echo "<td>" . $j_B2 . "</td>";
        echo "<td>" . $j_S2 . "</td>";
        echo "<td>" . $j_RR2 . "</td>";
        echo "<td>" . $j_RB2 . "</td>";
        echo "<td>" . $ent2 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";
        echo "<tr><td colspan='8'></td></tr>";
        // untuk 3 atribut
    } elseif ($kondisi4 == '') {
        $j_B1 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi1");
        $j_S1 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi1");
        $j_RR1 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi1");
        $j_RB1 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi1");
        $jml1 = $j_B1 + $j_S1 + $j_RR1 + $j_RB1;

        $j_B2 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi2");
        $j_S2 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi2");
        $j_RR2 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi2");
        $j_RB2 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi2");
        $jml2 = $j_B2 + $j_S2 + $j_RR2 + $j_RB2;

        $j_B3 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi3");
        $j_S3 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi3");
        $j_RR3 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi3");
        $j_RB3 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi3");
        $jml3 = $j_B3 + $j_S3 + $j_RR3 + $j_RB3;

        //hitung entropy masing-masing kondisi
        $jml_total = $jml1 + $jml2 + $jml3;
        $ent1 = hitung_entropy($j_B1, $j_S1, $j_RR1, $j_RB1);
        $ent2 = hitung_entropy($j_B2, $j_S2, $j_RR2, $j_RB2);
        $ent3 = hitung_entropy($j_B3, $j_S3, $j_RR3, $j_RB3);
        //hitung nilai split dan gain rasio
        $nilai4 = jumlah_data($conn, "$data_kasus $atribut='LJN'");
        $nilai5 = jumlah_data($conn, "$data_kasus $atribut='LJK'");
        $nilai3 = jumlah_data($conn, "$data_kasus $atribut='LJP'");
        $tot_opsi1 = $nilai4 + $nilai5 + $nilai3;
        $gain = $ent_all - @((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3));
        $atribut1 = @(- ($nilai4 / $tot_opsi1) * (log(($nilai4 / $tot_opsi1), 2)))
            + (- ($nilai5 / $tot_opsi1) * (log(($nilai5 / $tot_opsi1), 2)))
            + (- ($nilai3 / $tot_opsi1) * (log(($nilai3 / $tot_opsi1), 2)));
        $atribut1 = is_nan($atribut1) ? 0 : $atribut1;
        $splitinfo = format_decimal($atribut1);
        $gainRasio = @$gain / $splitinfo;
        // var_dump($gainRasio);
        $gainRasio = is_nan($gainRasio) ? 0 : $gainRasio;
        // var_dump($gainRasio);
        $gainRasio = format_decimal($gainRasio);
        //desimal 3 angka dibelakang koma
        $gain = format_decimal($gain);
        echo "<tr>";
        echo "<td>" . $kondisi1 . "</td>";
        echo "<td>" . $jml1 . "</td>";
        echo "<td>" . $j_B1 . "</td>";
        echo "<td>" . $j_S1 . "</td>";
        echo "<td>" . $j_RR1 . "</td>";
        echo "<td>" . $j_RB1 . "</td>";
        echo "<td>" . $ent1 . "</td>";
        echo "<td>" . $gain . "</td>";
        echo "<td>" . $splitinfo . "</td>";
        echo "<td>" . $gainRasio . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $kondisi2 . "</td>";
        echo "<td>" . $jml2 . "</td>";
        echo "<td>" . $j_B2 . "</td>";
        echo "<td>" . $j_S2 . "</td>";
        echo "<td>" . $j_RR2 . "</td>";
        echo "<td>" . $j_RB2 . "</td>";
        echo "<td>" . $ent2 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $kondisi3 . "</td>";
        echo "<td>" . $jml3 . "</td>";
        echo "<td>" . $j_B3 . "</td>";
        echo "<td>" . $j_S3 . "</td>";
        echo "<td>" . $j_RR3 . "</td>";
        echo "<td>" . $j_RB3 . "</td>";
        echo "<td>" . $ent3 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";
        echo "<tr><td colspan='8'></td></tr>";
    } elseif ($kondisi6 == '') {
        $j_B1 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi1");
        $j_S1 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi1");
        $j_RR1 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi1");
        $j_RB1 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi1");
        $jml1 = $j_B1 + $j_S1 + $j_RR1 + $j_RB1;

        $j_B2 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi2");
        $j_S2 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi2");
        $j_RR2 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi2");
        $j_RB2 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi2");
        $jml2 = $j_B2 + $j_S2 + $j_RR2 + $j_RB2;

        $j_B3 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi3");
        $j_S3 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi3");
        $j_RR3 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi3");
        $j_RB3 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi3");
        $jml3 = $j_B3 + $j_S3 + $j_RR3 + $j_RB3;

        $j_B4 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi4");
        $j_S4 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi4");
        $j_RR4 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi4");
        $j_RB4 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi4");
        $jml4 = $j_B4 + $j_S4 + $j_RR4 + $j_RB4;

        $j_B5 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi5");
        $j_S5 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi5");
        $j_RR5 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi5");
        $j_RB5 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi5");
        $jml5 = $j_B5 + $j_S5 + $j_RR5 + $j_RB5;

        //hitung entropy masing-masing kondisi
        $jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5;
        $ent1 = hitung_entropy($j_B1, $j_S1, $j_RR1, $j_RB1);
        $ent2 = hitung_entropy($j_B2, $j_S2, $j_RR2, $j_RB2);
        $ent3 = hitung_entropy($j_B3, $j_S3, $j_RR3, $j_RB3);
        $ent4 = hitung_entropy($j_B4, $j_S4, $j_RR4, $j_RB4);
        $ent5 = hitung_entropy($j_B5, $j_S5, $j_RR5, $j_RB5);
        $nilai1 = jumlah_data($conn, "$data_kasus $atribut='KMI'");
        $nilai2 = jumlah_data($conn, "$data_kasus $atribut='KA'");
        $nilai3 = jumlah_data($conn, "$data_kasus $atribut='KP'");
        $nilai4 = jumlah_data($conn, "$data_kasus $atribut='KM'");
        $nilai5 = jumlah_data($conn, "$data_kasus $atribut='KCT'");
        $tot_opsi1 = $nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5;
        $gain = $ent_all - @((($jml1 / $jml_total) * $ent1)
            + (($jml2 / $jml_total) * $ent2)
            + (($jml3 / $jml_total) * $ent3)
            + (($jml4 / $jml_total) * $ent4)
            + (($jml5 / $jml_total) * $ent5));
        $atribut1 = @(- ($nilai1 / $tot_opsi1) * (log(($nilai1 / $tot_opsi1), 2)))
            + (- ($nilai2 / $tot_opsi1) * (log(($nilai2 / $tot_opsi1), 2)))
            + (- ($nilai3 / $tot_opsi1) * (log(($nilai3 / $tot_opsi1), 2)))
            + (- ($nilai4 / $tot_opsi1) * (log(($nilai4 / $tot_opsi1), 2)))
            + (- ($nilai5 / $tot_opsi1) * (log(($nilai5 / $tot_opsi1), 2)));
        $atribut1 = @is_nan($atribut1) ? 0 : $atribut1;
        $splitinfo = format_decimal($atribut1);
        //desimal 3 angka dibelakang koma
        $gain = format_decimal($gain);
        $gainRasio = $gain / $splitinfo;
        $gainRasio = is_nan($gainRasio) ? 0 : $gainRasio;
        $gainRasio = format_decimal($gainRasio);
        echo "<tr>";
        echo "<td>" . $kondisi1 . "</td>";
        echo "<td>" . $jml1 . "</td>";
        echo "<td>" . $j_B1 . "</td>";
        echo "<td>" . $j_S1 . "</td>";
        echo "<td>" . $j_RR1 . "</td>";
        echo "<td>" . $j_RB1 . "</td>";
        echo "<td>" . $ent1 . "</td>";
        echo "<td>" . $gain . "</td>";
        echo "<td>" . $splitinfo . "</td>";
        echo "<td>" . $gainRasio . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi2 . "</td>";
        echo "<td>" . $jml2 . "</td>";
        echo "<td>" . $j_B2 . "</td>";
        echo "<td>" . $j_S2 . "</td>";
        echo "<td>" . $j_RR2 . "</td>";
        echo "<td>" . $j_RB2 . "</td>";
        echo "<td>" . $ent2 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi3 . "</td>";
        echo "<td>" . $jml3 . "</td>";
        echo "<td>" . $j_B3 . "</td>";
        echo "<td>" . $j_S3 . "</td>";
        echo "<td>" . $j_RR3 . "</td>";
        echo "<td>" . $j_RB3 . "</td>";
        echo "<td>" . $ent3 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi4 . "</td>";
        echo "<td>" . $jml4 . "</td>";
        echo "<td>" . $j_B4 . "</td>";
        echo "<td>" . $j_S4 . "</td>";
        echo "<td>" . $j_RR4 . "</td>";
        echo "<td>" . $j_RB4 . "</td>";
        echo "<td>" . $ent4 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi5 . "</td>";
        echo "<td>" . $jml5 . "</td>";
        echo "<td>" . $j_B5 . "</td>";
        echo "<td>" . $j_S5 . "</td>";
        echo "<td>" . $j_RR5 . "</td>";
        echo "<td>" . $j_RB5 . "</td>";
        echo "<td>" . $ent5 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";

        echo "</tr>";

        echo "<tr><td colspan='8'></td></tr>";
    } elseif ($kondisi11 == '') {
        $j_B1 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi1");
        $j_S1 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi1");
        $j_RR1 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi1");
        $j_RB1 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi1");
        $jml1 = $j_B1 + $j_S1 + $j_RR1 + $j_RB1;

        $j_B2 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi2");
        $j_S2 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi2");
        $j_RR2 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi2");
        $j_RB2 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi2");
        $jml2 = $j_B2 + $j_S2 + $j_RR2 + $j_RB2;

        $j_B3 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi3");
        $j_S3 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi3");
        $j_RR3 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi3");
        $j_RB3 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi3");
        $jml3 = $j_B3 + $j_S3 + $j_RR3 + $j_RB3;

        $j_B4 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi4");
        $j_S4 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi4");
        $j_RR4 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi4");
        $j_RB4 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi4");
        $jml4 = $j_B4 + $j_S4 + $j_RR4 + $j_RB4;

        $j_B5 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi5");
        $j_S5 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi5");
        $j_RR5 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi5");
        $j_RB5 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi5");
        $jml5 = $j_B5 + $j_S5 + $j_RR5 + $j_RB5;

        $j_B6 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi6");
        $j_S6 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi6");
        $j_RR6 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi6");
        $j_RB6 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi6");
        $jml6 = $j_B6 + $j_S6 + $j_RR6 + $j_RB6;

        $j_B7 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi7");
        $j_S7 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi7");
        $j_RR7 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi7");
        $j_RB7 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi7");
        $jml7 = $j_B7 + $j_S7 + $j_RR7 + $j_RB7;

        $j_B8 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi8");
        $j_S8 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi8");
        $j_RR8 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi8");
        $j_RB8 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi8");
        $jml8 = $j_B8 + $j_S8 + $j_RR8 + $j_RB8;

        $j_B9 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi9");
        $j_S9 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi9");
        $j_RR9 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi9");
        $j_RB9 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi9");
        $jml9 = $j_B9 + $j_S9 + $j_RR9 + $j_RB9;

        $j_B10 = jumlah_data($conn, "$data_kasus target='B' AND $kondisi10");
        $j_S10 = jumlah_data($conn, "$data_kasus target='S' AND $kondisi10");
        $j_RR10 = jumlah_data($conn, "$data_kasus target='RR' AND $kondisi10");
        $j_RB10 = jumlah_data($conn, "$data_kasus target='RB' AND $kondisi10");
        $jml10 = $j_B10 + $j_S10 + $j_RR10 + $j_RB10;

        //hitung entropy masing-masing kondisi
        $jml_total = $jml1 + $jml2 + $jml3 + $jml4 + $jml5 + $jml6 + $jml7 + $jml8 + $jml9 + $jml10;
        $ent1 = hitung_entropy($j_B1, $j_S1, $j_RR1, $j_RB1);
        $ent2 = hitung_entropy($j_B2, $j_S2, $j_RR2, $j_RB2);
        $ent3 = hitung_entropy($j_B3, $j_S3, $j_RR3, $j_RB3);
        $ent4 = hitung_entropy($j_B4, $j_S4, $j_RR4, $j_RB4);
        $ent5 = hitung_entropy($j_B5, $j_S5, $j_RR5, $j_RB5);
        $ent6 = hitung_entropy($j_B6, $j_S6, $j_RR6, $j_RB6);
        $ent7 = hitung_entropy($j_B7, $j_S7, $j_RR7, $j_RB7);
        $ent8 = hitung_entropy($j_B8, $j_S8, $j_RR8, $j_RB8);
        $ent9 = hitung_entropy($j_B9, $j_S9, $j_RR9, $j_RB9);
        $ent10 = hitung_entropy($j_B10, $j_S10, $j_RR10, $j_RB10);
        $gain = $ent_all - @((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml6 / $jml_total) * $ent6) + (($jml7 / $jml_total) * $ent7) + (($jml8 / $jml_total) * $ent8) + (($jml9 / $jml_total) * $ent9) + (($jml10 / $jml_total) * $ent10));
        $nilai1 = jumlah_data($conn, "$data_kasus $atribut='SPES'");
        $nilai2 = jumlah_data($conn, "$data_kasus $atribut='SPE'");
        $nilai3 = jumlah_data($conn, "$data_kasus $atribut='PE'");
        $nilai4 = jumlah_data($conn, "$data_kasus $atribut='SS'");
        $nilai5 = jumlah_data($conn, "$data_kasus $atribut='CS'");
        $nilai6 = jumlah_data($conn, "$data_kasus $atribut='S'");
        $nilai7 = jumlah_data($conn, "$data_kasus $atribut='PA'");
        $nilai8 = jumlah_data($conn, "$data_kasus $atribut='CP'");
        $nilai9 = jumlah_data($conn, "$data_kasus $atribut='SPA'");
        $nilai10 = jumlah_data($conn, "$data_kasus $atribut='SPAS'");
        $tot_opsi1 = $nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 + $nilai6 + $nilai7 + $nilai8 + $nilai9 + $nilai10;
        $atribut1 = @(- ($nilai1 / $tot_opsi1) * (log(($nilai1 / $tot_opsi1), 2)))
            + (- ($nilai2 / $tot_opsi1) * (log(($nilai2 / $tot_opsi1), 2)))
            + (- ($nilai3 / $tot_opsi1) * (log(($nilai3 / $tot_opsi1), 2)))
            + (- ($nilai4 / $tot_opsi1) * (log(($nilai4 / $tot_opsi1), 2)))
            + (- ($nilai5 / $tot_opsi1) * (log(($nilai5 / $tot_opsi1), 2)));
        $atribut1 = is_nan($atribut1) ? 0 : $atribut1;
        $splitinfo = format_decimal($atribut1);

        //desimal 3 angka dibelakang koma
        $gain = format_decimal($gain);
        $gainRasio = @$gain / $splitinfo;
        $gainRasio = is_nan($gainRasio) ? 0 : $gainRasio;
        $gainRasio = format_decimal($gainRasio);
        echo "<tr>";
        echo "<td>" . $kondisi1 . "</td>";
        echo "<td>" . $jml1 . "</td>";
        echo "<td>" . $j_B1 . "</td>";
        echo "<td>" . $j_S1 . "</td>";
        echo "<td>" . $j_RR1 . "</td>";
        echo "<td>" . $j_RB1 . "</td>";
        echo "<td>" . $ent1 . "</td>";
        echo "<td>" . $gain . "</td>";
        echo "<td>" . $splitinfo . "</td>";
        echo "<td>" . $gainRasio . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi2 . "</td>";
        echo "<td>" . $jml2 . "</td>";
        echo "<td>" . $j_B2 . "</td>";
        echo "<td>" . $j_S2 . "</td>";
        echo "<td>" . $j_RR2 . "</td>";
        echo "<td>" . $j_RB2 . "</td>";
        echo "<td>" . $ent2 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi3 . "</td>";
        echo "<td>" . $jml3 . "</td>";
        echo "<td>" . $j_B3 . "</td>";
        echo "<td>" . $j_S3 . "</td>";
        echo "<td>" . $j_RR3 . "</td>";
        echo "<td>" . $j_RB3 . "</td>";
        echo "<td>" . $ent3 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi4 . "</td>";
        echo "<td>" . $jml4 . "</td>";
        echo "<td>" . $j_B4 . "</td>";
        echo "<td>" . $j_S4 . "</td>";
        echo "<td>" . $j_RR4 . "</td>";
        echo "<td>" . $j_RB4 . "</td>";
        echo "<td>" . $ent4 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi5 . "</td>";
        echo "<td>" . $jml5 . "</td>";
        echo "<td>" . $j_B5 . "</td>";
        echo "<td>" . $j_S5 . "</td>";
        echo "<td>" . $j_RR5 . "</td>";
        echo "<td>" . $j_RB5 . "</td>";
        echo "<td>" . $ent5 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi6 . "</td>";
        echo "<td>" . $jml6 . "</td>";
        echo "<td>" . $j_B6 . "</td>";
        echo "<td>" . $j_S6 . "</td>";
        echo "<td>" . $j_RR6 . "</td>";
        echo "<td>" . $j_RB6 . "</td>";
        echo "<td>" . $ent6 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi7 . "</td>";
        echo "<td>" . $jml7 . "</td>";
        echo "<td>" . $j_B7 . "</td>";
        echo "<td>" . $j_S7 . "</td>";
        echo "<td>" . $j_RR7 . "</td>";
        echo "<td>" . $j_RB7 . "</td>";
        echo "<td>" . $ent7 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi8 . "</td>";
        echo "<td>" . $jml8 . "</td>";
        echo "<td>" . $j_B8 . "</td>";
        echo "<td>" . $j_S8 . "</td>";
        echo "<td>" . $j_RR8 . "</td>";
        echo "<td>" . $j_RB8 . "</td>";
        echo "<td>" . $ent8 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi9 . "</td>";
        echo "<td>" . $jml9 . "</td>";
        echo "<td>" . $j_B9 . "</td>";
        echo "<td>" . $j_S9 . "</td>";
        echo "<td>" . $j_RR9 . "</td>";
        echo "<td>" . $j_RB9 . "</td>";
        echo "<td>" . $ent9 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi10 . "</td>";
        echo "<td>" . $jml10 . "</td>";
        echo "<td>" . $j_B10 . "</td>";
        echo "<td>" . $j_S10 . "</td>";
        echo "<td>" . $j_RR10 . "</td>";
        echo "<td>" . $j_RB10 . "</td>";
        echo "<td>" . $ent10 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr><td colspan='8'></td></tr>";
    }

    mysqli_query($conn, "INSERT INTO gain VALUES ('','1','$atribut','$gainRasio')");
}

function cek_nilaiAtribut($conn, $field, $kondisi)
{
    //sql disticnt		
    $hasil = array();
    if ($kondisi == '') {
        $sql = mysqli_query($conn, "SELECT DISTINCT($field) FROM datapreprocessing");
    } else {
        $sql = mysqli_query($conn, "SELECT DISTINCT($field) FROM datapreprocessing WHERE $kondisi");
    }
    $a = 0;
    while ($row = mysqli_fetch_array($sql)) {
        $hasil[$a] = $row['0'];
        $a++;
    }
    return $hasil;
}


//fungsi hitung rasio
function hitung_rasio($conn, $kasus, $atribut, $gain, $nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6, $nilai7, $nilai8, $nilai9, $nilai10, $nilai11)
{
    $data_kasus = '';
    if ($kasus != '') {
        $data_kasus = $kasus . " AND ";
    }

    mysqli_query($conn, "TRUNCATE rasio_gain");
    //jika nilai= 5
    if ($nilai11 == '') {
        $opsi11 = jumlah_data($conn, "$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3')");
        $opsi12 = jumlah_data($conn, "$data_kasus $atribut='$nilai1'");
        $tot_opsi1 = $opsi11 + $opsi12;
        $opsi21 = jumlah_data($conn, "$data_kasus ($atribut='$nilai3' OR $atribut='$nilai1')");
        $opsi22 = jumlah_data($conn, "$data_kasus $atribut='$nilai2'");
        $tot_opsi2 = $opsi21 + $opsi22;
        $opsi31 = jumlah_data($conn, "$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2')");
        $opsi32 = jumlah_data($conn, "$data_kasus $atribut='$nilai3'");
        $tot_opsi3 = $opsi31 + $opsi32;
        $opsi41 = jumlah_data($conn, "$data_kasus ($atribut='$nilai3' OR $atribut='$nilai5')");
        $opsi42 = jumlah_data($conn, "$data_kasus $atribut='$nilai4'");
        $tot_opsi4 = $opsi41 + $opsi42;
        $opsi51 = jumlah_data($conn, "$data_kasus ($atribut='$nilai4' OR $atribut='$nilai6')");
        $opsi52 = jumlah_data($conn, "$data_kasus $atribut='$nilai5'");
        $tot_opsi5 = $opsi51 + $opsi52;
        $opsi61 = jumlah_data($conn, "$data_kasus ($atribut='$nilai5' OR $atribut='$nilai7')");
        $opsi62 = jumlah_data($conn, "$data_kasus $atribut='$nilai6'");
        $tot_opsi6 = $opsi61 + $opsi62;
        $opsi71 = jumlah_data($conn, "$data_kasus ($atribut='$nilai6' OR $atribut='$nilai8')");
        $opsi72 = jumlah_data($conn, "$data_kasus $atribut='$nilai7'");
        $tot_opsi7 = $opsi71 + $opsi72;
        $opsi81 = jumlah_data($conn, "$data_kasus ($atribut='$nilai7' OR $atribut='$nilai9')");
        $opsi82 = jumlah_data($conn, "$data_kasus $atribut='$nilai8'");
        $tot_opsi8 = $opsi81 + $opsi82;
        $opsi91 = jumlah_data($conn, "$data_kasus ($atribut='$nilai8' OR $atribut='$nilai10')");
        $opsi92 = jumlah_data($conn, "$data_kasus $atribut='$nilai9'");
        $tot_opsi9 = $opsi91 + $opsi92;
        $opsi101 = jumlah_data($conn, "$data_kasus ($atribut='$nilai9' OR $atribut='$nilai1')");
        $opsi102 = jumlah_data($conn, "$data_kasus $atribut='$nilai10'");
        $tot_opsi10 = $opsi101 + $opsi102;
        //hitung split info
        $opsi1 = @(- ($opsi11 / $tot_opsi1) * (log(($opsi11 / $tot_opsi1), 2))) + (- ($opsi12 / $tot_opsi1) * (log(($opsi12 / $tot_opsi1), 2)));
        $opsi2 = @(- ($opsi21 / $tot_opsi2) * (log(($opsi21 / $tot_opsi2), 2))) + (- ($opsi22 / $tot_opsi2) * (log(($opsi22 / $tot_opsi2), 2)));
        $opsi3 = @(- ($opsi31 / $tot_opsi3) * (log(($opsi31 / $tot_opsi3), 2))) + (- ($opsi32 / $tot_opsi3) * (log(($opsi32 / $tot_opsi3), 2)));
        $opsi4 = @(- ($opsi41 / $tot_opsi4) * (log(($opsi41 / $tot_opsi4), 2))) + (- ($opsi42 / $tot_opsi4) * (log(($opsi42 / $tot_opsi4), 2)));
        $opsi5 = @(- ($opsi51 / $tot_opsi5) * (log(($opsi51 / $tot_opsi5), 2))) + (- ($opsi52 / $tot_opsi5) * (log(($opsi52 / $tot_opsi5), 2)));
        $opsi6 = @(- ($opsi61 / $tot_opsi6) * (log(($opsi61 / $tot_opsi6), 2))) + (- ($opsi62 / $tot_opsi6) * (log(($opsi62 / $tot_opsi6), 2)));
        $opsi7 = @(- ($opsi71 / $tot_opsi7) * (log(($opsi71 / $tot_opsi7), 2))) + (- ($opsi72 / $tot_opsi7) * (log(($opsi72 / $tot_opsi7), 2)));
        $opsi8 = @(- ($opsi81 / $tot_opsi8) * (log(($opsi81 / $tot_opsi8), 2))) + (- ($opsi82 / $tot_opsi8) * (log(($opsi82 / $tot_opsi8), 2)));
        $opsi9 = @(- ($opsi91 / $tot_opsi9) * (log(($opsi91 / $tot_opsi9), 2))) + (- ($opsi92 / $tot_opsi9) * (log(($opsi92 / $tot_opsi9), 2)));
        $opsi10 = @(- ($opsi101 / $tot_opsi10) * (log(($opsi101 / $tot_opsi10), 2))) + (- ($opsi102 / $tot_opsi10) * (log(($opsi102 / $tot_opsi10), 2)));

        //desimal 3 angka dibelakang koma
        $opsi1 = format_decimal($opsi1);
        $opsi2 = format_decimal($opsi2);
        $opsi3 = format_decimal($opsi3);
        $opsi4 = format_decimal($opsi4);
        $opsi5 = format_decimal($opsi5);
        $opsi6 = format_decimal($opsi6);
        $opsi7 = format_decimal($opsi7);
        $opsi8 = format_decimal($opsi8);
        $opsi9 = format_decimal($opsi9);
        $opsi10 = format_decimal($opsi10);
        //hitung rasio
        $rasioA = @$gain / $opsi1;
        $rasioB = @$gain / $opsi2;
        $rasioC = @$gain / $opsi3;
        $rasioD = @$gain / $opsi4;
        $rasioE = @$gain / $opsi5;
        $rasioF = @$gain / $opsi6;
        $rasioG = @$gain / $opsi7;
        $rasioH = @$gain / $opsi8;
        $rasioI = @$gain / $opsi9;
        $rasioJ = @$gain / $opsi10;
        //desimal 3 angka dibelakang koma
        $rasioA = format_decimal($rasioA);
        $rasioB = format_decimal($rasioB);
        $rasioC = format_decimal($rasioC);
        $rasioD = format_decimal($rasioD);
        $rasioE = format_decimal($rasioE);
        $rasioF = format_decimal($rasioF);
        $rasioG = format_decimal($rasioG);
        $rasioH = format_decimal($rasioH);
        $rasioI = format_decimal($rasioI);
        $rasioJ = format_decimal($rasioJ);

        //insert 
        mysqli_query($conn, "INSERT INTO rasio_gain VALUES 
                                    ('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3' , '$rasioA'),
                                    ('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai1' , '$rasioB'),
                                    ('' , 'opsi3' , '$nilai3' , '$nilai1 , $nilai2' , '$rasioC'),
                                    ('' , 'opsi4' , '$nilai4' , '$nilai3 , $nilai5' , '$rasioD'),
                                    ('' , 'opsi5' , '$nilai5' , '$nilai4 , $nilai6' , '$rasioE'),
                                    ('' , 'opsi6' , '$nilai6' , '$nilai5 , $nilai7' , '$rasioF'),
                                    ('' , 'opsi7' , '$nilai7' , '$nilai6 , $nilai8' , '$rasioG'),
                                    ('' , 'opsi8' , '$nilai8' , '$nilai7 , $nilai9' , '$rasioH'),
                                    ('' , 'opsi9' , '$nilai9' , '$nilai8 , $nilai10' , '$rasioI'),
                                    ('' , 'opsi10' , '$nilai10' , '$nilai9 , $nilai1' , '$rasioJ')
                                    ");
    } elseif ($nilai6 == '') {
        $opsi11 = jumlah_data($conn, "$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3')");
        $opsi12 = jumlah_data($conn, "$data_kasus $atribut='$nilai1'");
        $tot_opsi1 = $opsi11 + $opsi12;
        $opsi21 = jumlah_data($conn, "$data_kasus ($atribut='$nilai3' OR $atribut='$nilai1')");
        $opsi22 = jumlah_data($conn, "$data_kasus $atribut='$nilai2'");
        $tot_opsi2 = $opsi21 + $opsi22;
        $opsi31 = jumlah_data($conn, "$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2')");
        $opsi32 = jumlah_data($conn, "$data_kasus $atribut='$nilai3'");
        $tot_opsi3 = $opsi31 + $opsi32;
        $opsi41 = jumlah_data($conn, "$data_kasus ($atribut='$nilai3' OR $atribut='$nilai5')");
        $opsi42 = jumlah_data($conn, "$data_kasus $atribut='$nilai4'");
        $tot_opsi4 = $opsi41 + $opsi42;
        $opsi51 = jumlah_data($conn, "$data_kasus ($atribut='$nilai1' OR $atribut='$nilai4')");
        $opsi52 = jumlah_data($conn, "$data_kasus $atribut='$nilai5'");
        $tot_opsi5 = $opsi51 + $opsi52;
        //hitung split info
        $opsi1 = @(- ($opsi11 / $tot_opsi1) * (log(($opsi11 / $tot_opsi1), 2))) + (- ($opsi12 / $tot_opsi1) * (log(($opsi12 / $tot_opsi1), 2)));
        $opsi2 = @(- ($opsi21 / $tot_opsi2) * (log(($opsi21 / $tot_opsi2), 2))) + (- ($opsi22 / $tot_opsi2) * (log(($opsi22 / $tot_opsi2), 2)));
        $opsi3 = @(- ($opsi31 / $tot_opsi3) * (log(($opsi31 / $tot_opsi3), 2))) + (- ($opsi32 / $tot_opsi3) * (log(($opsi32 / $tot_opsi3), 2)));
        $opsi4 = @(- ($opsi41 / $tot_opsi4) * (log(($opsi41 / $tot_opsi4), 2))) + (- ($opsi42 / $tot_opsi4) * (log(($opsi42 / $tot_opsi4), 2)));
        $opsi5 = @(- ($opsi51 / $tot_opsi5) * (log(($opsi51 / $tot_opsi5), 2))) + (- ($opsi52 / $tot_opsi5) * (log(($opsi52 / $tot_opsi5), 2)));
        //desimal 3 angka dibelakang koma
        $opsi1 = format_decimal($opsi1);
        $opsi2 = format_decimal($opsi2);
        $opsi3 = format_decimal($opsi3);
        $opsi4 = format_decimal($opsi4);
        $opsi5 = format_decimal($opsi5);
        $splitinfototal = $opsi1 + $opsi2 + $opsi3 + $opsi4 + $opsi5;
        // var_dump($splitinfototal);
        die;
        //hitung rasio
        $rasioA = @$gain / $opsi1;
        $rasioB = @$gain / $opsi2;
        $rasioC = @$gain / $opsi3;
        $rasioD = @$gain / $opsi4;
        $rasioE = @$gain / $opsi5;
        //desimal 3 angka dibelakang koma
        $rasioA = format_decimal($rasioA);
        $rasioB = format_decimal($rasioB);
        $rasioC = format_decimal($rasioC);
        $rasioD = format_decimal($rasioD);
        $rasioE = format_decimal($rasioE);


        //insert 
        mysqli_query($conn, "INSERT INTO rasio_gain VALUES 
                                    ('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3' , '$rasioA'),
                                    ('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai1' , '$rasioB'),
                                    ('' , 'opsi3' , '$nilai3' , '$nilai1 , $nilai2' , '$rasioC'),
                                    ('' , 'opsi4' , '$nilai4' , '$nilai3 , $nilai5' , '$rasioD'),
                                    ('' , 'opsi5' , '$nilai5' , '$nilai4 , $nilai1' , '$rasioE')
                                    ");
    } else if ($nilai4 == '') {
        $opsi11 = jumlah_data($conn, "$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3')");
        $opsi12 = jumlah_data($conn, "$data_kasus $atribut='$nilai1'");
        $tot_opsi1 = $opsi11 + $opsi12;
        $opsi21 = jumlah_data($conn, "$data_kasus ($atribut='$nilai3' OR $atribut='$nilai1')");
        $opsi22 = jumlah_data($conn, "$data_kasus $atribut='$nilai2'");
        $tot_opsi2 = $opsi21 + $opsi22;
        $opsi31 = jumlah_data($conn, "$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2')");
        $opsi32 = jumlah_data($conn, "$data_kasus $atribut='$nilai3'");
        $tot_opsi3 = $opsi31 + $opsi32;
        //hitung split info
        $opsi1 = @(- ($opsi11 / $tot_opsi1) * (log(($opsi11 / $tot_opsi1), 2))) + (- ($opsi12 / $tot_opsi1) * (log(($opsi12 / $tot_opsi1), 2)));
        $opsi2 = @(- ($opsi21 / $tot_opsi2) * (log(($opsi21 / $tot_opsi2), 2))) + (- ($opsi22 / $tot_opsi2) * (log(($opsi22 / $tot_opsi2), 2)));
        $opsi3 = @(- ($opsi31 / $tot_opsi3) * (log(($opsi31 / $tot_opsi3), 2))) + (- ($opsi32 / $tot_opsi3) * (log(($opsi32 / $tot_opsi3), 2)));
        //desimal 3 angka dibelakang koma
        $opsi1 = format_decimal($opsi1);
        $opsi2 = format_decimal($opsi2);
        $opsi3 = format_decimal($opsi3);
        //hitung rasio
        $rasioA = @$gain / $opsi1;
        $rasioB = @$gain / $opsi2;
        $rasioC = @$gain / $opsi3;
        //desimal 3 angka dibelakang koma
        $rasioA = format_decimal($rasioA);
        $rasioB = format_decimal($rasioB);
        $rasioC = format_decimal($rasioC);

        //insert 
        mysqli_query($conn, "INSERT INTO rasio_gain VALUES 
                                    ('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3' , '$rasioA'),
                                    ('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai1' , '$rasioB'),
                                    ('' , 'opsi3' , '$nilai3' , '$nilai1 , $nilai2' , '$rasioC')");
    }


    if ($nilai4 == "") {
        //cetak
        echo "Opsi 1 : <br>jumlah " . $nilai2 . "/" . $nilai3 . " = " . $opsi11 .
            "<br>jumlah " . $nilai1 . " = " . $opsi12 .
            "<br>Split = " . $opsi1 .
            "<br>Rasio = " . $rasioA . "<br>";
        echo "Opsi 2 : <br>jumlah " . $nilai3 . "/" . $nilai1 . " = " . $opsi21 .
            "<br>jumlah " . $nilai2 . " = " . $opsi22 .
            "<br>Split = " . $opsi2 .
            "<br>Rasio = " . $rasioB . "<br>";
        echo "Opsi 3 : <br>jumlah " . $nilai1 . "/" . $nilai2 . " = " . $opsi31 .
            "<br>jumlah " . $nilai3 . " = " . $opsi32 .
            "<br>Split = " . $opsi3 .
            "<br>Rasio = " . $rasioC . "<br>";
    } elseif ($nilai6 == "") {
        //cetak
        echo "Opsi 1 : <br>jumlah " . $nilai2 . "/" . $nilai3 . " = " . $opsi11 .
            "<br>jumlah " . $nilai1 . " = " . $opsi12 .
            "<br>Split = " . $opsi1 .
            "<br>Rasio = " . $rasioA . "<br>";
        echo "Opsi 2 : <br>jumlah " . $nilai3 . "/" . $nilai1 . " = " . $opsi21 .
            "<br>jumlah " . $nilai2 . " = " . $opsi22 .
            "<br>Split = " . $opsi2 .
            "<br>Rasio = " . $rasioB . "<br>";
        echo "Opsi 3 : <br>jumlah " . $nilai4 . "/" . $nilai2 . " = " . $opsi31 .
            "<br>jumlah " . $nilai3 . " = " . $opsi32 .
            "<br>Split = " . $opsi3 .
            "<br>Rasio = " . $rasioC . "<br>";
        echo "Opsi 4 : <br>jumlah " . $nilai3 . "/" . $nilai5 . " = " . $opsi41 .
            "<br>jumlah " . $nilai4 . " = " . $opsi42 .
            "<br>Split = " . $opsi4 .
            "<br>Rasio = " . $rasioD . "<br>";
        echo "Opsi 5 : <br>jumlah " . $nilai4 . "/" . $nilai6 . " = " . $opsi51 .
            "<br>jumlah " . $nilai5 . " = " . $opsi52 .
            "<br>Split = " . $opsi5 .
            "<br>Rasio = " . $rasioE . "<br>";
        // echo "Splitinfo total = " . $splitinfototal . "<br>";
    } else {
        //cetak
        echo "Opsi 1 : <br>jumlah " . $nilai2 . "/" . $nilai3 . " = " . $opsi11 .
            "<br>jumlah " . $nilai1 . " = " . $opsi12 .
            "<br>Split = " . $opsi1 .
            "<br>Rasio = " . $rasioA . "<br>";
        echo "Opsi 2 : <br>jumlah " . $nilai3 . "/" . $nilai1 . " = " . $opsi21 .
            "<br>jumlah " . $nilai2 . " = " . $opsi22 .
            "<br>Split = " . $opsi2 .
            "<br>Rasio = " . $rasioB . "<br>";
        echo "Opsi 3 : <br>jumlah " . $nilai1 . "/" . $nilai2 . " = " . $opsi31 .
            "<br>jumlah " . $nilai3 . " = " . $opsi32 .
            "<br>Split = " . $opsi3 .
            "<br>Rasio = " . $rasioC . "<br>";
        echo "Opsi 4 : <br>jumlah " . $nilai3 . "/" . $nilai5 . " = " . $opsi41 .
            "<br>jumlah " . $nilai4 . " = " . $opsi42 .
            "<br>Split = " . $opsi4 .
            "<br>Rasio = " . $rasioD . "<br>";
        echo "Opsi 5 : <br>jumlah " . $nilai4 . "/" . $nilai6 . " = " . $opsi51 .
            "<br>jumlah " . $nilai5 . " = " . $opsi52 .
            "<br>Split = " . $opsi5 .
            "<br>Rasio = " . $rasioE . "<br>";
        echo "Opsi 6 : <br>jumlah " . $nilai5 . "/" . $nilai7 . " = " . $opsi61 .
            "<br>jumlah " . $nilai6 . " = " . $opsi62 .
            "<br>Split = " . $opsi6 .
            "<br>Rasio = " . $rasioF . "<br>";
        echo "Opsi 7 : <br>jumlah " . $nilai6 . "/" . $nilai8 . " = " . $opsi71 .
            "<br>jumlah " . $nilai7 . " = " . $opsi72 .
            "<br>Split = " . $opsi7 .
            "<br>Rasio = " . $rasioG . "<br>";
        echo "Opsi 8 : <br>jumlah " . $nilai7 . "/" . $nilai9 . " = " . $opsi81 .
            "<br>jumlah " . $nilai8 . " = " . $opsi82 .
            "<br>Split = " . $opsi8 .
            "<br>Rasio = " . $rasioH . "<br>";
        echo "Opsi 9 : <br>jumlah " . $nilai8 . "/" . $nilai10 . " = " . $opsi91 .
            "<br>jumlah " . $nilai9 . " = " . $opsi92 .
            "<br>Split = " . $opsi9 .
            "<br>Rasio = " . $rasioI . "<br>";
        echo "Opsi 10 : <br>jumlah " . $nilai9 . "/" . $nilai1 . " = " . $opsi101 .
            "<br>jumlah " . $nilai10 . " = " . $opsi102 .
            "<br>Split = " . $opsi10 .
            "<br>Rasio = " . $rasioJ . "<br>";
    }




    $sql_max = mysqli_query($conn, "SELECT MAX(rasio_gain) FROM rasio_gain");
    $row_max = mysqli_fetch_array($sql_max);
    $max_rasio = $row_max['0'];
    $sql = mysqli_query($conn, "SELECT * FROM rasio_gain WHERE rasio_gain=$max_rasio");
    $row = mysqli_fetch_array($sql);
    $opsiMax = array();
    $opsiMax[0] = $row[2];
    $opsiMax[1] = $row[3];
    echo "<br>=========================<br>";
    return $opsiMax;
}

function table10($conn, $tabel, $jml_tabel, $nilai_tabel, $kondisi, $entropy_all)
{
    if ($jml_tabel != 1) {
        $NA1_tabel = "$tabel='$nilai_tabel[0]'";
        $NA2_tabel = "";
        $NA3_tabel = "";
        $NA4_tabel = "";
        $NA5_tabel = "";
        $NA6_tabel = "";
        $NA7_tabel = "";
        $NA8_tabel = "";
        $NA9_tabel = "";
        $NA10_tabel = "";
        if ($jml_tabel == 2) {
            $NA2_tabel = "$tabel='$nilai_tabel[1]'";
        } else if ($jml_tabel == 3) {
            $NA2_tabel = "$tabel='$nilai_tabel[1]'";
            $NA3_tabel = "$tabel='$nilai_tabel[2]'";
        } else if ($jml_tabel == 4) {
            $NA2_tabel = "$tabel='$nilai_tabel[1]'";
            $NA3_tabel = "$tabel='$nilai_tabel[2]'";
            $NA4_tabel = "$tabel='$nilai_tabel[3]'";
        } else if ($jml_tabel == 5) {
            $NA2_tabel = "$tabel='$nilai_tabel[1]'";
            $NA3_tabel = "$tabel='$nilai_tabel[2]'";
            $NA4_tabel = "$tabel='$nilai_tabel[3]'";
            $NA5_tabel = "$tabel='$nilai_tabel[4]'";
        } else if ($jml_tabel == 6) {
            $NA2_tabel = "$tabel='$nilai_tabel[1]'";
            $NA3_tabel = "$tabel='$nilai_tabel[2]'";
            $NA4_tabel = "$tabel='$nilai_tabel[3]'";
            $NA5_tabel = "$tabel='$nilai_tabel[4]'";
            $NA6_tabel = "$tabel='$nilai_tabel[5]'";
        } else if ($jml_tabel == 7) {
            $NA2_tabel = "$tabel='$nilai_tabel[1]'";
            $NA3_tabel = "$tabel='$nilai_tabel[2]'";
            $NA4_tabel = "$tabel='$nilai_tabel[3]'";
            $NA5_tabel = "$tabel='$nilai_tabel[4]'";
            $NA6_tabel = "$tabel='$nilai_tabel[5]'";
            $NA7_tabel = "$tabel='$nilai_tabel[6]'";
        } else if ($jml_tabel == 8) {
            $NA2_tabel = "$tabel='$nilai_tabel[1]'";
            $NA3_tabel = "$tabel='$nilai_tabel[2]'";
            $NA4_tabel = "$tabel='$nilai_tabel[3]'";
            $NA5_tabel = "$tabel='$nilai_tabel[4]'";
            $NA6_tabel = "$tabel='$nilai_tabel[5]'";
            $NA7_tabel = "$tabel='$nilai_tabel[6]'";
            $NA8_tabel = "$tabel='$nilai_tabel[7]'";
        } else if ($jml_tabel == 9) {
            $NA2_tabel = "$tabel='$nilai_tabel[1]'";
            $NA3_tabel = "$tabel='$nilai_tabel[2]'";
            $NA4_tabel = "$tabel='$nilai_tabel[3]'";
            $NA5_tabel = "$tabel='$nilai_tabel[4]'";
            $NA6_tabel = "$tabel='$nilai_tabel[5]'";
            $NA7_tabel = "$tabel='$nilai_tabel[6]'";
            $NA8_tabel = "$tabel='$nilai_tabel[7]'";
            $NA9_tabel = "$tabel='$nilai_tabel[8]'";
        } else if ($jml_tabel == 10) {
            $NA2_tabel = "$tabel='$nilai_tabel[1]'";
            $NA3_tabel = "$tabel='$nilai_tabel[2]'";
            $NA4_tabel = "$tabel='$nilai_tabel[3]'";
            $NA5_tabel = "$tabel='$nilai_tabel[4]'";
            $NA6_tabel = "$tabel='$nilai_tabel[5]'";
            $NA7_tabel = "$tabel='$nilai_tabel[6]'";
            $NA8_tabel = "$tabel='$nilai_tabel[7]'";
            $NA9_tabel = "$tabel='$nilai_tabel[8]'";
            $NA10_tabel = "$tabel='$nilai_tabel[9]'";
        }

        // hitung_gain($conn, $kondisi, "$tabel", $entropy_all, $NA1_tabel, $NA2_tabel, $NA3_tabel, "$NA4_tabel", "$NA5_tabel", "$NA6_tabel", "$NA7_tabel", "$NA8_tabel", "$NA9_tabel", "$NA10_tabel", "");
    }
}
