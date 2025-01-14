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

  // mengecek data GET "id_transaksi"
  if (isset($_GET['id'])) {
    // ambil data GET dari tombol hapus
    $id_transaksi = mysqli_real_escape_string($mysqli, $_GET['id']);

    // mengecek data "bukti_transaksi"
    // sql statement untuk menampilkan data "bukti_transaksi" dari tabel "tbl_transaksi" berdasarkan "id_transaksi"
    $query = mysqli_query($mysqli, "SELECT bukti_transaksi FROM tbl_transaksi WHERE id_transaksi='$id_transaksi'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
    // buat variabel untuk menampung data
    $bukti_transaksi = $data['bukti_transaksi'];

    // jika data "bukti_transaksi" tidak kosong
    if (!empty($bukti_transaksi)) {
      // hapus file bukti transaksi dari folder penyimpanan 
      $hapus_file = unlink("../../images/pengeluaran/$bukti_transaksi");
    }
    // selanjutnya hapus data dari database
    // sql statement untuk delete data dari tabel "tbl_transaksi" berdasarkan "id_transaksi"
    $delete = mysqli_query($mysqli, "DELETE FROM tbl_transaksi WHERE id_transaksi='$id_transaksi'")
                                     or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
    // cek query
    // jika proses delete berhasil
    if ($delete) {
      // alihkan ke halaman pengeluaran dan tampilkan pesan berhasil hapus data
      header('location: ../../main.php?module=pengeluaran&pesan=3');
    }
  }
}
