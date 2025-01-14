<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // mengecek data GET "id_transaksi"
  if (isset($_GET['id'])) {
    // ambil data GET dari tombol ubah
    $id_transaksi = $_GET['id'];

    // sql statement untuk menampilkan data dari tabel "tbl_transaksi" berdasarkan "id_transaksi"
    $query = mysqli_query($mysqli, "SELECT a.id_transaksi, a.tanggal, a.kategori, a.deskripsi, a.pengeluaran, a.bukti_transaksi, b.nama_kategori 
                                    FROM tbl_transaksi as a INNER JOIN tbl_kategori as b ON a.kategori=b.id_kategori 
                                    WHERE a.id_transaksi='$id_transaksi'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
  }
?>
  <div class="container-fluid">
    <!-- judul halaman -->
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-sign-out-alt fa-fw mr-2"></i>Pengeluaran</h1>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <!-- judul form -->
        <h6 class="m-0 font-weight-bold">Ubah Data Pengeluaran</h6>
      </div>
      <div class="card-body">
        <!-- form ubah data -->
        <form action="modules/pengeluaran/proses_ubah.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
          <input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">

          <div class="form-group col-lg-6 pl-0">
            <label>Tanggal <span class="text-danger">*</span></label>
            <input type="text" name="tanggal" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" value="<?php echo date('d-m-Y', strtotime($data['tanggal'])); ?>" required>
            <div class="invalid-feedback">Tanggal tidak boleh kosong.</div>
          </div>

          <div class="form-group col-lg-6 pl-0">
            <label>Kategori Pengeluaran <span class="text-danger">*</span></label>
            <select name="kategori" class="form-control chosen-select" autocomplete="off" required>
              <option value="<?php echo $data['kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
              <option disabled value="">-- Pilih --</option>
              <?php
              // sql statement untuk menampilkan data dari tabel "tbl_kategori" berdasarkan tipe "pengeluaran"
              $query_kategori = mysqli_query($mysqli, "SELECT id_kategori, nama_kategori FROM tbl_kategori WHERE tipe='pengeluaran'")
                                                      or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
              // ambil data hasil query
              while ($data_kategori = mysqli_fetch_assoc($query_kategori)) {
                // tampilkan data
                echo "<option value='$data_kategori[id_kategori]'>$data_kategori[nama_kategori]</option>";
              }
              ?>
            </select>
            <div class="invalid-feedback">Kategori pengeluaran tidak boleh kosong.</div>
          </div>

          <div class="form-group col-lg-6 pl-0">
            <label>Deskripsi Transaksi <span class="text-danger">*</span></label>
            <textarea name="deskripsi" rows="3" class="form-control" autocomplete="off" required><?php echo $data['deskripsi']; ?></textarea>
            <div class="invalid-feedback">Deskripsi transaksi tidak boleh kosong.</div>
          </div>

          <div class="form-group col-lg-6 pl-0">
            <label>Jumlah <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
              <input type="text" name="jumlah" class="form-control mask-money" autocomplete="off" value="<?php echo number_format($data['pengeluaran'], 0, '', '.'); ?>" required>
              <div class="invalid-feedback">Jumlah pengeluaran tidak boleh kosong.</div>
            </div>
          </div>

          <div class="form-group col-lg-6 pt-3 pl-0">
            <label>Bukti Transaksi</label>
            <input type="file" accept=".jpg, .jpeg, .png" id="bukti_transaksi" name="bukti_transaksi" class="form-control form-control-file" autocomplete="off">
            <div class="col-lg-6 border rounded my-4">
              <?php
              // mengecek data "bukti_transaksi"
              // jika data "bukti_transaksi" tidak ada di database
              if (is_null($data['bukti_transaksi'])) { ?>
                <!-- tampilkan file default -->
                <img id="preview-file" src="images/no_image.png" class="col foto-preview py-3" alt="Bukti Transaksi">
              <?php
              }
              // jika data "bukti_transaksi" ada di database
              else { ?>
                <!-- tampilkan file "bukti_transaksi" dari database -->
                <img id="preview-file" src="images/pengeluaran/<?php echo $data['bukti_transaksi']; ?>" class="col foto-preview py-3" alt="Bukti Transaksi">
              <?php } ?>
            </div>
            <small class="form-text text-secondary">
              Keterangan : <br>
              - Tipe file yang bisa diunggah adalah *.jpg atau *.png. <br>
              - Ukuran file yang bisa diunggah maksimal 1 Mb.
            </small>
          </div>

          <hr class="mt-5">

          <div class="form-group pt-3">
            <!-- tombol simpan data -->
            <input type="submit" name="simpan" value="Simpan" class="btn btn-success pl-4 pr-4 mr-2">
            <!-- tombol kembali ke halaman tampil data -->
            <a href="?module=pengeluaran" class="btn btn-secondary pl-4 pr-4">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    // validasi file dan preview file sebelum diunggah
    document.getElementById('bukti_transaksi').onchange = function() {
      // mengambil value dari file
      var fileInput = document.getElementById('bukti_transaksi');
      var filePath = fileInput.value;
      var fileSize = fileInput.files[0].size;
      // tentukan extension file yang diperbolehkan
      var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

      // Jika tipe file yang diunggah tidak sesuai dengan "allowedExtensions"
      if (!allowedExtensions.exec(filePath)) {
        alert("Tipe file tidak sesuai. Harap unggah file yang memiliki tipe *.jpg atau *.png.");
        // reset input file
        fileInput.value = "";
        // tampilkan file default
        document.getElementById("preview-file").src = "images/no_image.png";
      }
      // jika ukuran file yang diunggah lebih dari 1 Mb
      else if (fileSize > 1000000) {
        alert("Ukuran file lebih dari 1 Mb. Harap unggah file yang memiliki ukuran maksimal 1 Mb.");
        // reset input file
        fileInput.value = "";
        // tampilkan file default
        document.getElementById("preview-file").src = "images/no_image.png";
      }
      // jika file yang diunggah sudah sesuai, tampilkan preview file
      else {
        var reader = new FileReader();

        reader.onload = function(e) {
          // preview file
          document.getElementById("preview-file").src = e.target.result;
        };
        // membaca file sebagai data URL
        reader.readAsDataURL(this.files[0]);
      }
    };
  </script>
<?php } ?>