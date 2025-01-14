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
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-fw fa-lock mr-2"></i>Password</h1>

    <?php
    // menampilkan pesan sesuai dengan proses yang dijalankan
    // jika pesan tersedia
    if (isset($_GET['pesan'])) {
      // jika pesan = 1
      if ($_GET['pesan'] == 1) {
        // tampilkan pesan gagal ubah data
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-times-circle mr-1"></i> Gagal!</strong> Password Lama yang Anda masukan salah.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      // jika pesan = 2
      elseif ($_GET['pesan'] == 2) {
        // tampilkan pesan gagal ubah data
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-times-circle mr-1"></i> Gagal!</strong> Password Baru dan Konfirmasi Password Baru tidak cocok.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      // jika pesan = 3
      elseif ($_GET['pesan'] == 3) {
        // tampilkan pesan sukses ubah data
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check-circle mr-1"></i> Sukses!</strong> Password berhasil diubah.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
    }
    ?>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <!-- judul form -->
        <h6 class="m-0 font-weight-bold">Ubah Password</h6>
      </div>
      <div class="card-body">
        <!-- form ubah data -->
        <form action="modules/password/proses_ubah.php" method="post" class="needs-validation" novalidate>
          <div class="form-group">
            <label>Password Lama <span class="text-danger">*</span></label>
            <input type="password" name="password_lama" class="form-control col-lg-5" autocomplete="off" required>
            <div class="invalid-feedback">Password lama tidak boleh kosong.</div>
          </div>

          <div class="form-group">
            <label>Password Baru <span class="text-danger">*</span></label>
            <input type="password" name="password_baru" class="form-control col-lg-5" autocomplete="off" required>
            <div class="invalid-feedback">Password baru tidak boleh kosong.</div>
          </div>

          <div class="form-group">
            <label>Konfirmasi Password Baru <span class="text-danger">*</span></label>
            <input type="password" name="konfirmasi_password" class="form-control col-lg-5" autocomplete="off" required>
            <div class="invalid-feedback">Konfirmasi password baru tidak boleh kosong.</div>
          </div>

          <hr class="mt-5">

          <div class="form-group pt-3">
            <!-- tombol simpan data -->
            <input type="submit" name="simpan" value="Simpan" class="btn btn-success pl-4 pr-4 mr-2">
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>