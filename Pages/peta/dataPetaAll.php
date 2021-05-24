<?php
include "../../koneksi.php";
$Q = mysqli_query($conn, "SELECT * FROM datajalan");
if ($Q) {
    $posts = array();
    if (mysqli_num_rows($Q)) {
        while ($post = mysqli_fetch_array($Q)) {
            $posts[] = $post;
        }
    }
    $data = json_encode(array('results' => $posts));
    echo $data;
    json_decode($data);
}
