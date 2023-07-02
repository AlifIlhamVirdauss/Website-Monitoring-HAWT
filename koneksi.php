<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "hawt";

$koneksi = mysqli_connect($server, $username, $password, $database);
if ($koneksi == TRUE){
    echo "TERHUBUNG KE DATABASE";
}
else {
    echo "TERPUTUS KE DATABASE";
}
?>