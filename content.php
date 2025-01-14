<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "config/database.php";

  // pemanggilan file halaman konten sesuai "module" yang dipilih
  // jika module yang dipilih "dashboard"
  if ($_GET['module'] == 'dashboard') {
    // panggil file tampil data dashboard
    include "modules/dashboard/tampil_data.php";
  }
  // jika module yang dipilih "pemasukan"
  elseif ($_GET['module'] == 'pemasukan') {
    // panggil file tampil data pemasukan
    include "modules/pemasukan/tampil_data.php";
  }
  // jika module yang dipilih "tampil_detail_pemasukan"
  elseif ($_GET['module'] == 'tampil_detail_pemasukan') {
    // panggil file tampil detail pemasukan
    include "modules/pemasukan/tampil_detail.php";
  }
  // jika module yang dipilih "form_entri_pemasukan"
  elseif ($_GET['module'] == 'form_entri_pemasukan') {
    // panggil file form entri pemasukan
    include "modules/pemasukan/form_entri.php";
  }
  // jika module yang dipilih "form_ubah_pemasukan"
  elseif ($_GET['module'] == 'form_ubah_pemasukan') {
    // panggil file form ubah pemasukan
    include "modules/pemasukan/form_ubah.php";
  }
  // jika module yang dipilih "pengeluaran"
  elseif ($_GET['module'] == 'pengeluaran') {
    // panggil file tampil data pengeluaran
    include "modules/pengeluaran/tampil_data.php";
  }
  // jika module yang dipilih "tampil_detail_pengeluaran"
  elseif ($_GET['module'] == 'tampil_detail_pengeluaran') {
    // panggil file tampil detail pengeluaran
    include "modules/pengeluaran/tampil_detail.php";
  }
  // jika module yang dipilih "form_entri_pengeluaran"
  elseif ($_GET['module'] == 'form_entri_pengeluaran') {
    // panggil file form entri pengeluaran
    include "modules/pengeluaran/form_entri.php";
  }
  // jika module yang dipilih "form_ubah_pengeluaran"
  elseif ($_GET['module'] == 'form_ubah_pengeluaran') {
    // panggil file form ubah pengeluaran
    include "modules/pengeluaran/form_ubah.php";
  }
  // jika module yang dipilih "kategori"
  elseif ($_GET['module'] == 'kategori') {
    // panggil file tampil data kategori
    include "modules/kategori/tampil_data.php";
  }
  // jika module yang dipilih "form_entri_kategori"
  elseif ($_GET['module'] == 'form_entri_kategori') {
    // panggil file form entri kategori
    include "modules/kategori/form_entri.php";
  }
  // jika module yang dipilih "form_ubah_kategori"
  elseif ($_GET['module'] == 'form_ubah_kategori') {
    // panggil file form ubah kategori
    include "modules/kategori/form_ubah.php";
  }
  // jika module yang dipilih "laporan_pemasukan"
  elseif ($_GET['module'] == 'laporan_pemasukan') {
    // panggil file tampil data laporan pemasukan
    include "modules/laporan-pemasukan/tampil_data.php";
  }
  // jika module yang dipilih "laporan_pengeluaran"
  elseif ($_GET['module'] == 'laporan_pengeluaran') {
    // panggil file tampil data laporan pengeluaran
    include "modules/laporan-pengeluaran/tampil_data.php";
  }
  // jika module yang dipilih "laporan_rekapitulasi"
  elseif ($_GET['module'] == 'laporan_rekapitulasi') {
    // panggil file tampil data laporan rekapitulasi
    include "modules/laporan-rekapitulasi/tampil_data.php";
  }
  // jika module yang dipilih "user" dan hak akses = Admin
  elseif ($_GET['module'] == 'user' && $_SESSION['hak_akses'] == 'Admin') {
    // panggil file tampil data user
    include "modules/user/tampil_data.php";
  }
  // jika module yang dipilih "form_entri_user" dan hak akses = Admin
  elseif ($_GET['module'] == 'form_entri_user' && $_SESSION['hak_akses'] == 'Admin') {
    // panggil file form entri user
    include "modules/user/form_entri.php";
  }
  // jika module yang dipilih "form_ubah_user" dan hak akses = Admin
  elseif ($_GET['module'] == 'form_ubah_user' && $_SESSION['hak_akses'] == 'Admin') {
    // panggil file form ubah user
    include "modules/user/form_ubah.php";
  }
  // jika module yang dipilih "form_ubah_password"
  elseif ($_GET['module'] == 'form_ubah_password') {
    // panggil file form ubah password
    include "modules/password/form_ubah.php";
  }
}
