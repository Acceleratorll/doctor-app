@extends('layouts.mainweb')

@section('content')     

    <!-- =========================
            Header
        =========================== -->
    <header class="header header-layout1">
        <!-- /.header-top -->
        <nav class="navbar navbar-expand-lg sticky-navbar">
            <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/images/logo/2.png') }}" class="logo-light" alt="logo">
                <img src="{{ asset('assets/images/logo/1.png') }}" class="logo-dark" alt="logo">
            </a>
            <button class="navbar-toggler" type="button">
                <span class="menu-lines"><span></span></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavigation">
                <ul class="navbar-nav ml-auto">
                <li class="nav__item">
                    <a href="{{ route('dashboard') }}" class="nav__item-link">Home</a>
                </li>
                <!-- /.nav-item -->
                <li class="nav__item">
                    <a href="{{ route('jadwal.index') }}" class="nav__item-link">Layanan</a>
                </li><!-- /.nav-item -->
                <li class="nav__item">
                    <a href="{{ route('show.queue') }}" class="nav__item-link">Lihat Antrian</a>
                </li>
                <li class="nav__item notif">
                    <a href="{{ route('pengumuman.index') }}" class="nav__item-link">Pengumuman
                        @if(auth()->user())
                        <span>
                            {{ auth()->user()->patient->unreadNotifications->count() }}
                        </span>
                        @endif</a>
                </li><!-- /.nav-item -->
                <li class="nav__item">
                    <a href="{{ route('contact.index') }}" class="nav__item-link">Contacts Us</a>
                </li><!-- /.nav-item -->
                <li class="nav__item notif">
                    <a href="{{ url('/notifikasi') }}" class="nav__item-link">Notifikasi<span>{{session('notification.count', 0)}}</span></a>
                </li><!-- /.nav-item -->
                @if(auth()->user())
                <li class="nav__item dropdown">
                                <a class="nav__item-link dropdown-toggle" href="#" role="button" id="profileDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                    
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                    <a class="dropdown-item" href="/profile">My Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                </ul><!-- /.navbar-nav -->
                <button class="close-mobile-menu d-block d-lg-none"><i class="fas fa-times"></i></button>
            </div><!-- /.navbar-collapse -->
            
            @else
            <div class="d-none d-xl-flex align-items-center position-relative ml-30">
                <a href="{{ route('login') }}" class="btn btn__primary btn__rounded ml-30">
                    <i class="icon-calendar"></i>
                    <span>Login</span>
                </a>
            </div>
            @endif
            </div><!-- /.container -->
        </nav><!-- /.navabr -->
        </header><!-- /.Header -->

        <!-- ========================
        Data Tes Covid 19 
        =========================== -->
    
        <section class="testimonials-layout2 pt-30 pb-40" >
        <div class="container">
            <div class="testimonials-wrapper">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-11">
                <h1 class="heading__title">Paket Rapid Test, Swab Antigen, PCR & Serologi COVID-19</h1>
                <h2 class="heading__subtitle" style="margin-top: -10px;">Dapatkan paket tes COVID-19 mulai dari Rapid Test, Swab Antigen, PCR dan Serologi.</h2>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-1">
                </div> <br><br><br><br><br><br><br><br>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="testimonial-item">
                    <h5 class="service__title">Paket Antibodi Kuantitatif Rp229.000</h5>
                    <ul class="text__content"> 
                        <li class="heading__desc font-weight-bold color-secondary "> Harga Rp 229.000 untuk pembelian langsung datang ke klinik Dr. Alex</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Tes Titer Anti SARS-CoV-2.</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Transaksi melalui pembelian online tidak dapat dikembalikan.</li>
                    </ul>
                    </div>
                </div><!-- /.col-lg-5 -->
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="testimonial-item">
                    <h5 class="service__title">Rapid Antigen Nasal COVID19 Rp149.000</h5>
                    <ul class="text__content">
                        <li class="heading__desc font-weight-bold color-secondary "> Harga Rp 149.000 untuk pembelian langsung di klinik Dr. Alex</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Transaksi melalui pembelian online tidak dapat dikembalikan.</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Pengambilan sampel dengan kedalaman 2 cm dari permukaan hidung, sangat nyaman untuk anak-anak dan lansia.</li>
                    </ul>
                    </div>
                </div><!-- /.col-lg-7 -->
            </div><!-- /.row -->
            </div><!-- /.testimonials-wrapper -->
        </div><!-- /.container -->
        <div class="container">
            <div class="testimonials-wrapper">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="testimonial-item">
                    <h5 class="service__title">Paket COVID19 Platinum Rp899.000</h5>
                    <ul class="text__content">
                    <li class="heading__desc font-weight-bold color-secondary "> Paket termasuk pemeriksaan RT-PCR, vitamin, dan voucher potongan harga untuk pembelian produk di website.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Harap datang 15 menit sebelum appointment/janji temu.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Hasil diterima 6 jam terhitung dari waktu sampel diproses oleh laboratorium Siloam.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Pengambilan sampel melalui hidung dan/atau tengorokan.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Dana tidak dapat dikembalikan apabila melakukan pembatalan janji kunjungan.</li>
                    </ul>
                </div>
                </div><!-- /.col-lg-5 -->
                <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="testimonial-item">
                    <h5 class="service__title">Swab Antigen ELECSYS Rp199.000</h5>
                    <ul class="text__content">
                    <li class="heading__desc font-weight-bold color-secondary "> Paket pemeriksaan COVID-19 dengan metode electrochemiluminescence (ECLIA) untuk deteksi materi nukleokapsid SARS-CoV-2
                    melalui swab nasofaring atau orofaring. Efektif untuk deteksi infeksi aktif.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Transaksi melalui pembelian online tidak dapat dikembalikan.</li>
                    </ul>
                </div>
                </div><!-- /.col-lg-7 -->
            </div><!-- /.row -->
            </div><!-- /.testimonials-wrapper -->
        </div><!-- /.container -->
        <div class="container">
            <div class="testimonials-wrapper">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="testimonial-item">
                    <h5 class="service__title">Paket COVID19 Platinum Rp899.000</h5>
                    <ul class="text__content">
                    <li class="heading__desc font-weight-bold color-secondary "> Paket RT-PCR COVID-19 Gold Money back guarantee 100%**</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Paket termasuk pemeriksaan RT-PCR dan vitamin.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Harga Rp.900.000 berlaku untuk pembelian melalui wesbite atau aplikasi.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Harga Rp.900.000 berlaku untuk pembelian melalui wesbite atau aplikasi.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Harap datang 15 menit sebelum janji temu</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Hasil diterima 12 jam setelah sampel diproses oleh laboratorium.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Money back guarantee tidak berlaku untuk hasil inconclusive.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Pengajuan pengembalian dana paling lambat 6 jam kerja setelah hasil diterima.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Data pasien yang melakukan swab harus sesuai dengan data yang didaftarkan di form pembelian paket.</li>
                    </ul>
                </div>
                </div><!-- /.col-lg-5 -->
                <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="testimonial-item">
                    <h5 class="service__title">RT-PCR Regular Rp275.000</h5>
                    <ul class="text__content">
                    <li class="heading__desc font-weight-bold color-secondary "> Hasil tes 1x24 jam (terhitung dari waktu sampel diterima di laboratorium).</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Data pasien yang melakukan swab harus sesuai dengan data yang didaftarkan di form pembelian paket.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Golden standard untuk akurasi hasil tes COVID-19.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Pengambilan sampel melalui hidung dan/atau tenggorokan.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Dana tidak dapat dikembalikan apabila melakukan pembatalan janji kunjungan.</li>
                    </ul>
                </div>
                </div><!-- /.col-lg-7 -->
            </div><!-- /.row -->
            </div><!-- /.testimonials-wrapper -->
        </div><!-- /.container -->
        <div class="container">
            <div class="testimonials-wrapper">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="testimonial-item">
                    <h5 class="service__title">Rapid Test Rp99.000</h5>
                    <ul class="text__content">
                    <li class="heading__desc font-weight-bold color-secondary "> Harga Rp 79.000 berlaku untuk pembelian melalui website.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Tes antibodi IgG/IgM.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Tingkat sensitivitas hingga >91.54% dan spesifisitas >97.02%.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Diakui oleh CE (Conformite Europene) Eropa, FDA EUA (Emergency Use Authorization) Amerika Serikat, dan HAS.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Telah digunakan di Amerika Serikat, Eropa, Filipina, Hong Kong, dan Tiongkok.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Cepat, hasil ± 15 menit (cocok bagi pasien yang perlu hasil cepat atau dalam keadaan emergency/mendadak).</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Pengambilan sampel darah dengan hand prick.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Transaksi melalui pembelian online tidak dapat dikembalikan.</li>
                    </ul>
                </div>
                </div><!-- /.col-lg-5 -->
                <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="testimonial-item">
                    <h5 class="service__title">Serology Test & Konsultasi Dokter Rp299.000</h5>
                    <ul class="text__content">
                    <li class="heading__desc font-weight-bold color-secondary "> Tes total antibodi.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Merk/brand berkualitas tinggi Roche.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Tingkat sensitivitas hingga 100% dan spesifisitas >99.81%.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Diakui oleh CE (Conformite Europene) Eropa, FDAEUA (Emergency Use Authorization) Amerika Serikat, dan NHS Inggris.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Telah digunakan di Amerika Serikat, Australia, Eropa, Inggris, dan Singapura.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Minim cross reactive dengan virus lainnya.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Pengambilan sampel darah melalui vena.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Transaksi melalui pembelian online tidak dapat dikembalikan.</li>
                    </ul>
                </div>
                </div><!-- /.col-lg-7 -->
            </div><!-- /.row -->
            </div><!-- /.testimonials-wrapper -->
        </div><!-- /.container -->
        <div class="container">
            <div class="testimonials-wrapper">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="testimonial-item">
                    <h5 class="service__title">Paket Antigen C19 360° Rp399.000</h5>
                    <ul class="text__content"> 
                        <li class="heading__desc font-weight-bold color-secondary "> Harga Rp 379.000 berlaku untuk pembelian melalui website</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Harga Rp 399.000 untuk pembelian langsung di klinik</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Tes Swab Antigen.</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Tes Rapid Antibodi.</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Konsultasi dokter./li>
                        <li class="heading__desc font-weight-bold color-secondary "> Surat Keterangan Hasil.</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Vitamin.</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Transaksi melalui pembelian online tidak dapat dikembalikan.</li>
                    </ul>
                    </div>
                </div><!-- /.col-lg-5 -->
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="testimonial-item">
                    <h5 class="service__title">Rapid Test, Konsultasi Dokter, & Vitamin Rp249.000</h5>
                    <ul class="text__content">
                        <li class="heading__desc font-weight-bold color-secondary "> Tes antibodi IgG/IgM.</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Tingkat sensitivitas hingga >91.54% dan spesifisitas >97.02%.</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Diakui oleh CE (Conformite Europene) Eropa, FDA EUA (Emergency Use Authorization) Amerika Serikat, dan HAS.</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Telah digunakan di Amerika Serikat, Eropa, Filipina, Hong Kong, dan Tiongkok.</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Cepat, hasil ± 15 menit (cocok bagi pasien yang perlu hasil cepat atau dalam keadaan emergency/mendadak).</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Pengambilan sampel darah dengan hand prick.</li>
                        <li class="heading__desc font-weight-bold color-secondary "> Transaksi melalui pembelian online tidak dapat dikembalikan.</li>
                    </ul>
                    </div>
                </div><!-- /.col-lg-7 -->
            </div><!-- /.row -->
            </div><!-- /.testimonials-wrapper -->
        </div><!-- /.container -->
        <div class="container">
            <div class="testimonials-wrapper">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="testimonial-item">
                    <h5 class="service__title">Paket COVID19 Gold Rp599.000</h5>
                    <ul class="text__content">
                    <li class="heading__desc font-weight-bold color-secondary "> Paket termasuk pemeriksaan RT-PCR, vitamin, dan voucher potongan harga untuk pembelian produk di website</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Batas akhir pengambilan swab adalah pukul 11.00</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Harap datang 15 menit sebelum appointment/janji temu</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Hasil diterima 12 jam terhitung dari waktu sampel diproses oleh laboratorium Siloam.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Pengambilan sampel melalui hidung dan/atau tengorokan</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Dana tidak dapat dikembalikan apabila melakukan pembatalan janji kunjungan</li>
                    </ul>
                </div>
                </div><!-- /.col-lg-5 -->
                <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="testimonial-item">
                    <h5 class="service__title">Molecular Isothermal COVID19- Untuk 2 orang Rp1.600.000</h5>
                    <ul class="text__content">
                    <li class="heading__desc font-weight-bold color-secondary "> Pemeriksaan Rapid Molecular Test (untuk 2 orang).</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Harga Rp 1.560.000 berlaku untuk pembelian melalui mcu.siloamhospitals.com.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Harga Rp 1.600.000 untuk pembelian langsung di seluruh unit Siloam Hospitals dan Linktree.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Transaksi melalui pembelian online tidak dapat dikembalikan.</li>
                    </ul>
                </div>
                </div><!-- /.col-lg-7 -->
            </div><!-- /.row -->
            </div><!-- /.testimonials-wrapper -->
        </div><!-- /.container -->
        <div class="container">
            <div class="testimonials-wrapper">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="testimonial-item">
                    <h5 class="service__title">Molecular Isothermal COVID19 Rp850.000</h5>
                    <ul class="text__content">
                    <li class="heading__desc font-weight-bold color-secondary "> Harga normal Rp 850.000 untuk pembelian langsung di klinik.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Pemeriksaan Rapid Molecular Test untuk 1 orang.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Transaksi melalui pembelian online tidak dapat dikembalikan.</li>
                    </ul>
                </div>
                </div><!-- /.col-lg-5 -->
                <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="testimonial-item">
                    <h5 class="service__title">Serology Test, Konsultasi Dokter & Vitamin Rp399.000</h5>
                    <ul class="text__content">
                    <li class="heading__desc font-weight-bold color-secondary "> Serology Test, Konsultasi Dokter & Vitamin Rp399.000</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Tes total antibodi.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Merk/brand berkualitas tinggi Roche.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Tingkat sensitivitas hingga 100% dan spesifisitas >99.81%.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Diakui oleh CE (Conformite Europene) Eropa, FDA EUA (Emergency Use Authorization) Amerika Serikat, dan NHS Inggris.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Telah digunakan di Amerika Serikat, Australia, Eropa, Inggris, dan Singapura.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Minim cross reactive dengan virus lainnya.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Pengambilan sampel darah melalui vena.</li>
                    <li class="heading__desc font-weight-bold color-secondary "> Transaksi melalui pembelian online tidak dapat dikembalikan.</li>
                    </ul>
                </div>
                </div><!-- /.col-lg-7 -->
            </div><!-- /.row -->
            </div><!-- /.testimonials-wrapper -->
        </div><!-- /.container -->
    </section><!-- /.testimonials layout 2 -->

@endsection