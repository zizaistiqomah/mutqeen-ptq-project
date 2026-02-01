<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pusat Tahfidz Al-Qur'an Universitas Brawijaya</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="{{ asset('assets/img/logo_ukm.png') }}" rel="icon">

  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

  <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

  <header id="header" class="d-flex align-items-center">
    <div class="w-100 d-flex align-items-center justify-content-center">

          <a href="index.html" class="logo"><img src="assets/img/logo_ukm.png" alt="" class="img-fluid"></a>
          <h1 class="logo me-5"><a href="index.html">UKM Tahfidz Qur'an<br>Universitas Airlangga</a></h1>

        <nav id="navbar" class="navbar">
          <div class="mx-5">
            <ul>
              <li><a class="nav-link scrollto active" href="/">Beranda</a></li>
              <li><a class="nav-link scrollto" href="/program-tahfidz">Program Tahfidz</a></li>
              <li><a class="nav-link scrollto" href="/publikasi">Publikasi</a></li>
              <li><a class="nav-link scrollto" href="#pengumuman">Pengumuman</a></li>
            </ul>
          </div>
          <div class="ms-5">
            <ul>
              <li><a class="register scrollto" href="/register">Register</a></li>
              <li><button class="login" data-bs-toggle="modal" data-bs-target="#modalLogin">Login</button></li>
            </ul>
          </div>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
  </header>

  <!-- ======= Login Modal ======= -->
  <div class="modal fade" id="modalLogin" tabindex="-1">
    <div class="modal modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">

            <div class="text-center">
              <h2>Login ke UKM Tahfidz</h2>
              <h3>Saya ingin masuk sebagai:</h3>
            </div>

              <a href="login.html">
                <div class="card mb-2">
                  <div class="row">
                    <div class="col-3">
                      <img src="assets/img/santri.png" alt="...">
                    </div>
                    <div class="col-9 my-auto">
                      <div class="card-body">
                        <h3 class="card-title">Santri Penghafal</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              <a href="login.html">
                <div class="card mb-2">
                  <div class="row">
                    <div class="col-3">
                      <img src="assets/img/admin.png" alt="...">
                    </div>
                    <div class="col-9 my-auto">
                      <div class="card-body">
                        <h3 class="card-title">Admin UKM Tahfidz</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              <a href="login.html">
                <div class="card mb-2">
                  <div class="row">
                    <div class="col-3">
                      <img src="assets/img/panitia.png" alt="...">
                    </div>
                    <div class="col-9 my-auto">
                      <div class="card-body">
                        <h3 class="card-title">Panitia UKM Tahfidz</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              <a href="login.html">
                <div class="card mb-2">
                  <div class="row">
                    <div class="col-3">
                      <img src="assets/img/penguji.png" alt="...">
                    </div>
                    <div class="col-9 my-auto">
                      <div class="card-body">
                        <h3 class="card-title">Penguji UKM Tahfidz</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </a>

          </div>
        </div>
      </div>
    </div>
  </div><!-- End Modal -->

  <section id="login" class="mt-5 pb-0">
    <div class="container w-75 px-5">

      <p><a class="text-black" href="index.html">Beranda</a> / <a href="">Login</a></p>

      <div class="section-title text-center">
        <h2>Selamat Datang</h2>
        <h3>Silahkan isi form dibawah untuk melanjutkan.</h3>
      </div>

      <div class="mb-3">
        <label for="inputEmail" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail">
      </div>
      <div class="mb-2">
        <label for="inputPassword" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" id="inputPassword">
      </div>
      <div class="mb-4">
        <div class="row">
          <div class="col">
            <input type="checkbox" class="form-check-input" id="ingatSaya">
            <label for="ingatSaya" class="form-label">Ingat Saya?</label>
          </div>
          <div class="col text-end">
            <a href="index.html">Lupa Sandi?</a>
          </div>
        </div>
      </div>

      <div class="mb-2 pb-4 border-bottom">
        <a class="btn" href="index.html">Login</a>
      </div>
      <div class="text-center">
        <div class="inline">
          <p>Belum memiliki akun? <a href="/register">Register</a></p>
        </div>
      </div>

    </div>
  </section>

    <!-- Vendor JS Files -->
    <script src="{{asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("assets/vendor/glightbox/js/glightbox.min.js")}}"></script>
    <script src="{{asset("assets/vendor/isotope-layout/isotope.pkgd.min.js")}}"></script>
    <script src="{{asset("assets/vendor/swiper/swiper-bundle.min.js")}}"></script>
    <script src="{{asset("assets/vendor/php-email-form/validate.js")}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset("assets/js/main.js")}}"></script>

</body>

</html>
