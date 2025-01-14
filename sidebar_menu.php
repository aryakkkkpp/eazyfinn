<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // pengecekan hak akses untuk menampilkan menu sesuai dengan hak akses
  // jika hak akses = Admin, tampilkan menu
  if ($_SESSION['hak_akses'] == 'Admin') {
    // pengecekan menu aktif
    // jika menu dashboard dipilih, menu dashboard aktif
    if ($_GET['module'] == 'dashboard') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu dashboard tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu pemasukan (tampil data / tampil detail / form entri / form ubah) dipilih, menu pemasukan aktif
    if ($_GET['module'] == 'pemasukan' || $_GET['module'] == 'tampil_detail_pemasukan' || $_GET['module'] == 'form_entri_pemasukan' || $_GET['module'] == 'form_ubah_pemasukan') { ?>
      <div class="sidebar-heading">Transaksi</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=pemasukan">
          <i class="fas fa-fw fa-sign-in-alt"></i>
          <span>Pemasukan</span>
        </a>
      </li>
    <?php
    }
    // jika tidak dipilih, menu pemasukan tidak aktif
    else { ?>
      <div class="sidebar-heading">Transaksi</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=pemasukan">
          <i class="fas fa-fw fa-sign-in-alt"></i>
          <span>Pemasukan</span>
        </a>
      </li>
    <?php
    }

    // jika menu pengeluaran (tampil data / tampil detail / form entri / form ubah) dipilih, menu pengeluaran aktif
    if ($_GET['module'] == 'pengeluaran' || $_GET['module'] == 'form_entri_pengeluaran' || $_GET['module'] == 'form_ubah_pengeluaran') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=pengeluaran">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Pengeluaran</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu pengeluaran tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=pengeluaran">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Pengeluaran</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu kategori (tampil data / form entri / form ubah) dipilih, menu kategori aktif
    if ($_GET['module'] == 'kategori' || $_GET['module'] == 'form_entri_kategori' || $_GET['module'] == 'form_ubah_kategori') { ?>
      <div class="sidebar-heading">Referensi</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=kategori">
          <i class="fas fa-fw fa-clone"></i>
          <span>Kategori</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu kategori tidak aktif
    else { ?>
      <div class="sidebar-heading">Referensi</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=kategori">
          <i class="fas fa-fw fa-clone"></i>
          <span>Kategori</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu laporan pemasukan dipilih, menu laporan pemasukan aktif
    if ($_GET['module'] == 'laporan_pemasukan') { ?>
      <div class="sidebar-heading">Laporan</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=laporan_pemasukan">
          <i class="fas fa-fw fa-file-import"></i>
          <span>Laporan Pemasukan</span>
        </a>
      </li>
    <?php
    }
    // jika tidak dipilih, menu laporan pemasukan tidak aktif
    else { ?>
      <div class="sidebar-heading">Laporan</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=laporan_pemasukan">
          <i class="fas fa-fw fa-file-import"></i>
          <span>Laporan Pemasukan</span>
        </a>
      </li>
    <?php
    }

    // jika menu laporan pengeluaran dipilih, menu laporan pengeluaran aktif
    if ($_GET['module'] == 'laporan_pengeluaran') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=laporan_pengeluaran">
          <i class="fas fa-fw fa-file-export"></i>
          <span>Laporan Pengeluaran</span>
        </a>
      </li>
    <?php
    }
    // jika tidak dipilih, menu laporan pengeluaran tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=laporan_pengeluaran">
          <i class="fas fa-fw fa-file-export"></i>
          <span>Laporan Pengeluaran</span>
        </a>
      </li>
    <?php
    }

    // jika menu laporan rekapitulasi dipilih, menu laporan rekapitulasi aktif
    if ($_GET['module'] == 'laporan_rekapitulasi') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=laporan_rekapitulasi">
          <i class="fas fa-fw fa-file-invoice"></i>
          <span>Laporan Rekapitulasi</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu laporan rekapitulasi tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=laporan_rekapitulasi">
          <i class="fas fa-fw fa-file-invoice"></i>
          <span>Laporan Rekapitulasi</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu manajemen user (tampil data / form entri / form ubah) dipilih, menu manajemen user aktif
    if ($_GET['module'] == 'user' || $_GET['module'] == 'form_entri_user' || $_GET['module'] == 'form_ubah_user') { ?>
      <div class="sidebar-heading">Pengaturan</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=user">
          <i class="fas fa-fw fa-user"></i>
          <span>Manajemen User</span>
        </a>
      </li>
    <?php
    }
    // jika tidak dipilih, menu manajemen user tidak aktif
    else { ?>
      <div class="sidebar-heading">Pengaturan</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=user">
          <i class="fas fa-fw fa-user"></i>
          <span>Manajemen User</span>
        </a>
      </li>
    <?php
    }
  }
  // jika hak akses = User, tampilkan menu
  elseif ($_SESSION['hak_akses'] == 'User') {
    // pengecekan menu aktif
    // jika menu dashboard dipilih, menu dashboard aktif
    if ($_GET['module'] == 'dashboard') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu dashboard tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu pemasukan (tampil data / tampil detail / form entri / form ubah) dipilih, menu pemasukan aktif
    if ($_GET['module'] == 'pemasukan' || $_GET['module'] == 'tampil_detail_pemasukan' || $_GET['module'] == 'form_entri_pemasukan' || $_GET['module'] == 'form_ubah_pemasukan') { ?>
      <div class="sidebar-heading">Transaksi</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=pemasukan">
          <i class="fas fa-fw fa-sign-in-alt"></i>
          <span>Pemasukan</span>
        </a>
      </li>
    <?php
    }
    // jika tidak dipilih, menu pemasukan tidak aktif
    else { ?>
      <div class="sidebar-heading">Transaksi</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=pemasukan">
          <i class="fas fa-fw fa-sign-in-alt"></i>
          <span>Pemasukan</span>
        </a>
      </li>
    <?php
    }

    // jika menu pengeluaran (tampil data / tampil detail / form entri / form ubah) dipilih, menu pengeluaran aktif
    if ($_GET['module'] == 'pengeluaran' || $_GET['module'] == 'form_entri_pengeluaran' || $_GET['module'] == 'form_ubah_pengeluaran') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=pengeluaran">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Pengeluaran</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu pengeluaran tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=pengeluaran">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Pengeluaran</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu kategori (tampil data / form entri / form ubah) dipilih, menu kategori aktif
    if ($_GET['module'] == 'kategori' || $_GET['module'] == 'form_entri_kategori' || $_GET['module'] == 'form_ubah_kategori') { ?>
      <div class="sidebar-heading">Referensi</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=kategori">
          <i class="fas fa-fw fa-clone"></i>
          <span>Kategori</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu kategori tidak aktif
    else { ?>
      <div class="sidebar-heading">Referensi</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=kategori">
          <i class="fas fa-fw fa-clone"></i>
          <span>Kategori</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu laporan pemasukan dipilih, menu laporan pemasukan aktif
    if ($_GET['module'] == 'laporan_pemasukan') { ?>
      <div class="sidebar-heading">Laporan</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=laporan_pemasukan">
          <i class="fas fa-fw fa-file-import"></i>
          <span>Laporan Pemasukan</span>
        </a>
      </li>
    <?php
    }
    // jika tidak dipilih, menu laporan pemasukan tidak aktif
    else { ?>
      <div class="sidebar-heading">Laporan</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=laporan_pemasukan">
          <i class="fas fa-fw fa-file-import"></i>
          <span>Laporan Pemasukan</span>
        </a>
      </li>
    <?php
    }

    // jika menu laporan pengeluaran dipilih, menu laporan pengeluaran aktif
    if ($_GET['module'] == 'laporan_pengeluaran') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=laporan_pengeluaran">
          <i class="fas fa-fw fa-file-export"></i>
          <span>Laporan Pengeluaran</span>
        </a>
      </li>
    <?php
    }
    // jika tidak dipilih, menu laporan pengeluaran tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=laporan_pengeluaran">
          <i class="fas fa-fw fa-file-export"></i>
          <span>Laporan Pengeluaran</span>
        </a>
      </li>
    <?php
    }

    // jika menu laporan rekapitulasi dipilih, menu laporan rekapitulasi aktif
    if ($_GET['module'] == 'laporan_rekapitulasi') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=laporan_rekapitulasi">
          <i class="fas fa-fw fa-file-invoice"></i>
          <span>Laporan Rekapitulasi</span>
        </a>
      </li>
    <?php
    }
    // jika tidak dipilih, menu laporan rekapitulasi tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=laporan_rekapitulasi">
          <i class="fas fa-fw fa-file-invoice"></i>
          <span>Laporan Rekapitulasi</span>
        </a>
      </li>
<?php
    }
  }
}
?>