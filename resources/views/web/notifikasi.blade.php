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
                                <a href="{{ url('/notifikasi') }}" class="nav__item-link active">Notifikasi<span>{{session('notification.count', 0)}}</span></a>
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
        </header>
        <!-- ========================
        Info Terkait 
        =========================== -->
        <section class="shop-grid">
            <div class="bg-img"><img src="assets/images/backgrounds/2.jpg" alt="background"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3" style="margin-top: -70px;">
                        <div class="heading text-center mb-40">
                            <h3 class="heading__title">Notifikasi</h3>
                        </div><!-- /.heading -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
                @if(session('notification'))
                @php
                $notification = session('notification');
                @endphp
                @if($notification['praktik'])
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="service-item">
                        <div class="service__content">
                            <h5 class="service__title">Saat Ini Dokter Sedang Melakukan Praktek di {{ $praktikNow->place->name }}
                                <a href="/notifikasi-remove/1" class="btn btn__secondary btn__rounded" style="float: right;">
                                    <span>Oke</span></i>
                                </a>
                            </h5>
                            <h1 class="heading__subtitle" style="margin-top: -25px;">{{ \Carbon\Carbon::parse($today)->format('l, d-m-Y') }}</h1>
                        </div><!-- /.service__content -->
                    </div><!-- /.service-item -->
                </div>
                @endif
                @if ($notification['currentNumber'])
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="service-item">
                        <div class="service__content">
                            <h5 class="service__title">Cek Antrian
                                <a href="#antrian" class="btn btn__secondary btn__rounded" data-toggle="collapse" aria-expanded="false" style="float: right;">
                                    <span>Lihat Antrian</span></i>
                                </a>
                                <br><br>
                                @if($notification['myNumber'] < $notification['currentNumber'])
                                <a href="/notifikasi-remove/2" class="btn btn__secondary btn__rounded" style="float: right;">
                                    <span>Oke</span></i>
                                </a>
                                @endif
                            </h5>
                            <h1 class="heading__subtitle" style="margin-top: -25px;">{{ \Carbon\Carbon::parse($today)->format('l, d-m-Y') }}</h1>
                            <div class="collapse multi-collapse" id="antrian">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 col-lg-6">
                                        <div class="service-item">
                                            <div class="service__icon">
                                                <i class=""></i>
                                                <i class="icon-head"></i>
                                            </div><!-- /.service__icon -->
                                            <div class="service__content">
                                                <h5 class="service__title">Antrian Saai Ini</h5>
                                                <h1 class="slide__title" style="text-align: center; font-size: 90px;">{{ $notification['currentNumber'] }}</h1>
                                            </div><!-- /.service__content -->
                                        </div><!-- /.service-item -->
                                    </div><!-- /.col-lg-4 -->
                                    <!-- service item #2 -->
                                    <div class="col-sm-12 col-md-8 col-lg-6">
                                        <div class="service-item">
                                            <div class="service__icon">
                                                <i class=""></i>
                                                <i class="icon-heart"></i>
                                            </div><!-- /.service__icon -->
                                            <div class="service__content">
                                                <h5 class="service__title">Antrian Anda</h5>
                                                <h1 class="slide__title" style="text-align: center; font-size: 90px;">{{ $notification['myNumber'] }}</h1>
                                            </div><!-- /.service__content -->
                                        </div><!-- /.service-item -->
                                    </div><!-- /.col-lg-4 -->
                                </div>
                            </div>
                        </div><!-- /.service__content -->
                        
                    </div><!-- /.service-item -->
                </div><!-- /.col-lg-4 -->
                <!-- /.col-lg-4 -->

                @endif<!-- /.col-lg-4 -->
                @endif<!-- /.col-lg-4 -->
            </div><!-- /.container -->
        </section><!-- /.shop -->

<script>
        var header = document.getElementById("collapse1");
        var btns = header.getElementsByClassName("card");
    for (var i = 0; i <btns.length; i++){
        btns[i].addEventListener("click", function (){
            var current =
            document.getElementsByClassName('active-card');
            current[0].className =
            current[0].className.replace("active-card","");
            this.className += "active-card";
        });
    };
    var cards = document.querySelectorAll(".date");

    cards.forEach(function(card) {
    card.addEventListener("click", function() {
        var currentActiveCard = document.querySelector(".active-card1");
        if (currentActiveCard) {
            currentActiveCard.classList.remove("active-card1");
        }
            this.classList.add("active-card1");
        });
    });

    </script>
@endsection
