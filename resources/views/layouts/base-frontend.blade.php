
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SIBERTA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.jpeg') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>SIBERTA</h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="#" class="active">Home</a></li>
                    <li><a href="#layanan">LAYANAN</a></li>
                    <li><a href="#tutorial">TUTORIAL</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                    <li><a class="get-a-quote" href="https://unitama.ac.id/">UNITAMA</a></li>
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <!-- End Header -->



    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row gy-4 d-flex justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h2 data-aos="fade-up">SISTEM INFORMASI BERKAS ADMINISTRASI TUGAS AKHIR </h2>
                    <p data-aos="fade-up" data-aos-delay="100">Layanan Pemberkasan Tugas Akhir Universitas Teknologi
                        Akba Makassar</p>

                    <form action="#" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="200">
                        <input type="text" class="form-control" placeholder="Masukkan ID Berkas">
                        <button type="submit" class="btn btn-primary">Lacak</button>
                    </form>

                    <div class="row gy-4" data-aos="fade-up" data-aos-delay="400">

                        <div class="col-lg-5 col-6">
                            <div class="">
                                <p>Atau Buat Pengajuan Baru</p>
                                <button type="submit" class="btn btn-primary">PENGAJUAN BERKAS</button>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-3 col-6">
                            <div class="stats-item text-center w-100 h-100">

                                <p></p>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-3 col-6">
                            <div class="stats-item text-center w-100 h-100">

                                <p></p>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-3 col-6">
                            <div class="stats-item text-center w-100 h-100">

                                <p></p>
                            </div>
                        </div><!-- End Stats Item -->

                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <img src="{{ asset('img/hero-img.png') }}" class="img-fluid mb-3 mb-lg-0" alt="">
                </div>

            </div>
        </div>
    </section><!-- End Hero Section -->


    <!-- ======= About Us Section ======= -->
    <section id="layanan" class="about">
        <div class="container" data-aos="fade-up">
            <div class="col-lg-6 content order-last  order-lg-first">
                <h3>Persyaratan Layanan</h3>
                <p>Pilih layanan di bawah untuk melihat Persyaratan tiap Layanan
                </p>
                <form><select id="id_pelayanan"
                        class="custom-select form-control select
                               t2-hidden-accessible"
                        name="jenis_pelayanan" data-rule-required="true" data-msg-required="Silahkan Pilih Layanan."
                        data-select2-id="data-select2-id_pelayanan" tabindex="-1" aria-hidden="true"> == $0
                        <option velue="6C06A380-EFD7-11EC-9F71-0533DADCF6EF" data-select2-id="select2-data-2-uuv3">
                            "PENGAJUAN BERKAS SEMINAR PROPOSAL"
                        </option>
                        <option velue="995A29BB-4186-4F53-ACDE-0F479239756E"data-select2-id="select-data-2-uuv3">
                            "PENGAJUAN BERKAS SEMINAR HASIL"
                        </option>
                        <option velue="0A44BD04-20F0-45DB-9859-1149CF8D4981"data-select2-id="select-data-5-9kg3">
                            "PENGAJUAN BERKAS TUTUP"
                        </option>

                    </select>
                </form>
                <ul>

            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= About Us Section ======= -->
    <section id="tutorial" class="about">
        <div class="container" data-aos="fade-up">
            <div class="col-lg-6 content order-last  order-lg-first">
                <h3>VIDEO TUTORIAL</h3>
                <h3>SISTEM INFORMASI BERKAS ADMINISTRASI TUGAS AKHIR </h3>
                <p>Nonton video disamping,</p>
                <p>untuk memahami tata cara</p>
                <p>pengajuan menggunakan Aplikasi SIBERTA</p>
                <div class="col-lg-3 col-6">
                    <div class="stats-item text-center w-100 h-100">

                        <p></p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <span>Frequently Asked Questions FOR</span>
                <h2>Frequently Asked Questions FOR</h2>
            </div>
            <div class="section-header">
                <span>SIBERTA</span>
                <h2>SIBERTA</h2>

            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-10">

                    <div class="accordion accordion-flush" id="faqlist">

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-1">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    Apasih sebenarnya SIBERTA?
                                </button>
                            </h3>
                            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    Aplikasi SIBERTA Adalah Singkatan dari Sistem Informasi Berkas Administrasi Tugas
                                    akhir yang mendukung dalam pelayanan bagi mahasiswa semester akhir.
                                </div>
                            </div>
                        </div><!-- # Faq item-->

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-2">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    ?
                                </button>
                            </h3>
                            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    .
                                </div>
                            </div>
                        </div><!-- # Faq item-->

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-3">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    ?
                                </button>
                            </h3>
                            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    .
                                </div>
                            </div><!-- # Faq item-->

                        </div>
                    </div>

                </div>
    </section><!-- End Frequently Asked Questions Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="Kontak" class="footer">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span>SIBERTA</span>
                    </a>
                    <p>Layanan Pemberkasan Tugas Akhir Universitas Teknologi Akba Makassar.</p>
                    <div class="social-links d-flex mt-4">
                        <a href="https://x.com/kampus_unitama" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="https://web.facebook.com/unitama.ac.id/" class="facebook"><i
                                class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/unitama.ac.id/" class="instagram"><i
                                class="bi bi-instagram"></i></a>
                        <a href="#" class="whatsApp"><i class="bi bi-whatsApp"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Seputar UNITAMNA</h4>
                    <ul>
                        <li><a href="https://pmb.unitama.ac.id/">Info Pendaftaran</a></li>
                        <li><a href="https://unitama.ac.id/category/berita/">Berita kampus</a></li>
                        <li><a
                                href="https://www.google.com/maps/place/Universitas+Teknologi+Akba+Makassar/@-5.141534,119.484918,14z/data=!4m6!3m5!1s0x2dbee335adf2d2b3:0x5a92f8b04f063c19!8m2!3d-5.1415338!4d119.4849179!16s%2Fg%2F1ptw322sc?hl=en&entry=ttu">Alamat</a>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="container mt-4">
                <div class="copyright">
                    &copy; Copyright <strong><span>SIBERTA</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">CALLU HABIB</a>
                </div>
            </div>

    </footer><!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
