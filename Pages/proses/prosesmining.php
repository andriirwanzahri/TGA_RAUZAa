<?php
error_reporting(E_ALL ^  E_NOTICE);
function format_decimal($value)
{
    return round($value, 3);
}
function proses_DT(
    $conn,
    $parent,
    $kasus_cabang1,
    $kasus_cabang2
    // $kasus_cabang3,
    // $kasus_cabang4,
    // $kasus_cabang5,
    // $kasus_cabang6,
    // $kasus_cabang7,
    // $kasus_cabang8,
    // $kasus_cabang9,
    // $kasus_cabang10
) {
    echo "cabang 1<br>";
    pembentukan_tree($conn, $parent, $kasus_cabang1);
    echo "cabang 2<br>";
    pembentukan_tree($conn, $parent, $kasus_cabang2);
    // echo "cabang 3<br>";
    // pembentukan_tree($conn, $parent, $kasus_cabang3);
    // echo "cabang 4<br>";
    // pembentukan_tree($conn, $parent, $kasus_cabang4);
    // echo "cabang 5<br>";
    // pembentukan_tree($conn, $parent, $kasus_cabang5);
    // echo "cabang 6<br>";
    // pembentukan_tree($conn, $parent, $kasus_cabang6);
    // echo "cabang 7<br>";
    // pembentukan_tree($conn, $parent, $kasus_cabang7);
    // echo "cabang 8<br>";
    // pembentukan_tree($conn, $parent, $kasus_cabang8);
    // echo "cabang 9<br>";
    // pembentukan_tree($conn, $parent, $kasus_cabang9);
    // echo "cabang 10<br>";
    // pembentukan_tree($conn, $parent, $kasus_cabang10);
}
function pembentukan_tree($conn, $N_parent, $kasus)
{
    //mengisi kondisi
    if ($N_parent != '') {
        $kondisi = $N_parent . " AND " . $kasus;
    } else {
        $kondisi = $kasus;
    }

    // echo $kondisi . "<br>";
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


        $nilai_namaLintas = array();
        $nilai_namaLintas = cek_nilaiAtribut($conn, 'namaLintas', $kondisi);
        $jmlnamaLintas = count($nilai_namaLintas);
        //hitung entropy semua
        $entropy_all = hitung_entropy($jml_baik, $jml_sedang, $jml_rusak_ringan, $jml_rusak_berat);
        echo "Entropy All = " . $entropy_all . "<br>";
        echo "<table class='table table-bordered table-striped  table-hover'>";
        echo "<tr><th>Nilai Atribut</th> <th>Jumlah data</th> <th>Jumlah Baik</th> <th>Jumlah Sedang</th> "
            . "<th>Jumlah Rusak Ringan</th> <th>Jumlah Rusak Berat</th> <th>Entropy</th> <th>Gain</th><tr>";
        mysqli_query($conn, "TRUNCATE gain");
        totalData($jml_total, $jml_baik, $jml_sedang, $jml_rusak_ringan, $jml_rusak_berat, $entropy_all);
        //hitung gain atribut KATEGORIKAL
        // hitung_gain($conn, $kondisi, "ura_dukung", $entropy_all, "ura_dukung='KA'", "ura_dukung='KCT'", "ura_dukung='KM'", "ura_dukung='KMI'", "ura_dukung='KP'", "", "", "", "", "", "");
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
        // hitung_gain($conn, $kondisi, "namaLintas", $entropy_all, "namaLintas='LJK'", "namaLintas='LJN'", "namaLintas='LJP'", "", "", "", "", "", "", "", "");


        // hitung_gain(
        //     $conn,
        //     $kondisi,
        //     "panjangRuas",
        //     $entropy_all,
        //     "panjangRuas='SPES'",
        //     "panjangRuas='SPE'",
        //     "panjangRuas='PE'",
        //     "panjangRuas='SS'",
        //     "panjangRuas='CS'",
        //     "panjangRuas='S'",
        //     "panjangRuas='PA'",
        //     "panjangRuas='CP'",
        //     "panjangRuas='SPA'",
        //     "panjangRuas='SPAS'",
        //     ""
        // );
        hitung_gain($conn, $kondisi, "jns_pen", $entropy_all, "jns_pen='P'", "jns_pen='PB'", "", "", "", "", "", "", "", "", "");
        // hitung_gain($conn, $kondisi, "tanah_krikil", $entropy_all, "tanah_krikil='SPES'", "tanah_krikil='SPE'", "tanah_krikil='PE'", "tanah_krikil='SS'", "tanah_krikil='CS'", "tanah_krikil='S'", "tanah_krikil='PA'", "tanah_krikil='CP'", "tanah_krikil='SPA'", "tanah_krikil='SPAS'", "");
        // hitung_gain($conn, $kondisi, "aspal", $entropy_all, "aspal='SPES'", "aspal='SPE'", "aspal='PE'", "aspal='SS'", "aspal='CS'", "aspal='S'", "aspal='PA'", "aspal='CP'", "aspal='SPA'", "aspal='SPAS'", "");
        // hitung_gain($conn, $kondisi, "rigit", $entropy_all, "rigit='SPES'", "rigit='SPE'", "rigit='PE'", "rigit='SS'", "rigit='CS'", "rigit='S'", "rigit='PA'", "rigit='CP'", "rigit='SPA'", "rigit='SPAS'", "");
        echo "</table>";


        //ambil nilai gain terBesar
        $sql_max = mysqli_query($conn, "SELECT MAX(gain) FROM gain");
        $row_max = mysqli_fetch_array($sql_max);
        $max_gain = $row_max[0];
        $sql = mysqli_query($conn, "SELECT * FROM gain WHERE gain=$max_gain");
        $row = mysqli_fetch_array($sql);
        $atribut = $row[2];
        echo "Atribut terpilih = " . $atribut . ", dengan nilai gain = " . $max_gain . "<br>";
        echo "<br>================================<br>";

        if ($max_gain == 0) {
            echo "Gain adalah 0";
            echo "<br>LEAF ";
            // var_dump($kondisi);
            die;
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
                proses_DT($conn, $kondisi, "(jns_pen ='PB')", "(jns_pen ='P')");
            }
            //nama lintas terpilih
            if ($atribut == "namaLintas") {
                //jika nilai atribut 3
                if ($jmlnamaLintas == 3) {
                    //hitung rasio
                    $cabang = array();
                    $cabang = hitung_rasio($conn, $kondisi, 'namaLintas', $max_gain, $nilai_namaLintas[0], $nilai_namaLintas[1], $nilai_namaLintas[2], '', '');
                    $exp_cabang = explode(" , ", $cabang[1]);
                    proses_DT($conn, $kondisi, "($atribut='$cabang[0]')", "($atribut='$exp_cabang[0]' OR $atribut='$exp_cabang[1]')");
                }
                //jika nilai atribut 2
                else if ($jmlnamaLintas == 2) {
                    proses_DT($conn, $kondisi, "($atribut='$nilai_namaLintas[0]')", "($atribut='$nilai_namaLintas[1]')");
                }
            }
        }
        // //jika max_gain >0 lanjut..
        // else {
        //     echo "Gain adalah lebih besar dari 0";

        //     if ($atribut == "jns_pen") {
        //         proses_DT($conn, $kondisi, "(jns_pen ='PB')", "(jns_pen ='P')", "", "", "", "", "", "", "", "");
        //     }
        //     // jenis kelamin terpilih
        //     if ($atribut == "aspal") {
        //         proses_DT($conn, $kondisi, "($atribut='SPES')", "($atribut='SPE')", "($atribut='PE')", "($atribut='SS')", "($atribut='CS')", "($atribut='S')", "($atribut='PA')", "($atribut='CP')", "($atribut='SPA')", "($atribut='SPAS')");
        //     }

        //     if ($atribut == "panjangRuas") {
        //         proses_DT($conn, $kondisi, "($atribut='SPES')", "($atribut='SPE')", "($atribut='PE')", "($atribut='SS')", "($atribut='CS')", "($atribut='S')", "($atribut='PA')", "($atribut='CP')", "($atribut='SPA')", "($atribut='SPAS')");
        //     }

        //     // sekolah terpilih
        //     if ($atribut == "tanah_krikil") {
        //         proses_DT($conn, $kondisi, "($atribut='SPES')", "($atribut='SPE')", "($atribut='PE')", "($atribut='SS')", "($atribut='CS')", "($atribut='S')", "($atribut='PA')", "($atribut='CP')", "($atribut='SPA')", "($atribut='SPAS')");
        //     }

        //     if ($atribut == "rigit") {
        //         proses_DT($conn, $kondisi, "($atribut='SPES')", "($atribut='SPE')", "($atribut='PE')", "($atribut='SS')", "($atribut='CS')", "($atribut='S')", "($atribut='PA')", "($atribut='CP')", "($atribut='SPA')", "($atribut='SPAS')");
        //     }

        //     // Jawaban D Terpilih
        //     // if ($atribut == "Jawaban D v=5") {
        //     //     proses_DT($conn, $kondisi, "(jawaban_d<=5)", "(jawaban_d>5)");
        //     // } else if ($atribut == "Jawaban D v=10") {
        //     //     proses_DT($conn, $kondisi, "(jawaban_d<=10)", "(jawaban_d>10)");
        //     // } else if ($atribut == "Jawaban D v=15") {
        //     //     proses_DT($conn, $kondisi, "(jawaban_d<=15)", "(jawaban_d>15)");
        //     // } else if ($atribut == "Jawaban D v=20") {
        //     //     proses_DT($conn, $kondisi, "(jawaban_d<=20)", "(jawaban_d>20)");
        //     // }
        // }
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

        $gain = $ent_all - @((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2));
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
        echo "<td>&nbsp;</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $kondisi2 . "</td>";
        echo "<td>" . $jml2 . "</td>";
        echo "<td>" . $j_B2 . "</td>";
        echo "<td>" . $j_S2 . "</td>";
        echo "<td>" . $j_RR2 . "</td>";
        echo "<td>" . $j_RB2 . "</td>";
        echo "<td>" . $ent2 . "</td>";
        echo "<td>" . $gain . "</td>";
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

        $gain = $ent_all - @((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3));
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
        echo "<td>&nbsp;</td>";
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
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $kondisi3 . "</td>";
        echo "<td>" . $jml3 . "</td>";
        echo "<td>" . $j_B3 . "</td>";
        echo "<td>" . $j_S3 . "</td>";
        echo "<td>" . $j_RR3 . "</td>";
        echo "<td>" . $j_RB3 . "</td>";
        echo "<td>" . $ent3 . "</td>";
        echo "<td>" . $gain . "</td>";
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
        $gain = $ent_all - @((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2) + (($jml3 / $jml_total) * $ent3) + (($jml4 / $jml_total) * $ent4) + (($jml5 / $jml_total) * $ent5));

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
        echo "<td>&nbsp;</td>";
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
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi5 . "</td>";
        echo "<td>" . $jml5 . "</td>";
        echo "<td>" . $j_B5 . "</td>";
        echo "<td>" . $j_S5 . "</td>";
        echo "<td>" . $j_RR5 . "</td>";
        echo "<td>" . $j_RB5 . "</td>";
        echo "<td>" . $ent5 . "</td>";
        echo "<td>" . $gain . "</td>";
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
        echo "<td>&nbsp;</td>";
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
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi10 . "</td>";
        echo "<td>" . $jml10 . "</td>";
        echo "<td>" . $j_B10 . "</td>";
        echo "<td>" . $j_S10 . "</td>";
        echo "<td>" . $j_RR10 . "</td>";
        echo "<td>" . $j_RB10 . "</td>";
        echo "<td>" . $ent10 . "</td>";
        echo "<td>" . $gain . "</td>";
        echo "</tr>";

        echo "<tr><td colspan='8'></td></tr>";
    }

    mysqli_query($conn, "INSERT INTO gain VALUES ('','1','$atribut','$gain')");
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
function hitung_rasio($conn, $kasus, $atribut, $gain, $nilai1, $nilai2, $nilai3, $nilai4, $nilai5)
{
    $data_kasus = '';
    if ($kasus != '') {
        $data_kasus = $kasus . " AND ";
    }
    //menentukan jumlah nilai
    $jmlNilai = 10;
    //jika nilai 5 kosong maka nilai atribut-nya 4
    if ($nilai5 == '') {
        $jmlNilai = 4;
    }
    //jika nilai 4 kosong maka nilai atribut-nya 3
    if ($nilai4 == '') {
        $jmlNilai = 3;
    }
    mysqli_query($conn, "TRUNCATE rasio_gain");
    if ($jmlNilai == 3) {
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
        $rasio1 = @$gain / $opsi1;
        $rasio2 = @$gain / $opsi2;
        $rasio3 = @$gain / $opsi3;
        //desimal 3 angka dibelakang koma
        $rasio1 = format_decimal($rasio1);
        $rasio2 = format_decimal($rasio2);
        $rasio3 = format_decimal($rasio3);
        //cetak
        echo "Opsi 1 : <br>jumlah " . $nilai2 . "/" . $nilai3 . " = " . $opsi11 .
            "<br>jumlah " . $nilai1 . " = " . $opsi12 .
            "<br>Split = " . $opsi1 .
            "<br>Rasio = " . $rasio1 . "<br>";
        echo "Opsi 2 : <br>jumlah " . $nilai3 . "/" . $nilai1 . " = " . $opsi21 .
            "<br>jumlah " . $nilai2 . " = " . $opsi22 .
            "<br>Split = " . $opsi2 .
            "<br>Rasio = " . $rasio2 . "<br>";
        echo "Opsi 3 : <br>jumlah " . $nilai1 . "/" . $nilai2 . " = " . $opsi31 .
            "<br>jumlah " . $nilai3 . " = " . $opsi32 .
            "<br>Split = " . $opsi3 .
            "<br>Rasio = " . $rasio3 . "<br>";

        //insert 
        mysqli_query($conn, "INSERT INTO rasio_gain VALUES 
                                    ('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3' , '$rasio1'),
                                    ('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai1' , '$rasio2'),
                                    ('' , 'opsi3' , '$nilai3' , '$nilai1 , $nilai2' , '$rasio3')");
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
