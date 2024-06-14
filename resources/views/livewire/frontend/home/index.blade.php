<div>
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row gy-4 d-flex justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <img class="mb-3" style="width: 280px" src="{{ asset('assets/siberta/logo-siberta-light.svg') }}" alt="siberta">
                    <h2 data-aos="fade-up">SISTEM INFORMASI BERKAS ADMINISTRASI TUGAS AKHIR </h2>
                    <p data-aos="fade-up" data-aos-delay="100">Sistem Layanan Pemberkasan Tugas Akhir Universitas Teknologi
                        Akba Makassar</p>

                    <form action="#" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="200">
                        <input type="text" class="form-control" placeholder="Masukkan ID Berkas">
                        <button type="submit" class="btn btn-primary">Lacak</button>
                    </form>

                    <div class="row gy-4" data-aos="fade-up" data-aos-delay="400">

                        <div class="col-lg-5 col-6">
                            <div class="">
                                <button type="submit" class="btn btn-primary">PENGAJUAN BERKAS</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 hero-img d-lg-block d-none" data-aos="zoom-out">
                    <img src="{{ asset('img/hero-img.png') }}" class="img-fluid mb-3 mb-lg-0" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="about">
        <div class="container" data-aos="fade-up">
            <div class="col-lg-6 content order-last  order-lg-first">
                <h3>Persyaratan Layanan</h3>
                <p><b>Perhatikan persyaratan dalam pengumpulan berkas mahasiswa!</b></p>

                <div class="row">
                    <div class="col-lg-8 col-12">

                        <h4 class="my-4" style="color: #19328a">Pengajuan Berkas Seminar Proposal</h4>

                        <ol type="number" class="my-3" style="font-weight: bold">
                            @foreach (config('const.name_file.proposal') as $key => $proposal)
                                <li wire:key='row-{{ $key }}' class="mt-3">{{ $proposal }}</li>
                            @endforeach
                        </ol>

                        <h4 class="my-4" style="color: #001F8D">Pengajuan Berkas Seminar Hasil</h4>

                        <ol type="number" class="my-3" style="font-weight: bold">
                            @foreach (config('const.name_file.hasil') as $key => $hasil)
                                <li wire:key='row-{{ $key }}' class="mt-3">{{ $hasil }}</li>
                            @endforeach
                        </ol>

                        <h4 class="my-4" style="color: #001F8D">Pengajuan Berkas Tutup</h4>

                        <ol type="number" class="my-3" style="font-weight: bold">
                            @foreach (config('const.name_file.tutup') as $key => $tutup)
                                <li wire:key='row-{{ $key }}' class="mt-3">{{ $tutup }}</li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="col-lg-4 col-12 text-center d-lg-block d-none">
                        <img class="m-auto" style="width: 700px; margin-left: 20px; margin-top: 500px;" src="{{ asset('assets/siberta/illustration.png') }}" alt="ilustrasi">
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="tutorial" class="about">
        <div class="container" data-aos="fade-up">
            <div class="col-lg-6 content order-last  order-lg-first">
                <h3>VIDEO PANDUAN</h3>
                <p><b>Nonton video cara menggunakan siberta, untuk mengetahui lebih lanjut.</b></p>
                <div class="col-lg-3 col-6">
                    <div class="stats-item text-center w-100 h-100">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/h1J4vSn8bS4?si=kA0MKJodwLd-rxei" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <span>Frequently Asked Questions FOR</span>
                <h2>Frequently Asked Questions FOR</h2>
            </div>

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-10">
                    <div class="accordion accordion-flush" id="faqlist">
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-1">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    APA ITU SIBERTA?
                                </button>
                            </h3>
                            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    Aplikasi SIBERTA Adalah Singkatan dari Sistem Informasi Berkas Administrasi Tugas
                                    akhir yang mendukung dalam pelayanan bagi mahasiswa semester akhir.

                                    Dimana mahasiswa yang dalam semeter akhir dapat mengumpulkan berkas proposal, hasil dan tutup pada aplikasi ini dengan mudah, dimana dan kapan pun.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-2">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    Bagai Maca Cara Melihat Berkas Mahasiswa?
                                </button>
                            </h3>
                            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    Untuk melihat berkas yang anda telah kumpulkan, anda dapat memasukkan kode berkas pada form "Masukkan ID Berkas", kode berkas di dapatkan pada saat mahasiswa telah mengumpulkan berkasnya, yang di kirim melalui email mahasiswa yang diberikan oleh pihak kampus.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq-content-3">
                                    <i class="bi bi-question-circle question-icon"></i>
                                    Bagai Mana Cara Mengumpulkan Berkas?
                                </button>
                            </h3>
                            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                <div class="accordion-body">
                                    Untuk mengumpulkan berkas, mahasiswa cukup menekan tombol "PENGAJUAN BERKAS",
                                    lalu masukkan email, kemudian konfirmasi kode OTP yang terdapat pada email mahasiswa, selanjutnya mahasiswa akan diarahkan untuk memilih jenis berkas yang ingin dikumpulkan seperti proposal, hasil & tutup, kemudian mahasiswa harus memilih jenis-jenis file nya yang ingin di serahkan.

                                    Setelah itu mahaiswa akan dikirim kan kode berkas yang berhasil di serahkan oleh mahasiswa.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
