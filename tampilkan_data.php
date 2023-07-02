<?php
include('koneksi.php');

// Mengambil data dari tabel
$query = "SELECT data_sensor_arus, data_sensor_tegangan, data_sensor_rpm FROM data";
$result = mysqli_query($koneksi, $query);

// Membuat array untuk menyimpan data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Mengubah data menjadi format JSON
$json_data = json_encode($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tampilkan Data Sensor</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.27.0/dist/apexcharts.min.js"></script>
</head>
<body>
    <div id="chart"></div>

    <script>
        // Mendapatkan data JSON dari PHP
        var jsonData = <?php echo $json_data; ?>;

        // Memisahkan data sensor menjadi array terpisah
        var dataArus = [];
        var dataTegangan = [];
        var dataRPM = [];
        for (var i = 0; i < jsonData.length; i++) {
            dataArus.push(jsonData[i].data_sensor_arus);
            dataTegangan.push(jsonData[i].data_sensor_tegangan);
            dataRPM.push(jsonData[i].data_sensor_rpm);
        }

        // Menampilkan grafik menggunakan ApexCharts
        var options = {
            chart: {
                type: 'line'
            },
            series: [
                {
                    name: 'Arus',
                    data: dataArus
                },
                {
                    name: 'Tegangan',
                    data: dataTegangan
                },
                {
                    name: 'RPM',
                    data: dataRPM
                }
            ],
            xaxis: {
                categories: jsonData.map(function(item) {
                    return item.tanggal + ' ' + item.jam;
                })
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
</body>
</html>
