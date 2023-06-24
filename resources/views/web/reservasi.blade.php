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
                                <a href="{{ route('contact.index') }}" class="nav__item-link">Contacts Us</a>
                            </li><!-- /.nav-item -->
                            <li class="nav__item notif">
                                <a href="{{ url('/notifikasi') }}" class="nav__item-link">Notifikasi<span>12</span></a>
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
                            <h3 class="heading__title">Reservasi</h3>
                        </div><!-- /.heading -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
                <div class="container" style="padding-right: 270px; padding-left: 270px;">
                    <div class="col-lg-12">
                        <div class="service-item">
                            <div class="service__content">
                                <h1 class="slide__title" style="text-align: center; font-size: 80px;">001</h1>
                                <h6>Harap untuk Periksa kembali data anda berikut : </h6>
                                <table class="color-dark" style="width:100%; color:black; font-family: Quicksand, sans-serif; font-size: 22px;">
                                    <tr>
                                        <td>Reservasi Code</td>
                                        <td>: 6536794</td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>: Pasien 1</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td>: 16 Maret 2000</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Hp</td>
                                        <td>: +628097637221</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>: Pria</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Dokter</td>
                                        <td>: Dr. Suhardji Sp.D. R.mN</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Perikas</td>
                                        <td>: 30 Juni 2023</td>
                                    </tr>
                                    <tr>
                                        <td>Jam Periksa</td>
                                        <td>: 21:15:00</td>
                                    </tr>
                                </table>
                            </div><!-- /.service__content -->
                            <div class="col-12 text-center" style="margin-top: -35px;">
                                <a href="#" class="btn btn__secondary btn__rounded">
                                    <span>Oke</span>
                                </a>
                                <br><br>
                            </div><!-- /.row -->
                        </div><!-- /.service-item -->
                    </div><!-- /.col-lg-4 -->
                </div>
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
