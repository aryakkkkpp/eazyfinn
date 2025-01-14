<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else { ?>
  <div class="container-fluid">
    <!-- judul halaman -->
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-fw fa-tachometer-alt mr-2"></i>Dashboard</h1>
    <!-- menampilkan pesan selamat datang -->
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      <i class="fas fa-user mr-2"></i>Selamat datang kembali <strong><?php echo $_SESSION['nama_user']; ?></strong> di Aplikasi Manajemen Kas. Anda login sebagai <strong><?php echo $_SESSION['hak_akses']; ?></strong>.
    </div>

    <div class="row">
      <!-- menampilkan informasi jumlah total seluruh pemasukan -->
      <div class="col-lg-4 col-md-12 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-info mb-2">Total Seluruh Pemasukan</div>
                <?php
                // sql statement untuk menampilkan jumlah total pemasukan dari tabel "tbl_transaksi"
                $query = mysqli_query($mysqli, "SELECT SUM(pemasukan) as total FROM tbl_transaksi")
                                                or die('Ada kesalahan pada query jumlah total pemasukan : ' . mysqli_error($mysqli));
                // ambil data hasil query
                $data = mysqli_fetch_assoc($query);
                // buat variabel untuk menampilkan data
                $total_pemasukan = $data['total'];
                ?>
                <!-- tampilkan data -->
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo number_format($total_pemasukan, 0, '', '.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- menampilkan informasi jumlah total seluruh pengeluaran -->
      <div class="col-lg-4 col-md-12 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-warning mb-2">Total Seluruh Pengeluaran</div>
                <?php
                // sql statement untuk menampilkan jumlah total pengeluaran dari tabel "tbl_transaksi"
                $query = mysqli_query($mysqli, "SELECT SUM(pengeluaran) as total FROM tbl_transaksi")
                                                or die('Ada kesalahan pada query jumlah total pengeluaran : ' . mysqli_error($mysqli));
                // ambil data hasil query
                $data = mysqli_fetch_assoc($query);
                // buat variabel untuk menampilkan data
                $total_pengeluaran = $data['total'];
                ?>
                <!-- tampilkan data -->
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo number_format($total_pengeluaran, 0, '', '.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-sign-out-alt fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- menampilkan informasi jumlah saldo -->
      <div class="col-lg-4 col-md-12 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-success mb-2">Saldo</div>
                <?php
                // hitung saldo
                $saldo       = $total_pemasukan - $total_pengeluaran;
                $saldo_akhir = ($saldo < 0) ? 0 : $saldo;
                ?>
                <!-- tampilkan data -->
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo number_format($saldo_akhir, 0, '', '.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- grafik jumlah pemasukan per kategori -->
      <div class="col mt-3 mb-4">
        <div class="card shadow">
          <div class="card-header py-3">
            <!-- judul grafik -->
            <h6 class="m-0 font-weight-bold ">Grafik Jumlah Pemasukan Per Kategori</h6>
          </div>
          <div class="card-body">
            <div class="chart-bar">
              <!-- menampilkan grafik -->
              <canvas id="grafik-pemasukan"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- grafik jumlah pengeluaran per kategori -->
      <div class="col mt-3 mb-5">
        <div class="card shadow">
          <div class="card-header py-3">
            <!-- judul grafik -->
            <h6 class="m-0 font-weight-bold ">Grafik Jumlah Pengeluaran Per Kategori</h6>
          </div>
          <div class="card-body">
            <div class="chart-bar">
              <!-- menampilkan grafik -->
              <canvas id="grafik-pengeluaran"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    <?php
    // sql statement untuk menampilkan data "nama_kategori" dari tabel "tbl_kategori"
    $query_kategori = mysqli_query($mysqli, "SELECT nama_kategori FROM tbl_kategori WHERE tipe='Pemasukan'")
                                            or die('Ada kesalahan pada query tampil data kategori : ' . mysqli_error($mysqli));

    // sql statement untuk menampilkan jumlah pemasukan dari tabel "tbl_transaksi" berdasarkan "kategori"
    $query_pemasukan = mysqli_query($mysqli, "SELECT a.nama_kategori, SUM(b.pemasukan) as jumlah 
                                              FROM tbl_kategori as a LEFT JOIN tbl_transaksi as b ON a.id_kategori=b.kategori 
                                              WHERE tipe='Pemasukan' GROUP BY a.id_kategori")
                                              or die('Ada kesalahan pada query jumlah pemasukan : ' . mysqli_error($mysqli));
    ?>

    // Bar Chart
    var ctx = document.getElementById("grafik-pemasukan");
    var grafikPemasukan = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          <?php while ($data = mysqli_fetch_assoc($query_kategori)) {
            echo '"' . $data['nama_kategori'] . '",';
          }
          ?>
        ],
        datasets: [{
          label: "Jumlah",
          backgroundColor: "#36b9cc",
          hoverBackgroundColor: "#2c9faf",
          borderColor: "#36b9cc",
          data: [
            <?php while ($data = mysqli_fetch_assoc($query_pemasukan)) {
              echo '"' . $data['jumlah'] . '",';
            }
            ?>
          ],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false,
              drawBorder: false
            },
            maxBarThickness: 70,
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true,
              maxTicksLimit: 5,
              padding: 10
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ' : Rp. ' + tooltipItem.yLabel;
            }
          }
        },
      }
    });

    <?php
    // sql statement untuk menampilkan data "nama_kategori" dari tabel "tbl_kategori"
    $query_kategori = mysqli_query($mysqli, "SELECT nama_kategori FROM tbl_kategori WHERE tipe='Pengeluaran'")
                                            or die('Ada kesalahan pada query tampil data kategori : ' . mysqli_error($mysqli));

    // sql statement untuk menampilkan jumlah pengeluaran dari tabel "tbl_transaksi" berdasarkan "kategori"
    $query_pengeluaran = mysqli_query($mysqli, "SELECT a.nama_kategori, SUM(b.pengeluaran) as jumlah 
                                                FROM tbl_kategori as a LEFT JOIN tbl_transaksi as b ON a.id_kategori=b.kategori 
                                                WHERE tipe='Pengeluaran' GROUP BY a.id_kategori")
                                                or die('Ada kesalahan pada query jumlah pengeluaran : ' . mysqli_error($mysqli));
    ?>

    // Bar Chart
    var ctx = document.getElementById("grafik-pengeluaran");
    var grafikPengeluaran = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          <?php while ($data = mysqli_fetch_assoc($query_kategori)) {
            echo '"' . $data['nama_kategori'] . '",';
          }
          ?>
        ],
        datasets: [{
          label: "Jumlah",
          backgroundColor: "#f6c23e",
          hoverBackgroundColor: "#f4b619",
          borderColor: "#f6c23e",
          data: [
            <?php while ($data = mysqli_fetch_assoc($query_pengeluaran)) {
              echo '"' . $data['jumlah'] . '",';
            }
            ?>
          ],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false,
              drawBorder: false
            },
            maxBarThickness: 70,
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true,
              maxTicksLimit: 5,
              padding: 10
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ' : Rp. ' + tooltipItem.yLabel;
            }
          }
        },
      }
    });
  </script>
<?php } ?>