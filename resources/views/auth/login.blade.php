<x-guest-layout>
    <section id="login" class="mt-5 pb-0">
        <div class="container">

            <p><a class="text-black" href={{ route('home') }}>Beranda</a> / <a href={{ route('login.create') }}>Login</a>
            </p>

            <div class="section-title text-center">
                <h2>Selamat Datang</h2>
                <h3>Silahkan isi form dibawah untuk melanjutkan.</h3>
            </div>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <x-input-label for="inputEmail" :value="__('Email')" />
                    <x-text-input id="inputEmail" class="form-control" type="email" name="email" :value="old('email')"
                        required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <x-input-label for="inputPassword" :value="__('Kata Sandi')" />
                    <x-text-input id="inputPassword" class="form-control" type="password" name="password" required
                        suffixIcon="togglePassword1" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
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
                    <button class="btn" type="submit" href="index.html">Login</button>
                </div>

            </form>
            <div class="text-center">
                <div class="inline">
                    <p>Belum memiliki akun? <a data-bs-toggle="modal" data-bs-target="#modalRegister"
                            class="cursor-pointer">Register</a></p>
                </div>
            </div>

        </div>
    </section>
</x-guest-layout>
