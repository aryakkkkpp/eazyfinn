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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <!-- judul halaman -->
      <h1 class="h4 mb-sm-0 text-gray-800"><i class="fas fa-sign-in-alt fa-fw mr-2"></i>Pemasukan</h1>
      <!-- tombol entri data -->
      <a href="?module=form_entri_pemasukan" class="btn btn-success btn-icon-split">
        <span class="icon"><i class="fas fa-plus-circle"></i></span>
        <span class="text">Entri Data</span>
      </a>
    </div>

    <?php
    // menampilkan pesan sesuai dengan proses yang dijalankan
    // jika pesan tersedia
    if (isset($_GET['pesan'])) {
      // jika pesan = 1
      if ($_GET['pesan'] == 1) {
        // tampilkan pesan sukses simpan data
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check-circle mr-1"></i> Sukses!</strong> Data pemasukan berhasil disimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      // jika pesan = 2
      elseif ($_GET['pesan'] == 2) {
        // tampilkan pesan sukses ubah data
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check-circle mr-1"></i> Sukses!</strong> Data pemasukan berhasil diubah.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      // jika pesan = 3
      elseif ($_GET['pesan'] == 3) {
        // tampilkan pesan sukses hapus data
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check-circle mr-1"></i> Sukses!</strong> Data pemasukan berhasil dihapus.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
    }
    ?>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <!-- judul tabel -->
        <h6 class="m-0 font-weight-bold">Data Pemasukan</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <!-- tabel untuk menampilkan data dari database -->
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Kategori Pemasukan</th>
                <th class="text-center">Deskripsi Transaksi</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // variabel untuk nomor urut tabel
              $no = 1;
              // sql statement untuk menampilkan data pemasukan dari tabel "tbl_transaksi" dan tabel "tbl_kategori"
              $query = mysqli_query($mysqli, "SELECT a.id_transaksi, a.tanggal, a.kategori, a.deskripsi, a.pemasukan, b.nama_kategori 
                                              FROM tbl_transaksi as a INNER JOIN tbl_kategori as b ON a.kategori=b.id_kategori 
                                              WHERE a.pemasukan!='NULL' ORDER BY a.tanggal DESC, a.id_transaksi DESC")
                                              or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
              // ambil data hasil query
              while ($data = mysqli_fetch_assoc($query)) { ?>
                <!-- tampilkan data -->
                <tr>
                  <td width="30" class="text-center"><?php echo $no++; ?></td>
                  <td width="80" class="text-center"><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                  <td width="170"><?php echo $data['nama_kategori']; ?></td>
                  <td width="250"><?php echo $data['deskripsi']; ?></td>
                  <td width="120" class="text-right">Rp. <?php echo number_format($data['pemasukan'], 0, '', '.'); ?></td>
                  <td width="100" class="text-center">
                    <div>
                      <!-- tombol detail data -->
                      <a href="?module=tampil_detail_pemasukan&id=<?php echo $data['id_transaksi']; ?>" class="btn btn-info btn-circle btn-sm mr-md-1" data-toggle="tooltip" data-placement="top" title="Detail">
                        <i class="fas fa-clone"></i>
                      </a>
                      <!-- tombol ubah data -->
                      <a href="?module=form_ubah_pemasukan&id=<?php echo $data['id_transaksi']; ?>" class="btn btn-success btn-circle btn-sm mr-md-1" data-toggle="tooltip" data-placement="top" title="Ubah">
                        <i class="fas fa-edit"></i>
                      </a>
                      <!-- tombol hapus data -->
                      <a href="modules/pemasukan/proses_hapus.php?id=<?php echo $data['id_transaksi']; ?>" onclick="return confirm('Anda yakin ingin menghapus data pemasukan <?php echo $data['nama_kategori']; ?> tanggal <?php echo date('d-m-Y', strtotime($data['tanggal'])); ?> ?')" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
                        <i class="fas fa-trash"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php } ?>