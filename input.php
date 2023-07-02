<?php
include('koneksi.php');

//DATA JAM DAN TANGGAL
date_default_timezone_set('Asia/Jakarta');
$jam = date('H:i:s');
$tanggal = date('d-m-y');

//DATA PENGIRIMAN DATA SENSOR MENGGUNAKAN GET
$data_sensor_arus = $_GET['data_sensor_arus'];
$data_sensor_tegangan = $_GET['data_sensor_tegangan'];
$data_sensor_rpm = $_GET['data_sensor_rpm'];

if ($data_sensor_arus < 10) {
    $status = "DATA TERKIRIM KE DATABASE";
}

$input = mysqli_query($koneksi, "INSERT INTO data (tanggal, jam, data_sensor_arus, data_sensor_tegangan, data_sensor_rpm, status) VALUES ('$tanggal', '$jam', '$data_sensor_arus', '$data_sensor_tegangan', '$data_sensor_rpm', '$status')");
if ($input == TRUE) {
    echo "BERHASIL INPUT DATA";
} else {
    echo "GAGAL INPUT DATA";
}
?>
