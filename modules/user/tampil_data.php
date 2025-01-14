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
      <h1 class="h4 mb-sm-0 text-gray-800"><i class="fas fa-user fa-fw mr-2"></i>Manajemen User</h1>
      <!-- tombol entri data -->
      <a href="?module=form_entri_user" class="btn btn-success btn-icon-split">
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
                <strong><i class="fas fa-check-circle mr-1"></i> Sukses!</strong> Data user berhasil disimpan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      // jika pesan = 2
      elseif ($_GET['pesan'] == 2) {
        // tampilkan pesan sukses ubah data
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check-circle mr-1"></i> Sukses!</strong> Data user berhasil diubah.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      // jika pesan = 3
      elseif ($_GET['pesan'] == 3) {
        // tampilkan pesan sukses hapus data
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check-circle mr-1"></i> Sukses!</strong> Data user berhasil dihapus.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
      // jika pesan = 4
      elseif ($_GET['pesan'] == 4) {
        // ambil data GET dari proses simpan/ubah
        $username = $_GET['username'];
        // tampilkan pesan gagal simpan data
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-times-circle mr-1"></i> Gagal!</strong> Username <strong>' . $username . '</strong> sudah ada. Silahkan ganti username yang Anda masukan.
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
        <h6 class="m-0 font-weight-bold">Data User</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <!-- tabel untuk menampilkan data dari database -->
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama User</th>
                <th class="text-center">Username</th>
                <th class="text-center">Hak Akses</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // variabel untuk nomor urut tabel
              $no = 1;
              // sql statement untuk menampilkan data dari tabel "tbl_user"
              $query = mysqli_query($mysqli, "SELECT id_user, nama_user, username, hak_akses FROM tbl_user ORDER BY id_user DESC")
                                              or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
              // ambil data hasil query
              while ($data = mysqli_fetch_assoc($query)) { ?>
                <!-- tampilkan data -->
                <tr>
                  <td width="30" class="text-center"><?php echo $no++; ?></td>
                  <td width="180"><?php echo $data['nama_user']; ?></td>
                  <td width="180"><?php echo $data['username']; ?></td>
                  <td width="100"><?php echo $data['hak_akses']; ?></td>
                  <td width="70" class="text-center">
                    <div>
                      <!-- tombol ubah data -->
                      <a href="?module=form_ubah_user&id=<?php echo $data['id_user']; ?>" class="btn btn-success btn-circle btn-sm mr-md-1" data-toggle="tooltip" data-placement="top" title="Ubah">
                        <i class="fas fa-edit"></i>
                      </a>
                      <!-- tombol hapus data -->
                      <a href="modules/user/proses_hapus.php?id=<?php echo $data['id_user']; ?>" onclick="return confirm('Anda yakin ingin menghapus data user dengan username <?php echo $data['username']; ?>?')" class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
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