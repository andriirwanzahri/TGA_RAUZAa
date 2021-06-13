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
        $jnspen = "jns_pen";

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
        echo "<table class='table table-bordered'width='100%' cellspacing='0'>";
        echo "<tr style='color:#CE7E00;'>
        <th>Atribut</th>
        <th>Nilai Atribut</th>
        <th>Jumlah data</th>
        <th>Jumlah Baik</th>
        <th>Jumlah Sedang</th>
        <th>Jumlah Rusak Ringan</th>
        <th>Jumlah Rusak Berat</th>
        <th>Entropy</th>
        <th>Gain</th>
        <th>Split Info</th>
        <th>Gain rasio</th>
        <tr>";
        mysqli_query($conn, "TRUNCATE gain");
        totalData($jml_total, $jml_baik, $jml_sedang, $jml_rusak_ringan, $jml_rusak_berat, $entropy_all);
        //hitung gain atribut KATEGORIKAL
        if ($jmlura_dukung != 1) {
            $NA1ura_dukung = "$nilai_ura_dukung[0]";
            $NA2ura_dukung = "";
            $NA3ura_dukung = "";
            if ($jmlura_dukung == 2) {
                $NA2ura_dukung = "$nilai_ura_dukung[1]";
            } else if ($jmlura_dukung == 3) {
                $NA2ura_dukung = "$nilai_ura_dukung[1]";
                $NA3ura_dukung = "$nilai_ura_dukung[2]";
            } else if ($jmlura_dukung == 4) {
                $NA2ura_dukung = "$nilai_ura_dukung[1]";
                $NA3ura_dukung = "$nilai_ura_dukung[2]";
                $NA4ura_dukung = "$nilai_ura_dukung[3]";
            } else if ($jmlura_dukung == 5) {
                $NA2ura_dukung = "$nilai_ura_dukung[1]";
                $NA3ura_dukung = "$nilai_ura_dukung[2]";
                $NA4ura_dukung = "$nilai_ura_dukung[3]";
                $NA5ura_dukung = "$nilai_ura_dukung[4]";
            }
            // var_dump($nilai_ura_dukung);

            hitung_gain($conn, $kondisi, "ura_dukung", $entropy_all, $NA1ura_dukung, $NA2ura_dukung, $NA3ura_dukung, $NA4ura_dukung, $NA5ura_dukung, "", "", "", "", "", "");
        }
        if ($jmlnamaLintas != 1) {
            $NA1namaLintas = "$nilai_namaLintas[0]";
            $NA2namaLintas = "";
            $NA3namaLintas = "";
            if ($jmlnamaLintas == 2) {
                $NA2namaLintas = "$nilai_namaLintas[1]";
            } else if ($jmlnamaLintas == 3) {
                $NA2namaLintas = "$nilai_namaLintas[1]";
                $NA3namaLintas = "$nilai_namaLintas[2]";
            }
            hitung_gain($conn, $kondisi, "namaLintas", $entropy_all, $NA1namaLintas, $NA2namaLintas, $NA3namaLintas, "", "", "", "", "", "", "", "");
        }
        hitung_gain(
            $conn,
            $kondisi,
            "panjangRuas",
            $entropy_all,
            "SPES",
            "SPE",
            "PE",
            "SS",
            "CS",
            "S",
            "PA",
            "CP",
            "SPA",
            "SPAS",
            ""
        );
        hitung_gain($conn, $kondisi, "jns_pen", $entropy_all, "P", "PB", "", "", "", "", "", "", "", "", "");
        if ($jmltanah_krikil != 1) {
            $NA1tanah_krikil = "$nilai_tanah_krikil[0]";
            if ($jmltanah_krikil == 2) {
                $NA2tanah_krikil = "$nilai_tanah_krikil[1]";
            } else if ($jmltanah_krikil == 3) {
                $NA2tanah_krikil = "$nilai_tanah_krikil[1]";
                $NA3tanah_krikil = "$nilai_tanah_krikil[2]";
            } else if ($jmltanah_krikil == 4) {
                $NA2tanah_krikil = "$nilai_tanah_krikil[1]";
                $NA3tanah_krikil = "$nilai_tanah_krikil[2]";
                $NA4tanah_krikil = "$nilai_tanah_krikil[3]";
            } else if ($jmltanah_krikil == 5) {
                $NA2tanah_krikil = "$nilai_tanah_krikil[1]";
                $NA3tanah_krikil = "$nilai_tanah_krikil[2]";
                $NA4tanah_krikil = "$nilai_tanah_krikil[3]";
                $NA5tanah_krikil = "$nilai_tanah_krikil[4]";
            } else if ($jmltanah_krikil == 6) {
                $NA2tanah_krikil = "$nilai_tanah_krikil[1]";
                $NA3tanah_krikil = "$nilai_tanah_krikil[2]";
                $NA4tanah_krikil = "$nilai_tanah_krikil[3]";
                $NA5tanah_krikil = "$nilai_tanah_krikil[4]";
                $NA6tanah_krikil = "$nilai_tanah_krikil[5]";
            } else if ($jmltanah_krikil == 7) {
                $NA2tanah_krikil = "$nilai_tanah_krikil[1]";
                $NA3tanah_krikil = "$nilai_tanah_krikil[2]";
                $NA4tanah_krikil = "$nilai_tanah_krikil[3]";
                $NA5tanah_krikil = "$nilai_tanah_krikil[4]";
                $NA6tanah_krikil = "$nilai_tanah_krikil[5]";
                $NA7tanah_krikil = "$nilai_tanah_krikil[6]";
            } else if ($jmltanah_krikil == 8) {
                $NA2tanah_krikil = "$nilai_tanah_krikil[1]";
                $NA3tanah_krikil = "$nilai_tanah_krikil[2]";
                $NA4tanah_krikil = "$nilai_tanah_krikil[3]";
                $NA5tanah_krikil = "$nilai_tanah_krikil[4]";
                $NA6tanah_krikil = "$nilai_tanah_krikil[5]";
                $NA7tanah_krikil = "$nilai_tanah_krikil[6]";
                $NA8tanah_krikil = "$nilai_tanah_krikil[7]";
            } else if ($jmltanah_krikil == 9) {
                $NA2tanah_krikil = "$nilai_tanah_krikil[1]";
                $NA3tanah_krikil = "$nilai_tanah_krikil[2]";
                $NA4tanah_krikil = "$nilai_tanah_krikil[3]";
                $NA5tanah_krikil = "$nilai_tanah_krikil[4]";
                $NA6tanah_krikil = "$nilai_tanah_krikil[5]";
                $NA7tanah_krikil = "$nilai_tanah_krikil[6]";
                $NA8tanah_krikil = "$nilai_tanah_krikil[7]";
                $NA9tanah_krikil = "$nilai_tanah_krikil[8]";
            } else if ($jmltanah_krikil == 10) {
                $NA2tanah_krikil = "$nilai_tanah_krikil[1]";
                $NA3tanah_krikil = "$nilai_tanah_krikil[2]";
                $NA4tanah_krikil = "$nilai_tanah_krikil[3]";
                $NA5tanah_krikil = "$nilai_tanah_krikil[4]";
                $NA6tanah_krikil = "$nilai_tanah_krikil[5]";
                $NA7tanah_krikil = "$nilai_tanah_krikil[6]";
                $NA8tanah_krikil = "$nilai_tanah_krikil[7]";
                $NA9tanah_krikil = "$nilai_tanah_krikil[8]";
                $NA10tanah_krikil = "$nilai_tanah_krikil[9]";
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
            $NA1aspal = "$nilai_aspal[0]";
            if ($jmlaspal == 2) {
                $NA2aspal = "$nilai_aspal[1]";
            } else if ($jmlaspal == 3) {
                $NA2aspal = "$nilai_aspal[1]";
                $NA3aspal = "$nilai_aspal[2]";
            } else if ($jmlaspal == 4) {
                $NA2aspal = "$nilai_aspal[1]";
                $NA3aspal = "$nilai_aspal[2]";
                $NA4aspal = "$nilai_aspal[3]";
            } else if ($jmlaspal == 5) {
                $NA2aspal = "$nilai_aspal[1]";
                $NA3aspal = "$nilai_aspal[2]";
                $NA4aspal = "$nilai_aspal[3]";
                $NA5aspal = "$nilai_aspal[4]";
            } else if ($jmlaspal == 6) {
                $NA2aspal = "$nilai_aspal[1]";
                $NA3aspal = "$nilai_aspal[2]";
                $NA4aspal = "$nilai_aspal[3]";
                $NA5aspal = "$nilai_aspal[4]";
                $NA6aspal = "$nilai_aspal[5]";
            } else if ($jmlaspal == 7) {
                $NA2aspal = "$nilai_aspal[1]";
                $NA3aspal = "$nilai_aspal[2]";
                $NA4aspal = "$nilai_aspal[3]";
                $NA5aspal = "$nilai_aspal[4]";
                $NA6aspal = "$nilai_aspal[5]";
                $NA7aspal = "$nilai_aspal[6]";
            } else if ($jmlaspal == 8) {
                $NA2aspal = "$nilai_aspal[1]";
                $NA3aspal = "$nilai_aspal[2]";
                $NA4aspal = "$nilai_aspal[3]";
                $NA5aspal = "$nilai_aspal[4]";
                $NA6aspal = "$nilai_aspal[5]";
                $NA7aspal = "$nilai_aspal[6]";
                $NA8aspal = "$nilai_aspal[7]";
            } else if ($jmlaspal == 9) {
                $NA2aspal = "$nilai_aspal[1]";
                $NA3aspal = "$nilai_aspal[2]";
                $NA4aspal = "$nilai_aspal[3]";
                $NA5aspal = "$nilai_aspal[4]";
                $NA6aspal = "$nilai_aspal[5]";
                $NA7aspal = "$nilai_aspal[6]";
                $NA8aspal = "$nilai_aspal[7]";
                $NA9aspal = "$nilai_aspal[8]";
            } else if ($jmlaspal == 10) {
                $NA2aspal = "$nilai_aspal[1]";
                $NA3aspal = "$nilai_aspal[2]";
                $NA4aspal = "$nilai_aspal[3]";
                $NA5aspal = "$nilai_aspal[4]";
                $NA6aspal = "$nilai_aspal[5]";
                $NA7aspal = "$nilai_aspal[6]";
                $NA8aspal = "$nilai_aspal[7]";
                $NA9aspal = "$nilai_aspal[8]";
                $NA10aspal = "$nilai_aspal[9]";
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
        hitung_gain($conn, $kondisi, "rigit", $entropy_all, "SPES", "SPE", "PE", "SS", "CS", "S", "PA", "CP", "SPA", "SPAS", "");
        echo "</table>";


        //ambil nilai gain terBesar
        $sql_max = mysqli_query($conn, "SELECT MAX(gain) FROM gain");
        $row_max = mysqli_fetch_array($sql_max);
        $max_gain = $row_max[0];
        $sql = mysqli_query($conn, "SELECT * FROM gain WHERE gain=$max_gain");
        $row = mysqli_fetch_array($sql);
        $atribut = $row[2];
        echo "<button class='btn btn-info'>Atribut terpilih = " . $atribut . ", dengan nilai gain rasio= " . $max_gain . "</button><br>";
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
                proses_DT($conn, $kondisi, "(jns_pen='PB')", "(jns_pen='P')", "", "", "", "", "", "", "", "", "");
            }
            if ($atribut == "namaLintas") {
                proses_DT(
                    $conn,
                    $kondisi,
                    "(namaLintas='LJK')",
                    "(namaLintas='LJN')",
                    "(namaLintas='LJP')",
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
                    "(ura_dukung='KA')",
                    "(ura_dukung='KP')",
                    "(ura_dukung='KM')",
                    "(ura_dukung='KCT')",
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
                    "(aspal='SPE')",
                    "(aspal='PE')",
                    "(aspal='SS')",
                    "(aspal='CS')",
                    "(aspal='S')",
                    "(aspal='PA')",
                    "(aspal='CP')",
                    "(aspal='SPA')",
                    "(aspal='SPAS')",
                    ""
                );
            }
            if ($atribut == "tanah_krikil") {
                proses_DT(
                    $conn,
                    $kondisi,
                    "(tanah_krikil='SPES')",
                    "(tanah_krikil='SPE')",
                    "(tanah_krikil='PE')",
                    "(tanah_krikil='SS')",
                    "(tanah_krikil='CS')",
                    "(tanah_krikil='S')",
                    "(tanah_krikil='PA')",
                    "(tanah_krikil='CP')",
                    "(tanah_krikil='SPA')",
                    "(tanah_krikil='SPAS')",
                    ""
                );
            }
            if ($atribut == "rigit") {
                proses_DT(
                    $conn,
                    $kondisi,
                    "(rigit='SPES')",
                    "(rigit='SPE')",
                    "(rigit='PE')",
                    "(rigit='SS')",
                    "(rigit='CS')",
                    "(rigit='S')",
                    "(rigit='PA')",
                    "(rigit='CP')",
                    "(rigit='SPA')",
                    "(rigit='SPAS')",
                    ""
                );
            }
            if ($atribut == "panjangRuas") {
                proses_DT(
                    $conn,
                    $kondisi,
                    "(panjangRuas='SPES')",
                    "(panjangRuas='SPE')",
                    "(panjangRuas='PE')",
                    "(panjangRuas='SS')",
                    "(panjangRuas='CS')",
                    "(panjangRuas='S')",
                    "(panjangRuas='PA')",
                    "(panjangRuas='CP')",
                    "(panjangRuas='SPA')",
                    "(panjangRuas='SPAS')",
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
    echo "<td>&nbsp;</td>";
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
        $j_B1 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi1'");
        $j_S1 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi1'");
        $j_RR1 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi1'");
        $j_RB1 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi1'");
        $jml1 = $j_B1 + $j_S1 + $j_RR1 + $j_RB1;

        $j_B2 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi2'");
        $j_S2 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi2'");
        $j_RR2 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi2'");
        $j_RB2 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi2'");
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
        echo "<td>" . $atribut . "</td>";
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
        echo "<td>&nbsp;</td>";
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
        $j_B1 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi1'");
        $j_S1 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi1'");
        $j_RR1 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi1'");
        $j_RB1 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi1'");
        $jml1 = $j_B1 + $j_S1 + $j_RR1 + $j_RB1;

        $j_B2 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi2'");
        $j_S2 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi2'");
        $j_RR2 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi2'");
        $j_RB2 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi2'");
        $jml2 = $j_B2 + $j_S2 + $j_RR2 + $j_RB2;

        $j_B3 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi3'");
        $j_S3 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi3'");
        $j_RR3 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi3'");
        $j_RB3 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi3'");
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
        echo "<td>" . $atribut . "</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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
        $j_B1 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi1'");
        $j_S1 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi1'");
        $j_RR1 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi1'");
        $j_RB1 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi1'");
        $jml1 = $j_B1 + $j_S1 + $j_RR1 + $j_RB1;

        $j_B2 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi2'");
        $j_S2 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi2'");
        $j_RR2 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi2'");
        $j_RB2 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi2'");
        $jml2 = $j_B2 + $j_S2 + $j_RR2 + $j_RB2;

        $j_B3 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi3'");
        $j_S3 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi3'");
        $j_RR3 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi3'");
        $j_RB3 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi3'");
        $jml3 = $j_B3 + $j_S3 + $j_RR3 + $j_RB3;

        $j_B4 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi4'");
        $j_S4 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi4'");
        $j_RR4 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi4'");
        $j_RB4 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi4'");
        $jml4 = $j_B4 + $j_S4 + $j_RR4 + $j_RB4;

        $j_B5 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi5'");
        $j_S5 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi5'");
        $j_RR5 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi5'");
        $j_RB5 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi5'");
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
        echo "<td>" . $atribut . "</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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
        $j_B1 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi1'");
        $j_S1 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi1'");
        $j_RR1 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi1'");
        $j_RB1 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi1'");
        $jml1 = $j_B1 + $j_S1 + $j_RR1 + $j_RB1;

        $j_B2 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi2'");
        $j_S2 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi2'");
        $j_RR2 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi2'");
        $j_RB2 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi2'");
        $jml2 = $j_B2 + $j_S2 + $j_RR2 + $j_RB2;

        $j_B3 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi3'");
        $j_S3 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi3'");
        $j_RR3 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi3'");
        $j_RB3 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi3'");
        $jml3 = $j_B3 + $j_S3 + $j_RR3 + $j_RB3;

        $j_B4 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi4'");
        $j_S4 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi4'");
        $j_RR4 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi4'");
        $j_RB4 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi4'");
        $jml4 = $j_B4 + $j_S4 + $j_RR4 + $j_RB4;

        $j_B5 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi5'");
        $j_S5 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi5'");
        $j_RR5 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi5'");
        $j_RB5 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi5'");
        $jml5 = $j_B5 + $j_S5 + $j_RR5 + $j_RB5;

        $j_B6 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi6'");
        $j_S6 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi6'");
        $j_RR6 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi6'");
        $j_RB6 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi6'");
        $jml6 = $j_B6 + $j_S6 + $j_RR6 + $j_RB6;

        $j_B7 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi7'");
        $j_S7 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi7'");
        $j_RR7 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi7'");
        $j_RB7 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi7'");
        $jml7 = $j_B7 + $j_S7 + $j_RR7 + $j_RB7;

        $j_B8 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi8'");
        $j_S8 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi8'");
        $j_RR8 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi8'");
        $j_RB8 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi8'");
        $jml8 = $j_B8 + $j_S8 + $j_RR8 + $j_RB8;

        $j_B9 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi9'");
        $j_S9 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi9'");
        $j_RR9 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi9'");
        $j_RB9 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi9'");
        $jml9 = $j_B9 + $j_S9 + $j_RR9 + $j_RB9;

        $j_B10 = jumlah_data($conn, "$data_kasus target='B' AND $atribut='$kondisi10'");
        $j_S10 = jumlah_data($conn, "$data_kasus target='S' AND $atribut='$kondisi10'");
        $j_RR10 = jumlah_data($conn, "$data_kasus target='RR' AND $atribut='$kondisi10'");
        $j_RB10 = jumlah_data($conn, "$data_kasus target='RB' AND $atribut='$kondisi10'");
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
        echo "<td>" . $atribut . "</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "<td>&nbsp;</td>";
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

function klasifikasi(
    $conn,
    $n_ura_dukung,
    $n_namaLintas,
    $n_panjangRuas,
    $n_jns_pen,
    $n_tanah_krikil,
    $n_aspal,
    $n_rigit
) {
    $sql = mysqli_query($conn, "SELECT * FROM t_keputusan");
    $keputusan = $id_rule_keputusan = "";

    while ($row = mysqli_fetch_array($sql)) {
        //menggabungkan parent dan akar dengan kata AND
        if ($row['parent'] != '') {
            $rule = $row['parent'] . " AND " . $row['akar'];
        } else {
            $rule = $row['akar'];
        }
        //=============================================PEMbENTUKAN KARKTER=================================///
        //mengubah parameter
        $rule = str_replace("=", " s ", $rule);
        //mengganti nilai
        $rule = str_replace("ura_dukung", "$n_ura_dukung", $rule);
        $rule = str_replace("namaLintas", "$n_namaLintas", $rule);
        $rule = str_replace("panjangRuas", "$n_panjangRuas", $rule);
        $rule = str_replace("jns_pen", "$n_jns_pen", $rule);
        $rule = str_replace("tanah_krikil", "$n_tanah_krikil", $rule);
        $rule = str_replace("aspal", "$n_aspal", $rule);
        $rule = str_replace("rigit", "$n_rigit", $rule);
        // //menghilangkan '
        $rule = str_replace("'", "", $rule);
        //explode and
        $explodeAND = explode(" AND ", $rule);
        $jmlAND = count($rule);
        $explodeAND = str_replace("(", "", $explodeAND);
        $explodeAND = str_replace(")", "", $explodeAND);
        // //deklarasi bol
        //===========================================END PEMBENTUKAN KARAKTER=============================///
        $bolAND = array();
        $n = 0;
        while ($n < $jmlAND) {
            //pecah  dengan spasi
            $explodeRule = explode(" s ", $explodeAND[0]);
            $explodeRule1 = explode(" s ", $explodeAND[1]);
            $explodeRule2 = explode(" s ", $explodeAND[2]);
            $explodeRule3 = explode(" s ", $explodeAND[3]);
            //nilai true false						
            if ($explodeRule[0] == $explodeRule[1]) {
                if ($explodeRule1[0] == $explodeRule1[1]) {
                    if ($explodeRule2[0] == $explodeRule2[1]) {
                        if ($explodeRule3[0] == $explodeRule3[1]) {
                            $bolAND[$n] = "Benar";
                        } else if ($explodeRule3 == NULL) {
                            $bolAND[$n] = "Benar";
                        } else {
                            $bolAND[$n] = "Salah";
                        }
                        // $bolAND[$n] = "Benar";
                    } else if ($explodeRule3 == NULL) {
                        $bolAND[$n] = "Benar";
                    } else {
                        $bolAND[$n] = "Salah";
                    }
                    // $bolAND[$n] = "Benar";
                } else if ($explodeRule2 == NULL) {
                    $bolAND[$n] = "Benar";
                } else {
                    $bolAND[$n] = "Salah";
                }
            } else if ($explodeRule[0] != $explodeRule[1]) {
                $bolAND[$n] = "Salah";
            }
            $n++;
        }


        //========================================================isi boolrule=====================================================================
        $boolRule = "Benar";
        $a = 0;
        while ($a < $jmlAND) {
            //jika ada yang salah boolrule diganti salah
            if ($bolAND[$a] == "Salah") {
                $boolRule = "Salah";
                break;
            }
            $a++;
        }
        // var_export($bolAND);
        if ($boolRule == "Benar") {
            $keputusan = $row['keputusan'];
            $id_rule_keputusan = $row['id'];
            break;
        }

        //==============================================================================================================////        
        // //jika tidak ada rule yang memenuhi kondisi data uji 
        // //maka ambil rule paling bawah(ambil konisi yg paling panjang)????....
        if ($keputusan == '') {
            $que = mysqli_query($conn, "SELECT parent FROM t_keputusan");
            $jml = array();
            $exParent = array();
            $i = 0;
            while ($row_baris = mysqli_fetch_array($que)) {
                $exParent = explode(" AND ", $row_baris['parent']);
                $jml[$i] = count($exParent);
                $i++;
            }
            $maxParent = max($jml);
            $sql_query = mysqli_query($conn, "SELECT * FROM t_keputusan");
            while ($row_bar = mysqli_fetch_array($sql_query)) {
                $explP = explode(" AND ", $row_bar['parent']);
                $jmlT = count($explP);
                if ($jmlT == $maxParent) {
                    $keputusan = $row_bar['keputusan'];
                    $id_rule = $row_bar['id'];
                    $id_rule_keputusan = $row_bar['id'];
                    break;
                    // var_dump($id_rule);
                    // die;
                }
            }
        }
        //=============================================================================================================////        
    }
    return array('keputusan' => $keputusan, 'id_rule' => $id_rule_keputusan);
}
