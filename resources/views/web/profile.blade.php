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
                <img src="assets/images/logo/2.png" class="logo-light" alt="logo">
                <img src="assets/images/logo/1.png" class="logo-dark" alt="logo">
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
                    <a href="{{ route('profile.index') }}" class="nav__item-link active">Profile Doctors</a>
                </li><!-- /.nav-item -->
                <li class="nav__item">
                    <a href="{{ route('contact.index') }}" class="nav__item-link">Contacts Us</a>
                </li><!-- /.nav-item -->
                </ul><!-- /.navbar-nav -->
                <button class="close-mobile-menu d-block d-lg-none"><i class="fas fa-times"></i></button>
            </div><!-- /.navbar-collapse -->
            @if(auth()->user())
            <div class="d-none d-xl-flex align-items-center position-relative ml-30">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn__primary btn__rounded ml-30">
                        <i class="icon-calendar"></i>
                        Logout
                    </button>
                </form>
            </div>
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
        page title 
        =========================== -->
        <section class="page-title page-title-layout5">
        <div class="bg-img"><img src="assets/images/backgrounds/6.jpg" alt="background"></div>
        <div class="container">
            <div class="row">
            <div class="col-12">
                <h1 class="pagetitle__heading">Dr. Alexander Bell</h1>
            </div><!-- /.col-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
        </section><!-- /.page-title -->

        <section class="pt-120 pb-80">
        <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <aside class="sidebar has-marign-right">
                <div class="widget widget-member">
                    <div class="member mb-0">
                    <div class="member__img">
                        <img src="assets/images/team/10.jpg" alt="member img">
                    </div><!-- /.member-img -->
                    <div class="member__info">
                        <h5 class="member__name"><a href="{{ route('profile.index') }}">Dr. Alexander Bell</a></h5>
                        <p class="member__job">Spesialis Umum</p>
                        <p class="member__desc">Dr. Alexander Bell adalah seorang dokter umum yang berdedikasi dan berpengalaman. Ia memiliki pengetahuan luas dalam
                        berbagai kondisi medis dan memberikan perawatan yang berkualitas kepada pasien-pasienya.</p>
                        <div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
                        <ul class="social-icons list-unstyled mb-0">
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul><!-- /.social-icons -->
                        </div>
                    </div><!-- /.member-info -->
                    </div><!-- /.member -->
                </div><!-- /.widget-member -->
                </aside><!-- /.sidebar -->
            </div><!-- /.col-lg-4 -->
            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="text-block mb-50">
                <h5 class="text-block__title">Biography</h5>
                <p class="text-block__desc mb-20 font-weight-bold color-secondary" style="text-align: justify;">Dr. Alexander Bell adalah seorang dokter umum yang berdedikasi dalam memberikan pelayanan kesehatan kepada masyarakat.
                Ia tumbuh di lingkungan keluarga yang menghargai kesehatan dan memberikan perhatian pada kesejahteraan orang lain. Sejak kecil, Dr. Alexander Bell tertarik pada ilmu kedokteran dan memiliki semangat untuk membantu orang-orang yang
                sakit. Setelah menyelesaikan pendidikan dasar dan menengahnya, ia melanjutkan studi di sekolah kedokteran terkemuka di
                negaranya. Ia menunjukkan dedikasi dan kecerdasan yang luar biasa dalam studinya, dan segera menonjol di antara
                rekan-rekannya.</p>
                <p class="text-block__desc mb-20" style="text-align: justify;">Setelah menyelesaikan pendidikan kedokteran, Dr. Alexander Bell memulai praktiknya sebagai dokter umum. Ia berkomitmen
                untuk memberikan perawatan medis yang berkualitas kepada pasien-pasiennya. Dalam praktik sehari-harinya, ia menghadapi
                berbagai kondisi medis yang beragam dan berusaha memberikan diagnosis yang akurat serta perawatan yang efektif.</p>
                <p class="text-block__desc mb-20" style="text-align: justify;">Dr. Alexander Bell juga sadar bahwa pendidikan dan pencegahan merupakan bagian penting dari perawatan kesehatan. Oleh
                karena itu, ia aktif dalam melakukan kampanye edukasi kesehatan di komunitasnya. Ia memberikan ceramah, menyediakan
                informasi kesehatan, dan bekerja sama dengan lembaga sosial untuk meningkatkan kesadaran tentang pentingnya menjaga
                kesehatan.</p>
                <p class="text-block__desc mb-20" style="text-align: justify;">Selama karirnya sebagai dokter umum, Dr. Alexander Bell terus berusaha meningkatkan pengetahuannya dengan mengikuti
                pelatihan dan seminar medis terkini. Ia mengikuti perkembangan terbaru dalam bidang kedokteran dan menerapkan
                penemuan-penemuan baru tersebut dalam prakteknya.</p>
                </div><!-- /.text-block -->
                <ul class="details-list list-unstyled mb-60">
                <li>
                    <h5 class="details__title">Spesialis</h5>
                    <div class="details__content">
                    <p class="mb-0">Umum</p>
                    </div>
                </li>
                <li>
                    <h5 class="details__title">Kondisi dan Minat Klinis</h5>
                    <div class="details__content">
                    <ul class="list-items list-items-layout2 list-unstyled mb-0">
                        <li>Pemeriksaan Fisik</li>
                        <li>Pengobatan Darurat</li>
                    </ul>
                    </div>
                </li>
                <li>
                    <h5 class="details__title">Prestasi & Penghargaan</h5>
                    <div class="details__content">
                    <p class="mb-0">"2015" Ikatan Dokter Indonesia (IDI)</p>
                    </div>
                </li>
                <li>
                    <h5 class="details__title">Pendidikan</h5>
                    <div class="details__content">
                    <p class="mb-0">"2015" Universitas UPN Veteran Jakarta - Kedokteran Umum</p>
                    </div>
                </li>
                </ul>
            </div><!-- /.col-lg-8 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>


@endsection
@section('container')
    
@endsection