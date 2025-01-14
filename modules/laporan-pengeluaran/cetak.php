<?php
session_start();      // mengaktifkan session

// panggil file "autoload.inc.php" untuk load dompdf, libraries, dan helper functions
require_once("../../assets/vendor/dompdf/autoload.inc.php");
// mereferensikan Dompdf namespace
use Dompdf\Dompdf;

// pengecekan session login user 
// jika user belum login
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  // alihkan ke halaman login dan tampilkan pesan peringatan login
  header('location: ../../login.php?pesan=2');
}
// jika user sudah login, maka jalankan perintah untuk cetak
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";
  // panggil file "fungsi_tanggal_indo.php" untuk membuat format tanggal indonesia
  require_once "../../helper/fungsi_tanggal_indo.php";

  // ambil data GET dari tombol cetak
  $tgl_awal  = $_GET['tgl_awal'];
  $tgl_akhir = $_GET['tgl_akhir'];
  $kategori  = $_GET['kategori'];

  // ubah format tanggal menjadi Tahun-Bulan-Hari (Y-m-d)
  $tanggal_awal  = date('Y-m-d', strtotime($tgl_awal));
  $tanggal_akhir = date('Y-m-d', strtotime($tgl_akhir));

  // variabel untuk nomor urut tabel 
  $no = 1;
  // variabel untuk total pengeluaran
  $total_pengeluaran = 0;

  // gunakan dompdf class
  $dompdf = new Dompdf();
  // setting options
  $options = $dompdf->getOptions();
  $options->setIsRemoteEnabled(true); // aktifkan akses file untuk bisa mengakses file gambar dan CSS
  $options->setChroot('C:\xampp\htdocs\kas'); // tentukan path direktori aplikasi
  $dompdf->setOptions($options);

  // mengecek kategori pengeluaran yang akan ditampilkan
  // jika kategori pengeluaran = "Semua"
  if ($kategori == 'Semua') {
    // halaman HTML yang akan diubah ke PDF
    $html = '<!DOCTYPE html>
            <html>
            <head>
              <title>Laporan Pengeluaran Per Periode</title>
              <link href="../../assets/css/laporan.css" rel="stylesheet">
            </head>
            <body class="text-dark">
              <div class="text-center">
                <h4>LAPORAN PENGELUARAN</h4>
                <span>Tanggal ' . $tgl_awal . ' s.d. ' . $tgl_akhir . '</span>
              </div>
              <hr>
              <div class="mt-4">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead class="bg-success text-white text-center">
                    <tr>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Kategori Pengeluaran</th>
                      <th>Deskripsi Transaksi</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody class="text-dark">';
    // sql statement untuk menampilkan data pengeluaran dari tabel "tbl_transaksi" dan tabel "tbl_kategori" berdasarkan "tanggal"
    $query = mysqli_query($mysqli, "SELECT a.tanggal, a.kategori, a.deskripsi, a.pengeluaran, b.nama_kategori 
                                    FROM tbl_transaksi as a INNER JOIN tbl_kategori as b ON a.kategori=b.id_kategori
                                    WHERE a.pengeluaran!='NULL' AND a.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                                    ORDER BY a.tanggal ASC, a.id_transaksi ASC")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    while ($data = mysqli_fetch_assoc($query)) {
      // tampilkan data
      $html .= '		<tr>
                      <td width="30" class="text-center">' . $no++ . '</td>
                      <td width="80" class="text-center">' . date('d-m-Y', strtotime($data['tanggal'])) . '</td>
                      <td width="150">' . $data['nama_kategori'] . '</td>
                      <td width="280">' . $data['deskripsi'] . '</td>
                      <td width="120" class="text-right">Rp. ' . number_format($data['pengeluaran'], 0, '', '.') . '</td>
                    </tr>';
      // jumlahkan "pengeluaran" untuk mendapatkan "total_pengeluaran"
      $total_pengeluaran += $data['pengeluaran'];
    }
    // tampilkan data total
    $html .= '			<tr>
                      <td class="text-center font-weight-bold" colspan="4">Total Pengeluaran</td>
                      <td class="text-right font-weight-bold">Rp. ' . number_format($total_pengeluaran, 0, '', '.') . '</td>
                    </tr>';
    $html .= '		</tbody>
					    </table>
				    </div>
				    <div class="text-right mt-5">..............., ' . tanggal_indo(date('Y-m-d')) . '</div>
    		  </body>
			    </html>';

    // load html
    $dompdf->loadHtml($html);
    // mengatur ukuran dan orientasi kertas
    $dompdf->setPaper('A4', 'landscape');
    // mengubah dari HTML menjadi PDF
    $dompdf->render();
    // menampilkan file PDF yang dihasilkan ke browser dan berikan nama file
    $dompdf->stream('Laporan Pengeluaran Tanggal ' . $tgl_awal . ' sd ' . $tgl_akhir . '.pdf', array('Attachment' => 0));
  }
  // jika kategori pengeluaran != "Semua" 
  elseif ($kategori != 'Semua') {
    // sql statement untuk menampilkan "nama_kategori" dari tabel "tbl_kategori" berdasarkan "id_kategori"
    $query_kategori = mysqli_query($mysqli, "SELECT nama_kategori FROM tbl_kategori WHERE id_kategori='$kategori'")
                                            or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data_kategori = mysqli_fetch_assoc($query_kategori);
    // buat variabel untuk menampilkan data
    $nama_kategori = $data_kategori['nama_kategori'];

    // halaman HTML yang akan diubah ke PDF
    $html = '<!DOCTYPE html>
            <html>
            <head>
              <title>Laporan Pengeluaran Per Periode dan Per Kategori</title>
              <link href="../../assets/css/laporan.css" rel="stylesheet">
            </head>
            <body class="text-dark">
              <div class="text-center">
                <h4>LAPORAN PENGELUARAN ' . strtoupper($nama_kategori) . '</h4>
                <span>Tanggal ' . $tgl_awal . ' s.d. ' . $tgl_akhir . '</span>
              </div>
              <hr>
              <div class="mt-4">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead class="bg-success text-white text-center">
                    <tr>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Deskripsi Transaksi</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody class="text-dark">';
    // sql statement untuk menampilkan data pengeluaran dari tabel "tbl_transaksi" berdasarkan "kategori" dan "tanggal"
    $query = mysqli_query($mysqli, "SELECT tanggal, deskripsi, pengeluaran FROM tbl_transaksi
                                    WHERE pengeluaran!='NULL' AND kategori='$kategori' AND tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                                    ORDER BY tanggal ASC, id_transaksi ASC")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    while ($data = mysqli_fetch_assoc($query)) {
      // tampilkan data
      $html .= '		<tr>
                      <td width="30" class="text-center">' . $no++ . '</td>
                      <td width="80" class="text-center">' . date('d-m-Y', strtotime($data['tanggal'])) . '</td>
                      <td width="280">' . $data['deskripsi'] . '</td>
                      <td width="120" class="text-right">Rp. ' . number_format($data['pengeluaran'], 0, '', '.') . '</td>
                    </tr>';
      // jumlahkan "pengeluaran" untuk mendapatkan "total_pengeluaran"
      $total_pengeluaran += $data['pengeluaran'];
    }
    // tampilkan data total
    $html .= '			<tr>
                      <td class="text-center font-weight-bold" colspan="3">Total Pengeluaran</td>
                      <td class="text-right font-weight-bold">Rp. ' . number_format($total_pengeluaran, 0, '', '.') . '</td>
                    </tr>';
    $html .= '		</tbody>
					    </table>
				    </div>
				    <div class="text-right mt-5">..............., ' . tanggal_indo(date('Y-m-d')) . '</div>
    		  </body>
			    </html>';

    // load html
    $dompdf->loadHtml($html);
    // mengatur ukuran dan orientasi kertas
    $dompdf->setPaper('A4', 'landscape');
    // mengubah dari HTML menjadi PDF
    $dompdf->render();
    // menampilkan file PDF yang dihasilkan ke browser dan berikan nama file
    $dompdf->stream('Laporan Pengeluaran ' . $nama_kategori . ' Tanggal ' . $tgl_awal . ' sd ' . $tgl_akhir . '.pdf', array('Attachment' => 0));
  }
}
