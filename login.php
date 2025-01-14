<!-- Aplikasi Manajemen Kas Berbasis Web
********************************************
* Developer   : Code Null
* Company     : Code Null
* Release     : Juni 2021
* Update      : -
* Website     : Code Null
* E-mail      : hi.codenull@gamil.com
* WhatsApp    : -
-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Aplikasi Manajemen Kas Berbasis Web">
  <meta name="author" content="Code Null">

  <!-- Title -->
  <title>Aplikasi Manajemen Kas Berbasis Web</title>

  <!-- Favicon icon -->
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="assets/css/login.css" rel="stylesheet">
</head>

<body class="bg-gradient-success">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <!-- logo -->
                  <div class="text-center pb-3">
                    <img src="assets/img/logo.jpg" alt="Logo" class="logo" style="width: 100px; height: auto" >
                    <!-- <i class="fab fa-modx fa-44x text-success"></i> -->
                  </div>
                  <!-- judul -->
                  <div class="text-center pb-3">
                    <h1 class="h5 text-gray-900 mb-4"> EAZYFIN </h1>
                    <h2 class="h5 text-gray-900 mb-4"> Easy Cash Management </h2>
                  </div>

                  <?php
                  // menampilkan pesan sesuai dengan proses yang dijalankan
                  // jika pesan tersedia
                  if (isset($_GET['pesan'])) {
                    // jika pesan = 1
                    if ($_GET['pesan'] == 1) {
                      // tampilkan pesan gagal login
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <small>
                                <strong><i class="fas fa-times-circle mr-1"></i> Gagal Login!</strong> <br>
                                Username atau Password salah. Cek kembali Username dan Password Anda.
                              </small>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                    }
                    // jika pesan = 2
                    elseif ($_GET['pesan'] == 2) {
                      // tampilkan pesan peringatan login
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <small>
                                <strong><i class="fas fa-exclamation-triangle mr-1"></i> Peringatan!</strong> <br>
                                Anda harus login terlebih dahulu.
                              </small>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                    }
                    // jika pesan = 3
                    elseif ($_GET['pesan'] == 3) {
                      // tampilkan pesan sukses logout
                      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                              <small>
                                <strong><i class="fas fa-check-circle mr-1"></i> Sukses!</strong> <br>
                                Anda telah berhasil logout.
                              </small>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                    }
                  }
                  ?>

                  <!-- form login -->
                  <form action="proses_login.php" method="post" class="user needs-validation" novalidate>
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" placeholder="Username" autocomplete="off" required>
                      <div class="invalid-feedback">Username tidak boleh kosong.</div>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" placeholder="Password" autocomplete="off" required>
                      <div class="invalid-feedback">Password tidak boleh kosong.</div>
                    </div>
                    <div class="form-group pt-3">
                      <!-- tombol login -->
                      <input type="submit" name="login" value="LOGIN" class="btn btn-success btn-user btn-block">
                    </div>
                  </form>

                  <!-- footer -->
                  <div class="text-center mt-5">
                    <small>Copyright &copy; 2025</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/js/form-validation.js"></script>

</body>

</html>