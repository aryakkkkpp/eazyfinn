<?php
session_start();      // mengaktifkan session

// pengecekan session login user 
// jika user belum login
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  // alihkan ke halaman login dan tampilkan pesan peringatan login
  header('location: ../../login.php?pesan=2');
}
// jika user sudah login, maka jalankan perintah untuk delete
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";

  // mengecek data GET "id_kategori"
  if (isset($_GET['id'])) {
    // ambil data GET dari tombol hapus
    $id_kategori = mysqli_real_escape_string($mysqli, $_GET['id']);

    // mengecek data kategori untuk mencegah penghapusan data kategori yang sudah digunakan pada tabel "tbl_transaksi"
    // sql statement untuk menampilkan data "kategori" dari tabel "tbl_transaksi" berdasarkan input "id_kategori"
    $query = mysqli_query($mysqli, "SELECT kategori FROM tbl_transaksi WHERE kategori='$id_kategori'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil jumlah baris data hasil query
    $rows = mysqli_num_rows($query);

    // cek hasil query
    // jika data "kategori" sudah ada di tabel "tbl_transaksi"
    if ($rows <> 0) {
      // alihkan ke halaman kategori dan tampilkan pesan gagal hapus data
      header('location: ../../main.php?module=kategori&pesan=5');
    }
    // jika data "kategori" belum ada di tabel "tbl_transaksi"
    else {
      // sql statement untuk delete data dari tabel "tbl_kategori" berdasarkan "id_kategori"
      $delete = mysqli_query($mysqli, "DELETE FROM tbl_kategori WHERE id_kategori='$id_kategori'")
                                       or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
      // cek query
      // jika proses delete berhasil
      if ($delete) {
        // alihkan ke halaman kategori dan tampilkan pesan berhasil hapus data
        header('location: ../../main.php?module=kategori&pesan=3');
      }
    }
  }
}
