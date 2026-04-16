<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Login - PTQ UB</title>

  <link href="{{ asset('assets/img/Logo-PTQ.png') }}" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

<section class="mt-5 d-flex align-items-center">
  <div class="container w-50 px-5">

    <div class="section-title text-center">
      <h2>Login Penyimak</h2>
      <h3>Silahkan masuk ke akun Anda</h3>
    </div>

    {{-- ERROR --}}
    @if(session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <button class="btn btn-register w-100">Login</button>
      </div>

      <div class="text-center">
        <p>Belum punya akun? <a href="/penyimak/register">Daftar</a></p>
      </div>

    </form>

  </div>
</section>

<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>