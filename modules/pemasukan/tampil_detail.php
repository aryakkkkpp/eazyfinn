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
    $query = mysqli_query($mysqli, "SELECT a.id_transaksi, a.tanggal, a.kategori, a.deskripsi, a.pemasukan, a.bukti_transaksi, b.nama_kategori 
                                    FROM tbl_transaksi as a INNER JOIN tbl_kategori as b ON a.kategori=b.id_kategori 
                                    WHERE a.id_transaksi='$id_transaksi'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
  }
?>
  <div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <!-- judul halaman -->
      <h1 class="h4 mb-sm-0 text-gray-800"><i class="fas fa-sign-in-alt fa-fw mr-2"></i>Pemasukan</h1>
      <!-- tombol kembali ke halaman tampil data -->
      <a href="?module=pemasukan" class="btn btn-success btn-icon-split">
        <span class="icon"><i class="fas fa-arrow-alt-circle-left"></i></span>
        <span class="text">Kembali</span>
      </a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <!-- judul form -->
        <h6 class="m-0 font-weight-bold">Detail Data Pemasukan</h6>
      </div>
      <div class="card-body">
        <table class="table">
          <tr>
            <td class="table-detail-border-top" width="180">Tanggal</td>
            <td class="table-detail-border-top" width="10">:</td>
            <td class="table-detail-border-top"><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
          </tr>
          <tr>
            <td>Kategori Pemasukan</td>
            <td>:</td>
            <td><?php echo $data['nama_kategori']; ?></td>
          </tr>
          <tr>
            <td>Deskripsi Transaksi</td>
            <td>:</td>
            <td><?php echo $data['deskripsi']; ?></td>
          </tr>
          <tr>
            <td class="table-detail-border-bottom">Jumlah</td>
            <td class="table-detail-border-bottom">:</td>
            <td class="table-detail-border-bottom">Rp. <?php echo number_format($data['pemasukan'], 0, '', '.'); ?></td>
          </tr>
        </table>
        <table class="table">
          <tr>
            <td class="table-detail-border-top" width="180">Bukti Transaksi</td>
            <td class="table-detail-border-top" width="10">:</td>
            <td class="table-detail-border-top">
              <div class="col-lg-7 pl-0">
                <?php
                // mengecek data "bukti_transaksi"
                // jika data "bukti_transaksi" tidak ada di database
                if (is_null($data['bukti_transaksi'])) { ?>
                  <!-- tampilkan file default -->
                  <img src="images/no_image.png" class="col-lg-6 py-3 border rounded" alt="Bukti Transaksi">
                <?php
                }
                // jika data "bukti_transaksi" ada di database
                else { ?>
                  <!-- tampilkan file "bukti_transaksi" dari database -->
                  <img src="images/pemasukan/<?php echo $data['bukti_transaksi']; ?>" class="col-lg-6 py-3 border rounded" alt="Bukti Transaksi">
                <?php } ?>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
<?php } ?>