<x-app-layout>
    @php
        $items = range(1, 30);
    @endphp

    <div class="mt-32 flex flex-col gap-6 max-w-6xl mx-auto w-full">

        <div class="flex items-center gap-2 font-medium">
            <a href="{{ route('home') }}" class="m-0 cursor-pointer text-gray-900 hover:text-gray-800">Beranda</a>
            <span>/</span>
            <a href="{{ route('profile.index') }}" class="m-0 cursor-pointer text-gray-900 hover:text-gray-800">Profile
                Saya</a>
            <span>/</span> <span class="text-primary-app font-semibold m-0">Ubah Profile</span>
        </div>

        <div class="shadow-md rounded-md flex items-center justify-center gap-6 py-16 border">

            <div class="relative w-40 h-40">
                <label for="fileInput"
                    class="cursor-pointer w-full h-full rounded-full overflow-hidden border-2 border-gray-300 bg-white">
                    <img id="profileImage" src="/assets/img/santri.png" alt="Profile Picture"
                        class="w-full h-full object-cover">
                </label>

                <label for="fileInput"
                    class="absolute bottom-2 right-2 bg-primary-app rounded-full w-10 h-10 flex items-center justify-center cursor-pointer">
                    <i class="fa-solid fa-camera text-white"></i>
                </label>
                <input type="file" id="fileInput" accept="image/*" class="hidden" onchange="previewImage(event)">

                <button id="resetBtn" class="bg-red-600 text-white px-4 py-2 rounded ml-10"
                    onclick="resetImage()">Batal</button>
            </div>


            <div class="flex flex-col gap-3">
                <div class="text-2xl font-bold">
                    {{ $user->name }}
                </div>

                <div class="text-xl font-medium capitalize">
                    {{ $user->role->name }}
                </div>
            </div>


        </div>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <div class="text-xl font-bold">Data Diri</div>

                    <div class="border shadow-md p-4 rounded mt-4 flex flex-col gap-6">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div>
                                    <p class="text-sm mt-2 text-gray-800">
                                        {{ __('Your email address is unverified.') }}

                                        <button form="send-verification"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div>
                            <x-input-label for="phone" :value="__('Nomor Handphone')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                                :value="old('name', $user->phone)" required autofocus autocomplete="phone" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div>
                            <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                            <div class="mt-1 flex items-center">
                                <input id="male" name="jenis_kelamin" type="radio" value="1" class="mr-2"
                                    {{ old('jenis_kelamin', $user->jenis_kelamin) == '1' ? 'checked' : '' }} />
                                <label for="male" class="mr-4">{{ __('Laki-Laki') }}</label>

                                <input id="female" name="jenis_kelamin" type="radio" value="0" class="mr-2"
                                    {{ old('jenis_kelamin', $user->jenis_kelamin) == '0' ? 'checked' : '' }} />
                                <label for="female">{{ __('Perempuan') }}</label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
                        </div>

                        <div>
                            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                            <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date"
                                class="mt-1 block w-full" :value="old('tanggal_lahir', $user->tanggal_lahir)" />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
                        </div>
                    </div>



                    <div class="flex items-center gap-4 mt-6">
                        <x-primary-button class="!bg-primary-app !px-4">{{ __('Simpan') }}</x-primary-button>

                        <a href={{ route('profile.index') }}><button type="button"
                                class="border-[2px] py-1 px-4 font-bold text-primary-app rounded !border-primary-app">Batal</button></a>

                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </div>

                @if ($user->role_id == config('constants.ROLE_SANTRI'))
                    <div>
                        <div>
                            <div class="text-xl font-bold">Data Institusi</div>

                            <div class="border shadow-md p-4 rounded mt-4">
                                <div class="flex flex-col gap-6">

                                    <div>
                                        <x-input-label for="inputFakultas" :value="__('Fakultas')" />
                                        <select class="form-select" id="inputFakultas" name="fakultas" required>
                                            <option selected disabled>Pilih Fakultas</option>
                                            @foreach ($faculties as $f)
                                                <option value="{{ $f->id }}"
                                                    {{ old('fakultas', $user->santri->major->faculty->id) == $f->id ? 'selected' : '' }}>
                                                    {{ $f->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('fakultas')" class="mt-2" />

                                    </div>

                                    <div class="col">
                                        <x-input-label for="inputJurusan" :value="__('Jurusan')" />
                                        <select class="form-select" id="inputJurusan" name="major_id" required>
                                            <option selected disabled>Pilih Jurusan</option>
                                            @foreach ($majors as $m)
                                                <option value="{{ $m->id }}"
                                                    {{ old('fakultas', $user->santri->major->id) == $m->id ? 'selected' : '' }}
                                                    data-faculty="{{ $m->faculty_id }}">
                                                    {{ $m->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="nim" :value="__('NIM')" />
                                        <x-text-input id="nim" name="nim" type="text"
                                            class="mt-1 block w-full" :value="old('name', $user->santri->nim)" required autofocus
                                            autocomplete="nim" />
                                        <x-input-error class="mt-2" :messages="$errors->get('nim')" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <div class="text-xl font-bold">Data Hafalan</div>

                            <div class="border shadow-md p-4 rounded mt-4">
                                <div class="flex flex-col gap-6">


                                    <div>
                                        <x-input-label for="jumlah_hafalan" :value="__('Jumlah Hafalan')" />
                                        <x-text-input id="jumlah_hafalan" name="jumlah_hafalan" type="number"
                                            class="mt-1 block w-full" :value="old('name', $user->santri->jumlah_hafalan)" required
                                            autocomplete="jumlah_hafalan" />
                                        <x-input-error class="mt-2" :messages="$errors->get('jumlah_hafalan')" />
                                    </div>

                                    <div>
                                        <x-input-label for="informasi_hafalan" :value="__('Informasi Hafalan')" />
                                        <select id="informasi_hafalan" name="informasi_hafalan[]"
                                            class="mt-1 block w-full" multiple>
                                            @foreach ($items as $item)
                                                <option value="{{ $item }}"
                                                    {{ $user->santri->informasi_hafalan && in_array($item, $user->santri->informasi_hafalan) ? 'selected' : '' }}>
                                                    {{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('jumlah_hafalan')" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif


        </form>


    </div>

    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                    toggleResetButton(true);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function resetImage() {
            document.getElementById('profileImage').src = '/assets/img/santri.png';
            document.getElementById('fileInput').value = '';
            toggleResetButton(false);
        }

        function toggleResetButton(show) {
            const resetButton = document.getElementById('resetBtn');
            if (show) {
                resetButton.classList.remove('hidden');
            } else {
                resetButton.classList.add('hidden');
            }
        }

        window.onload = function() {
            const profileImage = document.getElementById('profileImage');
            toggleResetButton(false);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const element = document.getElementById('informasi_hafalan');
            const choices = new Choices(element, {
                searchEnabled: true,
                placeholderValue: 'Select options',
                removeItemButton: true,
                duplicateItemsAllowed: false,
                itemSelectText: '',
            });
        });
    </script>


</x-app-layout>
