<x-app-layout>
<section id="login" class="mt-5 pb-0">
  <div class="container w-75 px-5">

    <p>
      <a class="text-black" href="{{ url('/') }}">Beranda</a> / 
      <a href="#">Login Santri</a>
    </p>

    <div class="section-title text-center">
      <h2>Selamat Datang</h2>
      <h3>Silahkan isi form dibawah untuk melanjutkan.</h3>
    </div>

    <!-- FORM LOGIN -->
    <form method="POST" action="{{ route('login.process') }}">
      @csrf

      <!-- hidden role -->
      <input type="hidden" name="role" value="santri">

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-2">
        <label class="form-label">Kata Sandi</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-4">
        <div class="row">
          <div class="col">
            <input type="checkbox" class="form-check-input" name="remember">
            <label class="form-label">Ingat Saya?</label>
          </div>
          <div class="col text-end">
            <a href="#">Lupa Sandi?</a>
          </div>
        </div>
      </div>

      <div class="mb-2 pb-4 border-bottom">
        <button type="submit" class="btn btn-primary w-100">
          Login
        </button>
      </div>
    </form>

    <div class="text-center">
      <p>Belum memiliki akun? <a href="{{ route('register') }}">Register</a></p>
    </div>

  </div>
</section>
</x-app-layout>