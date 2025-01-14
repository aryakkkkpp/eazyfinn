<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // mengecek data GET "id_user"
  if (isset($_GET['id'])) {
    // ambil data GET dari tombol ubah
    $id_user = $_GET['id'];

    // sql statement untuk menampilkan data dari tabel "tbl_user" berdasarkan "id_user"
    $query = mysqli_query($mysqli, "SELECT id_user, nama_user, username, hak_akses FROM tbl_user WHERE id_user='$id_user'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
  }
?>
  <div class="container-fluid">
    <!-- judul halaman -->
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-user fa-fw mr-2"></i>Manajemen User</h1>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <!-- judul form -->
        <h6 class="m-0 font-weight-bold">Ubah Data User</h6>
      </div>
      <div class="card-body">
        <!-- form ubah data -->
        <form action="modules/user/proses_ubah.php" method="post" class="needs-validation" novalidate>
          <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">

          <div class="form-group">
            <label>Nama User <span class="text-danger">*</span></label>
            <input type="text" name="nama_user" class="form-control col-lg-5" autocomplete="off" value="<?php echo $data['nama_user']; ?>" required>
            <div class="invalid-feedback">Nama user tidak boleh kosong.</div>
          </div>

          <div class="form-group">
            <label>Username <span class="text-danger">*</span></label>
            <input type="text" name="username" class="form-control col-lg-5" autocomplete="off" value="<?php echo $data['username']; ?>" required>
            <div class="invalid-feedback">Username tidak boleh kosong.</div>
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control col-lg-5" placeholder="Kosongkan password jika tidak diubah" autocomplete="off">
            <div class="invalid-feedback">Password tidak boleh kosong.</div>
          </div>

          <div class="form-group">
            <label>Hak Akses <span class="text-danger">*</span></label>
            <select name="hak_akses" class="form-control col-lg-5" autocomplete="off" required>
              <option value="<?php echo $data['hak_akses']; ?>"><?php echo $data['hak_akses']; ?></option>
              <option disabled value="">-- Pilih --</option>
              <option value="Admin">Admin</option>
              <option value="User">User</option>
            </select>
            <div class="invalid-feedback">Hak akses tidak boleh kosong.</div>
          </div>

          <hr class="mt-5">

          <div class="form-group pt-3">
            <!-- tombol simpan data -->
            <input type="submit" name="simpan" value="Simpan" class="btn btn-success pl-4 pr-4 mr-2">
            <!-- tombol kembali ke halaman tampil data -->
            <a href="?module=user" class="btn btn-secondary pl-4 pr-4">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>