<footer id="kontak" class="footer">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-info">
                <img class="mb-3" style="width: 240px" src="{{ asset('assets/siberta/logo-siberta-light.svg') }}" alt="logo-siberta">
                <p>Sistem Layanan Pemberkasan Tugas Akhir Universitas Teknologi Akba Makassar.</p>
                <div class="social-links d-flex mt-4">
                    <a href="https://x.com/kampus_unitama" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="https://web.facebook.com/unitama.ac.id/" class="facebook"><i
                            class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/unitama.ac.id/" class="instagram"><i
                            class="bi bi-instagram"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>LINK</h4>
                <ul>
                    @foreach (config('navbar') as $navbar)
                        <li><a href="{{ $navbar['link'] }}" class="{{ $navbar['status'] == 'active' ? 'active' : '' }}">{{ $navbar['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>UNITAMA</h4>
                <ul>
                    <li><a href="https://pmb.unitama.ac.id/">Info Pendaftaran</a></li>
                    <li><a href="https://unitama.ac.id/category/berita/">Berita kampus</a></li>
                    <li><a href="https://www.google.com/maps/place/Universitas+Teknologi+Akba+Makassar/@-5.141534,119.484918,14z/data=!4m6!3m5!1s0x2dbee335adf2d2b3:0x5a92f8b04f063c19!8m2!3d-5.1415338!4d119.4849179!16s%2Fg%2F1ptw322sc?hl=en&entry=ttu">Maps</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-6 footer-links">
                <h4>KONTAK</h4>
                <p>Jl. Perintis Kemerdekaan No.75, Makassar</p>
                <p>info@unitama.ac.id</p>
                <p>0411-588371</p>
            </div>
        </div>

        <div class="container mt-4">
            <div class="copyright">
                &copy; Copyright <strong><span>SIBERTA</span></strong>. All Rights Reserved
            </div>

            <div class="credits">
                Design by <a href="https://github.com/ryoogenmedia">Ryoogen Media</a>
            </div>

            <div class="credits">
                Powered by <a href="https://unitama.ac.id/">Universitas Teknologi Akba Makassar (UNITAMA)</a>
            </div>
        </div>
</footer>
