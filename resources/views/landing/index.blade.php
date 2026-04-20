<x-app-layout>
    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="container">
            <div class="row my-5">
                <div class="col-7">
                    <div class="mt-5 pt-5">
                        <h1>Pusat Tahfidz Al-Qur'an<br>Universitas Brawijaya</h1>
                        <h2>Membumikan Al-Qur'an Membangun Peradaban</h2>
                        <a class="btn scrollto" href={{ route('semua-program') }}>Lihat Program</a>
                    </div>
                </div>
                <div class="col-5">
                    <img src="assets/img/hero.png" class="img-fluid my-5" alt="">
                </div>
            </div>

            <div class="text-center">
                <a class="selengkapnya scrollto" href="#profil">Lihat Selengkapnya <i class="bi bi-arrow-down"></i></a>
            </div>

        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Profil Section ======= -->
        <section id="profil" class="profil">
            <div class="container">

                <div class="row">
                    <div class="col">
                        <div class="image-stack">
                            
                            <div class="image-bottom">
                                <img src="assets/img/profile.jpg" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col px-5">

                        <div class="section-title">
                            <h3>Profil</h3>
                            <h2>Pusat Tahfidz Al-Qur'an <br>Universitas Brawijaya</h2>
                        </div>

                        <div class="mb-2">
                            <p>Pusat Tahfidz Al-Qur'an didirikan untuk memfasilitasi dan membimbing para civitas akademika
                                Universitas Brawijaya maupun umum dalam menghafal Al-Qur'an. Pusat Tahfidz Al-Qur'an didirikan
                                dengan harapan dapat menjadi pusat pembinaan karakter yang berlandaskan nilai-nilai Al-Qur'an,
                                mencetak generasi Qur'ani, berakhlak mulia dan bermanfaat bagi umat. 
                            </p>
                        </div>
                        <a class="btn scrollto" href="#visimisi" onclick="showVisi()">Pelajari Lebih Lanjut</a>
                        

                    </div>
                </div>

                <div id="visimisi" style="display: none;">
                    <div class="section-title mt-5 pb-0">
                        <h3>Visi dan Misi</h3>
                        <h2>Pusat Tahfidz Al-Qur'an Universitas Brawijaya</h2>
                    </div>

                    <div class="content mb-4">
                        <div class="section-title pb-0">
                            <h3>Visi</h3>
                        </div>
                        <p>Membangkitkan insan yang hamilul Qur'an lafdzan wa ma'nan melalui spirit, 
                            intelektualitas, spiritualitas, dan moralitas dengan menghidupkan nilai Al-Qur'an dalam sikap, 
                            perilaku, dan berpikir. 
                        </p>
                    </div>
                    <div class="content">
                        <div class="section-title pb-0">
                            <h3>Misi</h3>
                        </div>
                        <p>1. Membangun dan mengembangkan PTQ UB sebagai wadah bagi mahasiswa maupun umum dalam proses menghafal, 
                            memahami, dan memngamalkan Al-Qur'an yang berintegritas, lesatari, dan sejahtera. <br>
                            2. Membangun atmosfer Qur'ani di lingkungan Universitas Brawijaya. Membangun dan mewadahi pusat data 
                            para penghafal Al-Qur'an dari mahasiswa Universitas Brawijaya. <br>
                    </div>
                </div>

            </div>
        </section><!-- End Profil Section -->

        <!-- ======= Departemen Section ======= -->
<section id="publikasi" class="berita">
    <div class="container">
        <div class="row">

            <!-- KIRI (TETAP) -->
            <div class="col-5 my-auto">
                <div class="section-title pb-0">
                    <h3>Departemen</h3>
                    <h2>Pusat Tahfidz <br>Al-Qur'an<br>Universitas Brawijaya</h2>
                </div>
                <div class="pe-5">
                    <p>
                        Berisikan mengenai departemen-departemen yang ada di
                        Pusat Tahfidz Al-Qur'an Universitas Brawijaya
                    </p>
                </div>
                <a class="btn scrollto" href="#">Lihat Semua Departemen</a>
            </div>

            <!-- KANAN (SLIDER) -->
            <div class="col-7">
                <div class="swiper departemen-swiper">
                    <div class="swiper-wrapper">

                        <!-- CARD 1 -->
                        <div class="swiper-slide">
                            <div class="card m-auto" style="width: 90%;">
                                <img src="assets/img/berita.png" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">Departemen Tahfidz</h5>
                                    <p class="card-text">
                                        Departemen inti yang berfokus pada pembinaan dan pengelolaan program hafalan Al-Qur’an bagi mahasiswa melalui kegiatan halaqah, setoran hafalan, dan pendampingan tahfidz.
                                    </p>
                                    <break></break>
                                    <p class="card-title">
                                        Program Kerja:
                                    </p>
                                    <p class="card-text">
                                       • Halaqah tahfidz setoran hafalan 
                                    </p>
                                    <p class="card-text">
                                       • Khotmil Qur'an
                                    </p>
                                    <p class="card-text">
                                       • Tasmi' dan Evaluasi Hafalan
                                    </p>
                                    <p class="card-text">
                                       • Wisuda Tahfidz
                                    </p>
                                    <a href={{route('departemen.tahfidz')}} class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 2 -->
                        <div class="swiper-slide">
                            <div class="card m-auto" style="width: 90%;">
                                <img src="assets/img/berita.png" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">Departemen PSDM</h5>
                                    <p class="card-text">
                                        Berfokus pada pengembangan kualitas anggota melalui pembinaan, pelatihan, dan evaluasi untuk meningkatkan kompetensi, kedisiplinan, dan profesionalisme.
                                    </p>
                                    <break></break>
                                    <p class="card-title">
                                        Program Kerja:
                                    </p>
                                    <p class="card-text">
                                       • Recruitment 
                                    </p>
                                    <p class="card-text">
                                       • Ta'ziz & Mabit
                                    </p>
                                    <p class="card-text">
                                       • Rihlah
                                    </p>
                                    <p class="card-text">
                                       • Studi Banding
                                    </p>
                                    <a href={{route('departemen.psdm')}} class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 3 -->
                        <div class="swiper-slide">
                            <div class="card m-auto" style="width: 90%;">
                                <img src="assets/img/berita.png" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">Departemen Pendidikan</h5>
                                    <p class="card-text">
                                        Berfokus pada pengelolaan dan pelaksanaan kegiatan edukatif untuk meningkatkan wawasan, pengetahuan, dan kualitas keilmuan pengurus dan anggota melalui kajian dan pembinaan.
                                    </p>
                                    <break></break>
                                    <p class="card-title">
                                        Program Kerja:
                                    </p>
                                    <p class="card-text">
                                       • Kelas Tahsin
                                    </p>
                                    <p class="card-text">
                                       • Baca Tulis Al-Qur'an (BTA)
                                    </p>
                                    <p class="card-text">
                                       • Seminar Qurani
                                    </p>
                                    <a href={{route('departemen.pendidikan')}} class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 4 -->
                        <div class="swiper-slide">
                            <div class="card m-auto" style="width: 90%;">
                                <img src="assets/img/berita.png" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">Departemen Humas</h5>
                                    <p class="card-text">
                                        Berperan sebagai penghubung antara organisasi dengan pihak internal maupun eksternal melalui pengelolaan komunikasi, informasi, dan publikasi untuk membangun citra serta menjalin kerja sama yang baik.
                                    </p>
                                    <break></break>
                                    <p class="card-title">
                                        Program Kerja:
                                    </p>
                                    <p class="card-text">
                                       • Pengelolaan Sosial Media 
                                    </p>
                                    <p class="card-text">
                                       • Media Partner & Public Relation
                                    </p>
                                    <p class="card-text">
                                       • Manajemen Informasi Internal 
                                    </p>
                                    <a href={{route('departemen.humas')}} class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- PANAH -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    <!-- DOT -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- === end section === -->

        <!-- ======= Departemen Section ======= -->
        <section id="departemen" class="departemen">
            <div class="container">

                <div class="section-title">
                    <h3>Pusat Tahfidz AL-Qur'an</h3>
                    <h2>Program</h2>
                </div>

                <div class="departemen-slider swiper p-1">
                    <div class="swiper-wrapper align-items-center">
                        <div class="card swiper-slide highlight-card">
                            <div class="card-body">
                                <div class="departemen-title">
                                    <h2>Halaqah Tahfidz</h2>
                                </div>
                                <!-- Dua gambar sejajar -->
                                <div class="row mb-3">
                                    <div class="col-5 text-start">
                                        <img 
                                            src="{{ asset('assets/img/tahfidz.png') }}" 
                                            class="img-fluid"
                                            style="max-width: 170px;"
                                            alt="Logo 1">
                                    </div>
                                </div>
                                <p class="card-text">
                                    Kegiatan harian rutin pembinaan hafalan Al-Qur’an melalui muroja’ah, setoran hafalan, dan tasmi’, dilaksanakan dalam kelompok kecil.
                                </p>
                                <a class="btn" href={{route('semua-program')}}>Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                        
                        <div class="card swiper-slide highlight-card">
                            <div class="card-body">
                                <div class="departemen-title">
                                    <h2>Tahfidz Camp</h2>
                                </div>
                                <!-- Dua gambar sejajar -->
                                <div class="row mb-3">
                                    <div class="col-5 text-start">
                                        <img 
                                            src="{{ asset('assets/img/Tahfidzcamp.png') }}" 
                                            class="img-fluid"
                                            style="max-width: 200px;"
                                            alt="Logo 1">
                                    </div>
                                </div>
                                <p class="card-text">
                                    kegiatan karantina tahfidz selama 7 hari, yang diisi dengan fokus menghafal Al-Qur’an 
                                    disertai kegiatan kajian dan hiburan untuk menjaga semangat peserta.
                                </p>
                                <a class="btn" href={{route('semua-program')}}>Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                        <div class="card swiper-slide highlight-card">
                            <div class="card-body">
                                <div class="departemen-title">
                                    <h2>Wisuda Tahfidz</h2>
                                </div>
                                <!-- Dua gambar sejajar -->
                                <div class="row mb-3">
                                    <div class="col-5 text-start">
                                        <img 
                                            src="{{ asset('assets/img/wisuda.png') }}" 
                                            class="img-fluid"
                                            style="max-width: 200px;"
                                            alt="Logo 1">
                                    </div>
                                </div>
                                <p class="card-text">
                                    Apresiasi dan pengukuhan bagi peserta yang telah mencapai target hafalan Al-Qur’an 
                                    sebagai bentuk penghargaan atas pencapaian dan komitmen dalam program tahfidz.
                                </p>
                                <a class="btn" href={{route('semua-program')}}>Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                        <div class="card swiper-slide highlight-card">
                            <div class="card-body">
                                <div class="departemen-title">
                                    <h2>Studi Banding</h2>
                                </div>
                                <!-- Dua gambar sejajar -->
                                <div class="row mb-3">
                                    <div class="col-5 text-start">
                                        <img 
                                            src="{{ asset('assets/img/studybanding.png') }}" 
                                            class="img-fluid"
                                            style="max-width: 170px;"
                                            alt="Logo 1">
                                    </div>
                                </div>
                                <p class="card-text">
                                    kegiatan kunjungan dan pertukaran wawasan dengan lembaga atau organisasi sejenis 
                                    untuk berbagi pengalaman dan meningkatkan kualitas program.
                                </p>
                                <a class="btn" href={{route('semua-program')}}>Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                        <div class="card swiper-slide highlight-card">
                            <div class="card-body">
                                <div class="departemen-title">
                                    <h2>Rihlah</h2>
                                </div>
                                <!-- Dua gambar sejajar -->
                                <div class="row mb-3">
                                    <div class="col-5 text-start">
                                        <img 
                                            src="{{ asset('assets/img/rihlah.png') }}" 
                                            class="img-fluid"
                                            style="max-width: 170px;"
                                            alt="Logo 1">
                                    </div>
                                </div>
                                <p class="card-text">
                                    kegiatan rekreasi dan kebersamaan yang bertujuan mempererat ukhuwah, menyegarkan semangat, 
                                    serta memperkuat kekompakan antar pengurus dan anggota.
                                </p>
                                <a class="btn" href={{route('semua-program')}}>Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                        <div class="card swiper-slide highlight-card">
                            <div class="card-body">
                                <div class="departemen-title">
                                    <h2>Baca Tulis Al-Qur'an</h2>
                                </div>
                                <!-- Dua gambar sejajar -->
                                <div class="row mb-3">
                                    <div class="col-5 text-start">
                                        <img 
                                            src="{{ asset('assets/img/bta.jpg') }}" 
                                            class="img-fluid"
                                            style="max-width: 200px;"
                                            alt="Logo 1">
                                    </div>
                                </div>
                                <p class="card-text">
                                    Berfokus pada pengelolaan dan pelaksanaan kegiatan edukatif untuk meningkatkan wawasan, pengetahuan, 
                                    dan kualitas keilmuan pengurus dan anggota melalui kajian dan pembinaan.

                                </p>
                                <a class="btn" href={{route('semua-program')}}>Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination pt-4"></div>
                </div>


            </div>
        </section><!-- End Departemen Section -->

        

        <!-- ======= Pengumuman Section ======= -->
        <section id="pengumuman" class="pengumuman">
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="col-7 my-auto">
                            <div class="section-title pb-0">
                                <h3>Pengumuman</h3>
                                <h2>Pusat Tahfidz <br>Al-Qur'an</h2>
                            </div>
                            <div class="pe-5">
                                <p>Berisikan mengenai pengumuman terkait kegiatan kegiatan yang sedang atau akan berlangsung di Pusat Tahfidz Al-Qur-an Universitas Brawijaya yang dapat digunakan sebagai bahan bacaan</p>
                            </div>
                            <a class="btn scrollto" href={{route('pengumuman')}}>Cek Pengumuman</a>
                        </div>
                        <div class="col-5">
                            <img src="assets/img/pengumuman.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Pengumuman Section -->

      

    </main><!-- End #main -->


    <script>
document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".departemen-swiper", {
        slidesPerView: 1,
        spaceBetween: 20,

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        breakpoints: {
            768: {
                slidesPerView: 2,
            }
        }
    });
});
</script>


    <script>
        function showVisi() {
            var element = document.getElementById("visimisi");
            if (element.style.display == "none") {
                element.style.display = "block";
            }
        };
    </script>
</x-app-layout>
