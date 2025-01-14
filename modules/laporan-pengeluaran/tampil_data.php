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
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-file-export fa-fw mr-2"></i>Laporan Pengeluaran</h1>

    <?php
    // mengecek data hasil submit dari form
    // jika tidak ada data yang dikirim (tombol tampilkan belum diklik)
    if (!isset($_POST['tampil'])) { ?>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <!-- judul form -->
          <h6 class="m-0 font-weight-bold">Filter Data Pengeluaran</h6>
        </div>
        <div class="card-body">
          <!-- form filter data -->
          <form action="?module=laporan_pengeluaran" method="post" class="needs-validation" novalidate>
            <div class="row">
              <div class="col-lg-2">
                <div class="form-group">
                  <label>Tanggal Awal <span class="text-danger">*</span></label>
                  <input type="text" name="tanggal_awal" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" required>
                  <div class="invalid-feedback">Tanggal awal tidak boleh kosong.</div>
                </div>
              </div>

              <div class="col-lg-2">
                <div class="form-group">
                  <label>Tanggal Akhir <span class="text-danger">*</span></label>
                  <input type="text" name="tanggal_akhir" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" required>
                  <div class="invalid-feedback">Tanggal akhir tidak boleh kosong.</div>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label>Kategori <span class="text-danger">*</span></label>
                  <select name="kategori" class="form-control chosen-select" autocomplete="off" required>
                    <option value="Semua">-- Semua --</option>
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
                  <div class="invalid-feedback">Kategori tidak boleh kosong.</div>
                </div>
              </div>

              <div class="col-lg-2">
                <div class="form-group pt-2">
                  <!-- tombol tampil data -->
                  <input type="submit" name="tampil" value="Tampilkan" class="btn btn-success btn-block mt-4">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    <?php
    }
    // jika ada data yang dikirim (tombol tampilkan diklik)
    else {
      // ambil data hasil submit dari form filter
      $tgl_awal  = $_POST['tanggal_awal'];
      $tgl_akhir = $_POST['tanggal_akhir'];

      // ubah format tanggal menjadi Tahun-Bulan-Hari (Y-m-d)
      $tanggal_awal  = date('Y-m-d', strtotime($tgl_awal));
      $tanggal_akhir = date('Y-m-d', strtotime($tgl_akhir));

      if ($_POST['kategori'] == 'Semua') {
        $id_kategori   = 'Semua';
        $nama_kategori = '-- Semua --';
      } else {
        // sql statement untuk menampilkan data dari tabel "tbl_kategori" berdasarkan "id_kategori"
        $query = mysqli_query($mysqli, "SELECT id_kategori, nama_kategori FROM tbl_kategori WHERE id_kategori='$_POST[kategori]'")
                                        or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
        // ambil data hasil query
        $data  = mysqli_fetch_assoc($query);
        // buat variabel untuk menampilkan data
        $id_kategori   = $data['id_kategori'];
        $nama_kategori = $data['nama_kategori'];
      }
    ?>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <!-- judul form -->
          <h6 class="m-0 font-weight-bold">Filter Data Pengeluaran</h6>
        </div>
        <div class="card-body">
          <!-- form filter data -->
          <form action="?module=laporan_pengeluaran" method="post" class="needs-validation" novalidate>
            <div class="row">
              <div class="col-lg-2">
                <div class="form-group">
                  <label>Tanggal Awal <span class="text-danger">*</span></label>
                  <input type="text" name="tanggal_awal" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" value="<?php echo $tgl_awal; ?>" required>
                  <div class="invalid-feedback">Tanggal awal tidak boleh kosong.</div>
                </div>
              </div>

              <div class="col-lg-2">
                <div class="form-group">
                  <label>Tanggal Akhir <span class="text-danger">*</span></label>
                  <input type="text" name="tanggal_akhir" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" value="<?php echo $tgl_akhir; ?>" required>
                  <div class="invalid-feedback">Tanggal akhir tidak boleh kosong.</div>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label>Kategori <span class="text-danger">*</span></label>
                  <select name="kategori" class="form-control chosen-select" autocomplete="off" required>
                    <option value="<?php echo $id_kategori; ?>"><?php echo $nama_kategori; ?></option>
                    <option value="Semua">-- Semua --</option>
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
                  <div class="invalid-feedback">Kategori tidak boleh kosong.</div>
                </div>
              </div>

              <div class="col-lg-2">
                <div class="form-group pt-2">
                  <!-- tombol tampil data -->
                  <input type="submit" name="tampil" value="Tampilkan" class="btn btn-success btn-block mt-4">
                </div>
              </div>

              <div class="col-lg-2">
                <div class="form-group pt-2">
                  <!-- tombol cetak laporan -->
                  <a href="modules/laporan-pengeluaran/cetak.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>&kategori=<?php echo $id_kategori; ?>" target="_blank" class="btn btn-warning btn-block mt-4 mr-3">
                    <span class="icon"><i class="fas fa-print mr-2"></i></span>
                    <span class="text">Cetak</span>
                  </a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <?php
      // mengecek kategori pengeluaran yang akan ditampilkan
      // jika filter data kategori pengeluaran "Semua" yang dipilih
      if ($_POST['kategori'] == 'Semua') { ?>
        <!-- tampilkan laporan pengeluaran per periode dengan semua kategori -->
        <div class="card shadow mb-4">
          <div class="card-body">
            <!-- judul laporan -->
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
              <i class="fas fa-file-alt mr-2"></i> Laporan Pengeluaran Tanggal <strong><?php echo $tgl_awal; ?></strong> s.d. <strong><?php echo $tgl_akhir; ?></strong>
            </div>

            <div class="table-responsive">
              <!-- tabel untuk menampilkan data dari database -->
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Kategori Pengeluaran</th>
                    <th class="text-center">Deskripsi Transaksi</th>
                    <th class="text-center">Jumlah</th>
                  </tr>
                </thead>
                <tbody class="pre-scrollable">
                  <?php
                  // variabel untuk nomor urut tabel 
                  $no = 1;
                  // variabel untuk total pengeluaran
                  $total_pengeluaran = 0;

                  // sql statement untuk menampilkan data pengeluaran dari tabel "tbl_transaksi" dan tabel "tbl_kategori" berdasarkan "tanggal"
                  $query = mysqli_query($mysqli, "SELECT a.tanggal, a.kategori, a.deskripsi, a.pengeluaran, b.nama_kategori 
                                                  FROM tbl_transaksi as a INNER JOIN tbl_kategori as b ON a.kategori=b.id_kategori
                                                  WHERE a.pengeluaran!='NULL' AND a.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                                                  ORDER BY a.tanggal ASC, a.id_transaksi ASC")
                                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
                  // ambil data hasil query
                  while ($data = mysqli_fetch_assoc($query)) { ?>
                    <!-- tampilkan data -->
                    <tr>
                      <td width="30" class="text-center"><?php echo $no++; ?></td>
                      <td width="100" class="text-center"><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                      <td width="150"><?php echo $data['nama_kategori']; ?></td>
                      <td width="250"><?php echo $data['deskripsi']; ?></td>
                      <td width="120" class="text-right">Rp. <?php echo number_format($data['pengeluaran'], 0, '', '.'); ?></td>
                    </tr>
                  <?php
                    // jumlahkan "pengeluaran" untuk mendapatkan "total_pengeluaran"
                    $total_pengeluaran += $data['pengeluaran'];
                  }
                  ?>
                  <!-- tampilkan data total -->
                  <tr>
                    <td class="text-center font-weight-bold" colspan="4">Total Pengeluaran</td>
                    <td class="text-right font-weight-bold">Rp. <?php echo number_format($total_pengeluaran, 0, '', '.'); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php
      }
      // jika filter data kategori pengeluaran selain "Semua" yang dipilih
      elseif ($_POST['kategori'] != 'Semua') { ?>
        <!-- tampilkan laporan pengeluaran per periode dan per kategori -->
        <div class="card shadow mb-4">
          <div class="card-body">
            <!-- judul laporan -->
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
              <i class="fas fa-file-alt mr-2"></i> Laporan Pengeluaran <strong><?php echo $nama_kategori; ?></strong> Tanggal <strong><?php echo $tgl_awal; ?></strong> s.d. <strong><?php echo $tgl_akhir; ?></strong>
            </div>

            <div class="table-responsive">
              <!-- tabel untuk menampilkan data dari database -->
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Deskripsi Transaksi</th>
                    <th class="text-center">Jumlah</th>
                  </tr>
                </thead>
                <tbody class="pre-scrollable">
                  <?php
                  // variabel untuk nomor urut tabel 
                  $no = 1;
                  // variabel untuk total pengeluaran
                  $total_pengeluaran = 0;

                  // sql statement untuk menampilkan data pengeluaran dari tabel "tbl_transaksi" berdasarkan "kategori" dan "tanggal"
                  $query = mysqli_query($mysqli, "SELECT tanggal, deskripsi, pengeluaran FROM tbl_transaksi
                                                  WHERE pengeluaran!='NULL' AND kategori='$id_kategori' AND tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                                                  ORDER BY tanggal ASC, id_transaksi ASC")
                                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
                  // ambil data hasil query
                  while ($data = mysqli_fetch_assoc($query)) { ?>
                    <!-- tampilkan data -->
                    <tr>
                      <td width="30" class="text-center"><?php echo $no++; ?></td>
                      <td width="100" class="text-center"><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                      <td width="250"><?php echo $data['deskripsi']; ?></td>
                      <td width="120" class="text-right">Rp. <?php echo number_format($data['pengeluaran'], 0, '', '.'); ?></td>
                    </tr>
                  <?php
                    // jumlahkan "pengeluaran" untuk mendapatkan "total_pengeluaran"
                    $total_pengeluaran += $data['pengeluaran'];
                  }
                  ?>
                  <!-- tampilkan data total -->
                  <tr>
                    <td class="text-center font-weight-bold" colspan="3">Total Pengeluaran</td>
                    <td class="text-right font-weight-bold">Rp. <?php echo number_format($total_pengeluaran, 0, '', '.'); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    <?php
      }
    }
    ?>
  </div>
<?php } ?>