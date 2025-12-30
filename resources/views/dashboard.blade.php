<x-app-layout>
    <section id="dashboard" class="mt-5 pb-0">
        <div class="container">

            <p><a class="text-black" href="index.html">Beranda</a> / <a href="">Hafalan Saya</a></p>

            <div class="welcome mb-5">
                <div class="row">
                    <div class="col-3">
                        <img src="assets/img/welcome.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-9 my-auto">
                        <div class="section-title pb-0">
                            <h2>Selamat Datang di Hafalan Anda</h2>
                            <h3>Halaman ini merupakan halaman hafalan Anda yang digunakan untuk memantau kegiatan
                                hafal dan progress Anda</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <div class="section-title pb-0">
                        <h2 id="dashboardTitle">Setoran</h2>
                    </div>
                </div>
                <div class="col-1">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-dashboard" type="button" id="dropdownMenu"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-caret-down-fill"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu"
                            style="--bs-dropdown-link-active-bg: none">
                            <li><button class="dropdown-item text-black" onclick="dashboardSetoran()">Setoran</button>
                            </li>
                            <li><button class="dropdown-item text-black" onclick="dashboardUjian()">Ujian</button>
                            </li>
                            <li><button class="dropdown-item text-black" onclick="dashboardAbsen()">Absen</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-9">
                    <div class="float-end w-50">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Cari Data">
                        </div>
                    </div>
                </div>
            </div>

            <table id="tableSetoran" style="display: table;" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Tgl Setoran</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Surat</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Jumlah Setoran</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Nilai</th>
                        <th class="text-center" style="background: #CCCF95; width: 30%;">Catatan</th>
                        <th class="text-center" style="background: #CCCF95; width: 10%;">Status</th>
                        <th class="text-center" style="background: #CCCF95; width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DummySetoran</td>
                        <td>DummySetoran</td>
                        <td>DummySetoran</td>
                        <td>DummySetoran</td>
                        <td>DummySetoran</td>
                        <td>Tabel Setoran</td>
                        <td class="text-center"><button class="btn btn-sm" type="button"><i
                                    class="bi bi-journal-text"></i></button></td>
                    </tr>
                </tbody>
            </table>

            <table id="tableUjian" style="display: none;" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Tgl Ujian</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Surat</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Jumlah Hafalan</th>
                        <th class="text-center" style="background: #CCCF95; width: 15%;">Nilai</th>
                        <th class="text-center" style="background: #CCCF95; width: 30%;">Catatan</th>
                        <th class="text-center" style="background: #CCCF95; width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DummyUjian</td>
                        <td>DummyUjian</td>
                        <td>DummyUjian</td>
                        <td>DummyUjian</td>
                        <td>DummyUjian</td>
                        <td class="text-center"><button class="btn btn-sm" type="button"><i
                                    class="bi bi-journal-text"></i></button></td>
                    </tr>
                </tbody>
            </table>

            <div id="tableAbsen" style="display: none;">Under Maintenance</div>

        </div>
    </section>

    <!-- ======= Footer Section ======= -->
    <section id="footer" class="footer pb-0">
        <div class="container">

            <div class="row">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.7571317010115!2d112.78204018368717!3d-7.268455448569584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa21117097cf%3A0x42c29739e70df5ca!2sMasjid%20Ulul%20&#39;Azmi!5e0!3m2!1sen!2sid!4v1713600038357!5m2!1sen!2sid"
                            frameborder="0" style="border:0; width: 100%; height: 320px;" allowfullscreen></iframe>
                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <div class="info">
                        <div class="d-flex align-items-center mb-5">
                            <img src="assets/img/logo_ukm.png" alt="" class="img-fluid">
                            <h4>UKM Tahfidz Qur'an<br>Universitas Airlangga</h4>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p class="mb-4">MENU</p>
                                <a class="d-block mb-3 scrollto" href="#profil">Profil</a>
                                <a class="d-block mb-3 scrollto" href="#departemen">Departemen</a>
                                <a class="d-block mb-3 scrollto" href="#berita">Berita</a>
                                <a class="d-block mb-3 scrollto" href="#pengumuman">Pengumuman</a>
                            </div>
                            <div class="col-5">
                                <p class="mb-4">HUBUNGI KAMI</p>
                                <div class="mb-3">
                                    <div class="d-inline-block align-top">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div class="d-inline-block" style="width: 90%;">
                                        <a href="mailto:tahfidzukmunair@mail.com">tahfidzukmunair@mail.com</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-inline-block align-top">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div class="d-inline-block" style="width: 90%;">
                                        <a href="">+62 666655544433</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-inline-block align-top">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <div class="d-inline-block" style="width: 90%;">
                                        <a href="">Jl. Dr. Ir. H. Soekarno, Mulyorejo, Kec. Mulyorejo,
                                            Surabaya,
                                            Jawa
                                            Timur 60115</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <p class="mb-4">IKUTI KAMI</p>
                                <div class="mb-3">
                                    <div class="d-inline-block align-top">
                                        <i class="bi bi-instagram"></i>
                                    </div>
                                    <div class="d-inline-block" style="width: 80%;">
                                        <a href="">Instagram</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-inline-block align-top">
                                        <i class="bi bi-youtube"></i>
                                    </div>
                                    <div class="d-inline-block" style="width: 80%;">
                                        <a href="">YouTube</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="copyright">
                <div class="row">
                    <div class="col">
                        <img src="assets/img/logo_ukm.png" class="img-fluid" alt="">
                        <img src="assets/img/logo_PENS.png" class="img-fluid" alt="">
                        <p>Powered by Satriyo Yoga Pradana</p>
                    </div>
                    <div class="col text-end">
                        <p>Hak Cipta &#169;2024 Satriyo</p>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Footer Section -->

    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
</x-app-layout>
