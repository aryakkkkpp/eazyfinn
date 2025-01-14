<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // mengecek data GET "id_kategori"
  if (isset($_GET['id'])) {
    // ambil data GET dari tombol ubah
    $id_kategori = $_GET['id'];

    // sql statement untuk menampilkan data dari tabel "tbl_kategori" berdasarkan "id_kategori"
    $query = mysqli_query($mysqli, "SELECT * FROM tbl_kategori WHERE id_kategori='$id_kategori'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
  }
?>
  <div class="container-fluid">
    <!-- judul halaman -->
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-clone fa-fw mr-2"></i>Kategori</h1>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <!-- judul form -->
        <h6 class="m-0 font-weight-bold">Ubah Data Kategori</h6>
      </div>
      <div class="card-body">
        <!-- form ubah data -->
        <form action="modules/kategori/proses_ubah.php" method="post" class="needs-validation" novalidate>
          <input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori']; ?>">

          <div class="form-group">
            <label>Nama Kategori <span class="text-danger">*</span></label>
            <input type="text" name="nama_kategori" class="form-control col-lg-5" autocomplete="off" value="<?php echo $data['nama_kategori']; ?>" required>
            <div class="invalid-feedback">Nama kategori tidak boleh kosong.</div>
          </div>

          <div class="form-group">
            <label>Tipe <span class="text-danger">*</span></label>
            <select name="tipe" class="form-control col-lg-5" autocomplete="off" required>
              <option value="<?php echo $data['tipe']; ?>"><?php echo $data['tipe']; ?></option>
              <option disabled value="">-- Pilih --</option>
              <option value="Pemasukan">Pemasukan</option>
              <option value="Pengeluaran">Pengeluaran</option>
            </select>
            <div class="invalid-feedback">Tipe tidak boleh kosong.</div>
          </div>

          <hr class="mt-5">

          <div class="form-group pt-3">
            <!-- tombol simpan data -->
            <input type="submit" name="simpan" value="Simpan" class="btn btn-success pl-4 pr-4 mr-2">
            <!-- tombol kembali ke halaman tampil data -->
            <a href="?module=kategori" class="btn btn-secondary pl-4 pr-4">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>