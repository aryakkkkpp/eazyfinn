<?php
session_start();      // mengaktifkan session

// pengecekan session login user 
// jika user belum login
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  // alihkan ke halaman login dan tampilkan pesan peringatan login
  header('location: ../../login.php?pesan=2');
}
// jika user sudah login, maka jalankan perintah untuk update
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";

  // mengecek data hasil submit dari form
  if (isset($_POST['simpan'])) {
    // ambil data hasil submit dari form
    $id_transaksi = mysqli_real_escape_string($mysqli, $_POST['id_transaksi']);
    $tanggal      = mysqli_real_escape_string($mysqli, trim($_POST['tanggal']));
    $kategori     = mysqli_real_escape_string($mysqli, $_POST['kategori']);
    $deskripsi    = mysqli_real_escape_string($mysqli, trim($_POST['deskripsi']));
    $jumlah       = mysqli_real_escape_string($mysqli, $_POST['jumlah']);

    // ubah format tanggal menjadi Tahun-Bulan-Hari (Y-m-d) sebelum disimpan ke database
    $tanggal_transaksi  = date('Y-m-d', strtotime($tanggal));
    // hilangkan titik sebelum disimpan ke database
    $jumlah_pengeluaran = str_replace('.', '', $jumlah);

    // ambil data file bukti transaksi hasil submit dari form
    $nama_file          = $_FILES['bukti_transaksi']['name'];
    $tmp_file           = $_FILES['bukti_transaksi']['tmp_name'];
    $extension          = array_pop(explode(".", $nama_file));
    // enkripsi nama file bukti transaksi
    $nama_file_enkripsi = sha1(md5(time() . $nama_file)) . '.' . $extension;
    // tentukan direktori penyimpanan file bukti transaksi pengeluaran
    $path               = "../../images/pengeluaran/" . $nama_file_enkripsi;

    // mengecek data file bukti transaksi dari form entri data
    // jika data tidak ada
    if (empty($nama_file)) {
      // sql statement untuk update data di tabel "tbl_transaksi" berdasarkan "id_transaksi"
      $update = mysqli_query($mysqli, "UPDATE tbl_transaksi 
                                       SET tanggal='$tanggal_transaksi', kategori='$kategori', deskripsi='$deskripsi', pengeluaran='$jumlah_pengeluaran'
                                       WHERE id_transaksi='$id_transaksi'")
                                       or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
      // cek query
      // jika proses update berhasil
      if ($update) {
        // alihkan ke halaman pengeluaran dan tampilkan pesan berhasil ubah data
        header('location: ../../main.php?module=pengeluaran&pesan=2');
      }
    }
    // jika data ada
    else {
      // lakukan proses unggah file
      // jika file berhasil diunggah
      if (move_uploaded_file($tmp_file, $path)) {
        // sql statement untuk update data di tabel "tbl_transaksi" berdasarkan "id_transaksi"
        $update = mysqli_query($mysqli, "UPDATE tbl_transaksi 
                                         SET tanggal='$tanggal_transaksi', kategori='$kategori', deskripsi='$deskripsi', pengeluaran='$jumlah_pengeluaran', bukti_transaksi='$nama_file_enkripsi'
                                         WHERE id_transaksi='$id_transaksi'")
                                         or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
        // cek query
        // jika proses update berhasil
        if ($update) {
          // alihkan ke halaman pengeluaran dan tampilkan pesan berhasil ubah data
          header('location: ../../main.php?module=pengeluaran&pesan=2');
        }
      }
    }
  }
}
