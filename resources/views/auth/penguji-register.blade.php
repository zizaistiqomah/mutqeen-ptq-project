<x-guest-layout>
    <section id="login" class="mt-5 d-flex align-items-center">
        <div class="container">
            <p><a class="text-black" href={{ route('home') }}>Beranda</a> / <a
                    href={{ route('santri.store') }}>Register</a>
            </p>

            <div class="section-title text-center">
                <h2>Registrasi Penguji Sekarang</h2>
                <h3>Silahkan lengkapi form registrasi di bawah ini.</h3>
            </div>

            <form method="POST" action="{{ route('penguji.store') }}">
                @csrf

                <!-- Nama lengkap -->
                <div class="mb-3">
                    <x-input-label for="inputNim" :value="__('Nama Lengkap')" />
                    <x-text-input id="inputNim" class="form-control" type="text" name="name" :value="old('name')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>


                <!-- Nomor Handphone -->
                <div class="mb-3">
                    <x-input-label for="inputNomorHp" :value="__('Nomor Handphone (WhatsApp)')" />
                    <x-text-input id="inputNomorHp" class="form-control" type="text" name="phone" :value="old('nomor_hp')"
                        required />
                    <x-input-error :messages="$errors->get('nomor_hp')" class="mt-2" />
                </div>

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

                <!-- Confirm Password -->
                <div class="mb-3">
                    <x-input-label for="inputConfirmPass" :value="__('Konfirmasi Kata Sandi')" />
                    <x-text-input id="inputConfirmPass" class="form-control" type="password"
                        name="password_confirmation" required suffixIcon="togglePassword2" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>


                <div class="mb-4">
                    <input type="checkbox" class="form-check-input" id="privacyPolicy">
                    <label for="privacyPolicy" class="form-label">Saya menyatakan memahami dan setuju dengan <a
                            href="index.html">Kebijakan Privasi registrasi akun Santri UKM Tahfidz Universitas
                            Airlangga</a></label>
                </div>

                <div class="mb-2 pb-4 border-bottom">
                    <button type="submit" class="btn">Register</button>
                </div>
                <div class="text-center">
                    <div class="inline">
                        <p>Sudah memiliki akun? <a href={{ route('login.create') }}>Login</a></p>
                    </div>
                </div>
            </form>
        </div>
    </section>



</x-guest-layout>
