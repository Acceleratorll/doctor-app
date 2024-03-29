@extends('layouts.mainweb')

@section('content')
        
    <!-- =========================
        Header
    =========================== -->
    <header class="header header-layout1">
        @php
        $name = $doctor->name;
        $words = explode(' ', $name);
        $firstWord = $words[0];
        $secondWord = $words[1];
        @endphp
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
                    <a href="{{ route('dashboard') }}" class="nav__item-link active">Home</a>
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
                            {{-- {{ auth()->user()->patient->unreadNotifications->count() }} --}}
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

        <!-- ============================
            Slider
        ============================== -->
        <section class="slider">
        <div class="slick-carousel m-slides-0"
            data-slick='{"slidesToShow": 1, "arrows": true, "dots": false, "speed": 700,"fade": true,"cssEase": "linear"}'>
            <div class="slide-item align-v-h">
            <div class="bg-img"><img src="{{ asset('assets/images/sliders/10.png') }}" alt="slide img"></div>
            <div class="container">
                <div class="row align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                    <div class="slide__content">
                    <h2 class="slide__title">Perawatan Medis Terbaik</h2>
                    <p class="slide__desc">Kesehatan dan kesejahteraan pasien kami dan tim perawatan kesehatan mereka akan selalu menjadi prioritas kami, jadi kami
                    mengikuti praktik terbaik untuk kebersihan.</p>
                    <ul class="features-list list-unstyled mb-0 d-flex flex-wrap">
                        <!-- feature item #1 -->
                        <li class="feature-item">
                        <div class="feature__icon">
                            <i class="icon-heart"></i>
                        </div>
                        <h2 class="feature__title">Examination</h2>
                        </li><!-- /.feature-item-->
                        <!-- feature item #2 -->
                        <li class="feature-item">
                        <div class="feature__icon">
                            <i class="icon-medicine"></i>
                        </div>
                        <h2 class="feature__title">Prescription </h2>
                        </li><!-- /.feature-item-->
                        <!-- feature item #3 -->
                        <li class="feature-item">
                        <div class="feature__icon">
                            <i class="icon-heart2"></i>
                        </div>
                        <h2 class="feature__title">Cardiogram</h2>
                        </li><!-- /.feature-item-->
                        <!-- feature item #4 -->
                        <li class="feature-item">
                        <div class="feature__icon">
                            <i class="icon-blood-test"></i>
                        </div>
                        <h2 class="feature__title">Blood Pressure</h2>
                        </li><!-- /.feature-item-->
                    </ul><!-- /.features-list -->
                    </div><!-- /.slide-content -->
                </div><!-- /.col-xl-7 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            </div><!-- /.slide-item -->
        </div><!-- /.carousel -->
        </section><!-- /.slider -->

        <!-- ============================
            contact info
        ============================== -->
        <section class="contact-info py-0">
        <div class="container">
            <div class="row row-no-gutter boxes-wrapper">
            <div class="col-sm-12 col-md-6">
                <div class="contact-box d-flex">
                <div class="contact__icon">
                    <i class="icon-call3"></i>
                </div><!-- /.contact__icon -->
                <div class="contact__content">
                    <h2 class="contact__title">Kasus Darurat</h2>
                    <p class="contact__desc">Jangan ragu untuk menghubungi staf resepsi kami yang ramah dengan pertanyaan umum atau medis.</p>
                    <a href="https://wa.me/{{ $doctor->phone }}" class="phone__number">
                    <i class="icon-phone"></i> <span>{{ $doctor->phone }}</span>
                    </a>
                </div><!-- /.contact__content -->
                </div><!-- /.contact-box -->
            </div><!-- /.col-md-4 -->
            <div class="col-sm-12 col-md-6">
                <div class="contact-box d-flex">
                <div class="contact__icon">
                    <i class="icon-health-report"></i>
                </div><!-- /.contact__icon -->
                <div class="contact__content">
                    <h2 class="contact__title">Jadwal Dokter</h2>
                    <p class="contact__desc">Catatan mengenai jadwal Dokter , lihat jadwal kami.</p>
                    <br><br>
                    <a href="{{ route('jadwal.index') }}" class="btn btn__white btn__outlined btn__rounded">
                    <span>Lihat Jadwal</span><i class="icon-arrow-right"></i>
                    </a>
                </div><!-- /.contact__content -->
                </div><!-- /.contact-box -->
            </div><!-- /.col-md-4 -->
            {{-- <div class="col-sm-12 col-md-4">
                <div class="contact-box d-flex">
                <div class="contact__icon">
                    <i class="icon-heart2"></i>
                </div><!-- /.contact__icon -->
                <div class="contact__content">
                    <h2 class="contact__title">Jadwal Terdekat</h2>
                    <ul class="time__list list-unstyled mb-0">
                        @php
                        use App\Models\Place;
                        $rs = Place::findOrFail(1);
                        $klinik = Place::findOrFail(2);
                        @endphp
                    <li><span>{{ $rs->name }}</span></li>
                    <li><span style="margin-right: 20px">Senin-Jumat</span><span>8.00-11.00</span></li>
                    <li><span>{{ $klinik->name }}</span></li>
                    <li><span style="margin-right: 20px">Senin-Sabtu</span><span>13.00-16.00</span></li>
                    </ul>
                </div><!-- /.contact__content -->
                </div><!-- /.contact-box -->
            </div><!-- /.col-md-4 --> --}}
            </div><!-- /.row -->
        </div><!-- /.container -->
        </section><!-- /.contact-info -->

        <!-- ========================
            Info Terkait 
        =========================== -->
    <section class="shop-grid">
        <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-40">
                <h3 class="heading__title">Informasi Terkait</h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <div class="row">
            <!-- Product item #1 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="product-item">
                <div class="product__img">
                    <img src="{{ asset('assets/images/products/13.png') }}" alt="Product" loading="lazy">
                    <div class="product__action">
                    </div><!-- /.product-action -->
                </div><!-- /.product-img -->
                <div class="product__info">
                    <h4 class="product__title"><a href="{{ route('test-covid') }}">Paket Tes Covid 19</a></h4>
                </div><!-- /.product-content -->
                </div><!-- /.product-item -->
            </div><!-- /.col-lg-3 -->
            <!-- Product item #2 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="product-item">
                <div class="product__img">
                    <img src="{{ asset('assets/images/products/14.png') }}" alt="Product" loading="lazy">
                    <div class="product__action">
                    </div><!-- /.product-action -->
                </div><!-- /.product-img -->
                <div class="product__info">
                    <h4 class="product__title"><a href="/jadwal-klinik">{{ $firstWord.' '.$secondWord }} At Home</a></h4>
                </div><!-- /.product-content -->
                </div><!-- /.product-item -->
            </div><!-- /.col-lg-3 -->
            <!-- Product item #3 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="product-item">
                <div class="product__img">
                    <img src="{{ asset('assets/images/products/15.png') }}" alt="Product" loading="lazy">
                    <div class="product__action">
                    </div><!-- /.product-action -->
                </div><!-- /.product-img -->
                <div class="product__info">
                    <h4 class="product__title"><a href="{{ route('konsultasi') }}">Konsultasi Online</a></h4>
                </div><!-- /.product-content -->
                </div><!-- /.product-item -->
            </div><!-- /.col-lg-3 -->
            <!-- Product item #4 -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="product-item">
                <div class="product__img">
                    <img src="{{ asset('assets/images/products/16.png') }}" alt="Product" loading="lazy">
                    <div class="product__action">
                    </div><!-- /.product-action -->
                </div><!-- /.product-img -->
                <div class="product__info">
                    <h4 class="product__title"><a href="#">Aplikasi Mobile</a></h4>
                </div><!-- /.product-content -->
                </div><!-- /.product-item -->
            </div><!-- /.col-lg-3 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
        </section><!-- /.shop -->

        <!-- ======================
            Blog Grid
            ========================= -->
        <section class="blog-grid" style="margin-top: -150px;">
        {{-- <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-40">
                <h3 class="heading__title">Artikel Kesehatan</h3>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <div class="row">
            <!-- Post Item #1 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="post-item">
                <div class="post__img">
                    <a href="https://www.cnnindonesia.com/gaya-hidup/20230607122324-255-958704/waspada-kualitas-udara-buruk-dokter-ingatkan-tetap-pakai-masker">
                    <img src="{{ asset('assets/images/blog/grid/7.jpg') }}" alt="post image" loading="lazy">
                    </a>
                </div><!-- /.post__img -->
                <div class="post__body">
                    <div class="post__meta-cat">
                    <a href="#">Kesehatan Udara</a>
                    </div><!-- /.blog-meta-cat -->
                    <div class="post__meta d-flex">
                    <span class="post__meta-date">Juni 7, 2023</span>
                    <a class="post__meta-author" href="#">CNN Indonesia</a>
                    </div>
                    <h4 class="post__title"><a href="https://www.cnnindonesia.com/gaya-hidup/20230607122324-255-958704/waspada-kualitas-udara-buruk-dokter-ingatkan-tetap-pakai-masker">Waspada Kualitas Udara Buruk, Dokter Ingatkan Tetap Pakai Masker</a></h4>
        
                    <p class="post__desc" style="text-align: justify;">Dokter spesialis paru di RSUP Persahabatan, Erlina Burhan menyebut kualitas udara di Jakarta dan sekitarnya memang
                    berada di level yang mengkhawatirkan. Buruknya kualitas udara ini tidak hanya memengaruhi kondisi kesehatan anak-anak,
                    bahkan orang dewasa juga bisa terdampak. Saat ini banyak masyarakat yang sudah melepas masker baik saat beraktivitas di dalam maupun di luar ruangan.
                    </p>
                    <a href="https://www.cnnindonesia.com/gaya-hidup/20230607122324-255-958704/waspada-kualitas-udara-buruk-dokter-ingatkan-tetap-pakai-masker" class="btn btn__secondary btn__link btn__rounded">
                    <span>Read More</span>
                    <i class="icon-arrow-right"></i>
                    </a>
                </div><!-- /.post__body -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            <!-- Post Item #2 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="post-item">
                <div class="post__img">
                    <a href="https://www.cnnindonesia.com/gaya-hidup/20230530103037-262-955646/wajib-tahu-8-makanan-yang-bisa-menurunkan-kadar-gula-darah">
                    <img src="{{ asset('assets/images/blog/grid/8.jpg') }}" alt="post image" loading="lazy">
                    </a>
                </div><!-- /.post__img -->
                <div class="post__body">
                    <div class="post__meta-cat">
                    <a href="#">Kesehatan Makanan</a>
                    </div><!-- /.blog-meta-cat -->
                    <div class="post__meta d-flex">
                    <span class="post__meta-date">Juni 5, 2023</span>
                    <a class="post__meta-author" href="#">CNN Indonesia</a>
                    </div>
                    <h4 class="post__title"><a href="https://www.cnnindonesia.com/gaya-hidup/20230530103037-262-955646/wajib-tahu-8-makanan-yang-bisa-menurunkan-kadar-gula-darah">Wajib Tahu, 8 Makanan yang Bisa Menurunkan Kadar Gula Darah</a></h4>
                    <p class="post__desc" style="text-align: justify;">Memilih makanan dengan indeks glikemik (GI) rendah adalah salah satu cara untuk membantu menurunkan atau mengelola kadar
                    gula darah. Indeks glikemik mengukur efek makanan tertentu pada kadar gula darah. Bagi penderita diabetes, makanan dan minuman yang diserap tubuh secara perlahan adalah yang terbaik karena tidak
                    menyebabkan lonjakan dan penurunan gula darah.
                    </p>
                    <a href="https://www.cnnindonesia.com/gaya-hidup/20230530103037-262-955646/wajib-tahu-8-makanan-yang-bisa-menurunkan-kadar-gula-darah" class="btn btn__secondary btn__link btn__rounded">
                    <span>Read More</span>
                    <i class="icon-arrow-right"></i>
                    </a>
                </div><!-- /.post__body -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            <!-- Post Item #3 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="post-item">
                <div class="post__img">
                    <a href="https://www.cnnindonesia.com/gaya-hidup/20230530173747-255-955933/udara-jakarta-lagi-tak-sehat-waspada-5-penyakit-akibat-polusi-ini">
                    <img src="{{ asset('assets/images/blog/grid/9.jpg') }}" alt="post image" loading="lazy">
                    </a>
                </div><!-- /.post__img -->
                <div class="post__body">
                    <div class="post__meta-cat">
                    <a href="#">Kesehatan Udara</a>
                    </div><!-- /.blog-meta-cat -->
                    <div class="post__meta d-flex">
                    <span class="post__meta-date">Juni 1, 2023</span>
                    <a class="post__meta-author" href="#">CNN Indonesia</a>
                    </div>
                    <h4 class="post__title"><a href="https://www.cnnindonesia.com/gaya-hidup/20230530173747-255-955933/udara-jakarta-lagi-tak-sehat-waspada-5-penyakit-akibat-polusi-ini">Udara Jakarta Lagi Tak Sehat, Waspada 5 Penyakit Akibat Polusi Ini</a></h4>
        
                    <p class="post__desc" style="text-align: justify;">Sumber polutan di Jakarta masih PM2,5, yakni partikel udara berukuran lebih kecil dari 2,5 mikron (mikrometer). Mengutip
                    situs BMKG, nilai ambang batas (NAB) polusi udara yang diperbolehkan berada dalam udara ambien yakni 65 µgram/m3. Namun pada Selasa (30/5), nilai PM2,5 Jakarta mencapai 66,2 µg/m³ atau 13,2 kali batas nilai pedoman kualitas udara
                    tahunan Organisasi Kesehatan Dunia (WHO).
                    </p>
                    <a href="https://www.cnnindonesia.com/gaya-hidup/20230530173747-255-955933/udara-jakarta-lagi-tak-sehat-waspada-5-penyakit-akibat-polusi-ini" class="btn btn__secondary btn__link btn__rounded">
                    <span>Read More</span>
                    <i class="icon-arrow-right"></i>
                    </a>
                </div><!-- /.post__body -->
                </div><!-- /.post-item -->
            </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
            <div class="row">
            <div class="col-12 text-center">
                <a href="https://jovee.id/artikel/" class="btn btn__secondary btn__rounded">
                <span>Lihat Selengkapnya</span>
                <i class="icon-arrow-right"></i>
                </a>
            </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
        </div><!-- /.container --> --}}
    </section><!-- /.blog Grid -->

@endsection