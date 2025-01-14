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
    $id_kategori   = mysqli_real_escape_string($mysqli, $_POST['id_kategori']);
    $nama_kategori = mysqli_real_escape_string($mysqli, trim($_POST['nama_kategori']));
    $tipe          = mysqli_real_escape_string($mysqli, $_POST['tipe']);

    // mengecek "nama_kategori" dan "tipe" untuk mencegah data duplikat
    // sql statement untuk menampilkan data dari tabel "tbl_kategori" berdasarkan input "nama_kategori" dan "tipe"
    $query = mysqli_query($mysqli, "SELECT nama_kategori, tipe FROM tbl_kategori 
                                    WHERE nama_kategori='$nama_kategori' AND tipe='$tipe' AND id_kategori!='$id_kategori'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil jumlah baris data hasil query
    $rows = mysqli_num_rows($query);

    // cek hasil query
    // jika "nama_kategori" dan "tipe" sudah ada di tabel "tbl_kategori"
    if ($rows <> 0) {
      // alihkan ke halaman kategori dan tampilkan pesan gagal simpan data
      header("location: ../../main.php?module=kategori&pesan=4&nama_kategori=$nama_kategori&tipe=$tipe");
    }
    // jika "nama_kategori" dan "tipe" belum ada di tabel "tbl_kategori"
    else {
      // sql statement untuk update data di tabel "tbl_kategori" berdasarkan "id_kategori"
      $update = mysqli_query($mysqli, "UPDATE tbl_kategori
                                       SET nama_kategori='$nama_kategori', tipe='$tipe'
                                       WHERE id_kategori='$id_kategori'")
                                       or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
      // cek query
      // jika proses update berhasil
      if ($update) {
        // alihkan ke halaman kategori dan tampilkan pesan berhasil ubah data
        header('location: ../../main.php?module=kategori&pesan=2');
      }
    }
  }
}
