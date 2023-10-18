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
                    <a href="{{ route('contact.index') }}" class="nav__item-link active">Contacts Us</a>
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

        <!-- ========================= 
                Google Map
        =========================  -->
        <section class="google-map py-0">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.796192767221!2d112.74602877396802!3d-7.264020471368298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f96302ba673b%3A0xa2443b1f043b2251!2sJl.%20Slamet%20Surabaya%2C%20Embong%20Kaliasin%2C%20Kec.%20Genteng%2C%20Surabaya%2C%20Jawa%20Timur%2060271!5e0!3m2!1sid!2sid!4v1686437217710!5m2!1sid!2sid"
            frameborder="0" height="500" width="100%" 
            ></iframe>
        </section><!-- /.GoogleMap -->

        <!-- ==========================
            contact layout 1
        =========================== -->
        <section class="contact-layout1 pt-0 mt--100">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <div class="contact-panel d-flex flex-wrap">
                <form class="contact-panel__form" method="post" action="assets/php/contact.php" id="contactForm">
                    <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                        <div class="heading-layout2">
                            <h3 class="heading__title">Kisah Inspirasi!</h3>
                        </div>
                        <div class="testimonial-item">
                            <h5 class="testimonial__title">“Dokter Alex termasuk praktisi berkualifikasi tinggi yang berasal dari berbagai latar belakang dan membawa keragaman
                            keterampilan dan minat khusus. Dr. Alex juga memiliki perawat terdaftar pada staf yang tersedia untuk melakukan triase
                            setiap masalah mendesak, dan staf administrasi dan pendukung semuanya memiliki keterampilan orang yang luar biasa”
                            </h5>
                        </div>
                        </div>
                    </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                </form>
                <div
                    class="contact-panel__info d-flex flex-column justify-content-between bg-overlay bg-overlay-primary-gradient">
                    <div class="bg-img"><img src="assets/images/banners/1.jpg" alt="banner"></div>
                    <div>
                    <h4 class="contact-panel__title color-white">Contacts</h4>
                    <p class="contact-panel__desc font-weight-bold color-white mb-30">Jangan ragu untuk menghubungi staf kami yang ramah dengan pertanyaan medis apa pun.
                    </p>
                    </div>
                    <div>
                    <ul class="contact__list list-unstyled mb-30">
                        <li>
                        <i class="icon-phone"></i><a href="tel:+5565454117">Emergency Tlpn: {{ $doctor->phone }}</a>
                        </li>
                        <li>
                        <i class="icon-location"></i><a href="#">Location: {{ $doctor->address }}</a>
                        </li>
                        <li>
                        <i class="icon-clock"></i><a href="#">Senin - Sabtu: 8:00 - 18:00</a>
                        </li>
                    </ul>
                    <a href="https://wa.me/{{ $doctor->phone }}" class="btn btn__white btn__rounded btn__outlined">Contact Us</a>
                    </div>
                </div>
                </div>
            </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.contact layout 1 -->

@endsection
@section('container')
    
@endsection