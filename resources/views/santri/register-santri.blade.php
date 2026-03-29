<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pusat Tahfidz Al-Qur'an Universitas Brawijaya</title>

  <link href="{{ asset('assets/img/Logo-PTQ.png') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

<header id="header" class="d-flex align-items-center">
  <div class="w-100 d-flex align-items-center justify-content-center">

    <a href="/" class="logo">
      <img src="{{ asset('assets/img/Logo-PTQ.png') }}" class="img-fluid">
    </a>

    <h1 class="logo me-5">
      <a href="/">Pusat Tahfidz Al-Qur'an<br>Universitas Brawijaya</a>
    </h1>

    <nav id="navbar" class="navbar">
      <div class="mx-5">
        <ul>
          <li><a class="nav-link scrollto active" href="/">Beranda</a></li>
          <li><a class="nav-link scrollto" href="/program-tahfidz">Program Tahfidz</a></li>
          <li><a class="nav-link scrollto" href="/publikasi">Publikasi</a></li>
          <li><a class="nav-link scrollto" href="/pengumuman">Pengumuman</a></li>
        </ul>
      </div>
    </nav>

  </div>
</header>

<section class="mt-5 d-flex align-items-center">
  <div class="container w-75 px-5">

    <p><a class="text-black" href="/">Beranda</a> / Register Santri</p>

    <div class="section-title text-center">
      <h2>Registrasi Santri</h2>
      <h3>Silahkan lengkapi form registrasi di bawah ini.</h3>
    </div>

    {{-- ALERT ERROR --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('santri.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Nomor Handphone (WhatsApp)</label>
        <input type="text" name="no_hp" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Kata Sandi</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Konfirmasi Kata Sandi</label>
        <input type="password" name="password_confirmation" class="form-control" required>
      </div>

      <div class="row mb-3">
        <div class="col">
          <label class="form-label">Fakultas</label>
          <select name="fakultas" class="form-select" required>
            <option disabled selected>Pilih Fakultas</option>
            <option>FILKOM</option>
            <option>FT</option>
            <option>FEB</option>
            <option>FIA</option>
            <option>FP</option>
          </select>
        </div>

        <div class="col">
          <label class="form-label">Jurusan</label>
          <select name="jurusan" class="form-select" required>
            <option disabled selected>Pilih Jurusan</option>
            <option>Teknik Informatika</option>
            <option>Sistem Informasi</option>
            <option>Manajemen</option>
            <option>Akuntansi</option>
          </select>
        </div>
      </div>

      <div class="mb-4">
        <input type="checkbox" required>
        <label>Saya menyatakan setuju dengan kebijakan privasi</label>
      </div>

      <div class="mb-3">
        <button type="submit" class="btn btn-register w-100">Register</button>
      </div>

      <div class="text-center">
        <p>Sudah memiliki akun? <a href="/login">Login</a></p>
      </div>

    </form>

  </div>
</section>

<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>