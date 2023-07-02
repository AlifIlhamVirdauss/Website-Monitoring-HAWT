<?php
include('koneksi.php');

// Ambil data dari database
$query = mysqli_query($koneksi, "SELECT * FROM data");
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
  $data[] = $row;
}

// Siapkan array untuk data grafik
$tanggal = [];
$rpm = [];
$arus = [];
$tegangan = [];
foreach ($data as $row) {
  $tanggal[] = $row['tanggal'];
  $rpm[] = $row['data_sensor_rpm'];
  $arus[] = $row['data_sensor_arus'];
  $tegangan[] = $row['data_sensor_tegangan'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Yawing- based Sistem Monitoring HAWT</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/iconfav.png" rel="icon">
  <link href="assets/img/icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.jpg" alt="">
        <span class="d-none d-lg-block"><font size ="3">Sistem Monitoring HAWT</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
	
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="anggota.html">
          <i class="bi bi-person"></i>
          <span>About Team</span>
        </a>
    
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Sistem Monitoring Yawing- Based HAWT</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <p>Data Monitoring Yawing- based Horizontal Axis Wind Turbine. Ikuti instagram <a href="https://www.instagram.com/efficient.turbine_pkm.kc/" target="_blank">Efficient Turbine</a> untuk mengenal kami lebih dalam.</p>

    <section class="section">
      <div class="row">

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Kecepatan Angin (rpm)</h5>

              <!-- Line Chart -->
              <div id="lineChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#lineChart"), {
                    // Mengubah series.data dengan data rpm dari database
                    series: [{
                    name: "Kecepatan Angin (rpm)",
                    data: [
                        <?php
                        foreach ($data as $row) {
                            echo $row['data_sensor_rpm'] . ",";
                        }
                        ?>
                    ]
                    }],

                    chart: {
                      height: 350,
                      type: 'line',
                      zoom: {
                        enabled: false
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      curve: 'straight'
                    },
                    grid: {
                      row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                      },
                    },
                    xaxis: {
                    categories: [
                        <?php
                        foreach ($data as $row) {
                            echo "'" . $row['tanggal'] . "',";
                        }
                        ?>
                    ]
                    },

                  }).render();
                });
              </script>
              <!-- End Line Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Daya</h5>

              <!-- Column Chart -->
              <div id="columnChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#columnChart"), {
                    // Mengubah series.data untuk setiap kategori (Tegangan, Arus, Watt) dengan data dari database
                    series: [{
                    name: 'Tegangan',
                    data: [
                        <?php
                        foreach ($data as $row) {
                            echo $row['data_sensor_tegangan'] . ",";
                        }
                        ?>
                    ]
                    }, {
                    name: 'Arus',
                    data: [
                        <?php
                        foreach ($data as $row) {
                            echo $row['data_sensor_arus'] . ",";
                        }
                        ?>
                    ]
                    }],

                    chart: {
                      type: 'bar',
                      height: 350
                    },
                    plotOptions: {
                      bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                      },
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      show: true,
                      width: 2,
                      colors: ['transparent']
                    },
                    xaxis: {
                    categories: [
                        <?php
                        foreach ($data as $row) {
                            echo "'" . $row['tanggal'] . "',";
                        }
                        ?>
                    ]
                    },

                    yaxis: {
                      title: {
                        text: 'Satuan (V, A)'
                      }
                    },
                    fill: {
                      opacity: 1
                    },
                    tooltip: {
                      y: {
                        formatter: function(val) {
                          return val
                        }
                      }
                    }
                  }).render();
                });
              </script>
              <!-- End Column Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Putaran Turbine dan Daya</h5>

              <!-- Bar Chart -->
              <div id="barChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#barChart"), {
                    series: [{
                    name: 'Tegangan',
                    data: [
                        <?php
                        foreach ($data as $row) {
                            echo $row['data_sensor_tegangan'] . ",";
                        }
                        ?>
                    ]
                    }, {
                    name: 'Arus',
                    data: [
                        <?php
                        foreach ($data as $row) {
                            echo $row['data_sensor_arus'] . ",";
                        }
                        ?>
                    ]
                    }, {
                    name: 'Kecepatan Angin',
                    data: [
                        <?php
                        foreach ($data as $row) {
                            echo $row['data_sensor_rpm'] . ",";
                        }
                        ?>
                    ]
                    }],

                    
                    chart: {
                      type: 'bar',
                      height: 350
                    },
                    plotOptions: {
                      bar: {
                        borderRadius: 4,
                        horizontal: true,
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    xaxis: {
                      categories: ['Kecepatan Angin', 'Tegangan', 'Arus'],
                    }
                  }).render();
                });
              </script>
              <!-- End Bar Chart -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  
  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>