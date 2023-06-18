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
        Services Layout 1
        =========================== -->
    <section class="services-layout1 pt-130">
        <div class="bg-img"><img src="assets/images/backgrounds/2.jpg" alt="background"></div>
        <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-60">
                <h3 class="heading__title">List Jadwal Klinik Umum</h3>
                <h2 class="heading__subtitle" style="margin-top: -10px;">Temukan jadwal Praktek Klinik Umum yang paling sesuai denganmu!</h2>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <div class="row">
            <!-- service item #1 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i ></i>
                    <i class="icon-head"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Senin, 19 Juni</h5>
                    <h5 class="service__title">08.00 WIB</h5>
                    <br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            <!-- service item #2 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i ></i>
                    <i class="icon-heart"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Senin, 19 Juni</h5>
                    <h5 class="service__title">10.00 WIB</h5>
                    <br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            <!-- service item #3 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i ></i>
                    <i class="icon-microscope"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Senin, 19 Juni</h5>
                    <h5 class="service__title">14.00 WIB</h5>
                    <br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            <!-- service item #4 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i ></i>
                    <i class="icon-microscope"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Selasa, 20 Juni</h5>
                    <h5 class="service__title">16.00 WIB</h5>
                    <br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            <!-- service item #1 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i ></i>
                    <i class="icon-head"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Rabu, 21 Juni</h5>
                    <h5 class="service__title">09.00 WIB</h5>
                    <br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            <!-- service item #2 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i ></i>
                    <i class="icon-heart"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Rabu, 21 Juni</h5>
                    <h5 class="service__title">15.00 WIB</h5>
                    <br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            <!-- service item #3 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i ></i>
                    <i class="icon-microscope"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Kamis, 22 Juni</h5>
                    <h5 class="service__title">08.00 WIB</h5>
                    <br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            <!-- service item #2 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i ></i>
                    <i class="icon-heart"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Kamis, 22 Juni</h5>
                    <h5 class="service__title">11.00 WIB</h5>
                    <br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            <!-- service item #4 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i ></i>
                    <i class="icon-microscope"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Kamis, 22 Juni</h5>
                    <h5 class="service__title">14.00 WIB</h5>
                    <br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.Services Layout 1 -->

@endsection

@section('container')
    
@endsection