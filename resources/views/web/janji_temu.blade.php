@extends('layouts.mainweb')
<style>
    .warna-biru {
        background-color: #142964;
    }

    .warna-abu {
        background-color: #d9d9d9;
    }

    .warna-biru-muda {
        background-color: #554e8c;
    }

    body {
        min-height: 100vh;
        min-height: -webkit-fill-available;
    }

    html {
        height: -webkit-fill-available;
    }

    main {
        display: flex;
        flex-wrap: nowrap;
        height: 100vh;
        height: -webkit-fill-available;
        max-height: 100vh;
        overflow-x: auto;
        overflow-y: hidden;
    }

    .b-example-divider {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
        background-color: #0b015b;
        border: solid #0b015b;
        border-width: 1px 0;
        box-shadow: inset 0 0.5em 1.5em rgba(0, 0, 0, 0.1), inset 0 0.125em 0.5em rgba(0, 0, 0, 0.15);
    }

    .bi {
        vertical-align: -0.125em;
        pointer-events: none;
        fill: currentColor;
    }

    .dropdown-toggle {
        outline: 0;
    }

    .nav-flush .nav-link {
        border-radius: 0;
    }

    .btn-toggle {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.5rem;
        font-weight: 600;
        color: rgba(0, 0, 0, 0.65);
        background-color: transparent;
        border: 0;
    }

    .btn-toggle:hover,
    .btn-toggle:focus {
        color: rgba(0, 0, 0, 0.85);
        background-color: #d2f4ea;
    }

    .btn-toggle::before {
        width: 1.25em;
        line-height: 0;
        content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
        transition: transform 0.35s ease;
        transform-origin: 0.5em 50%;
    }

    .btn-toggle[aria-expanded="true"] {
        color: rgba(0, 0, 0, 0.85);
    }

    .btn-toggle[aria-expanded="true"]::before {
        transform: rotate(90deg);
    }

    .btn-toggle-nav a {
        display: inline-flex;
        padding: 0.1875rem 0.5rem;
        margin-top: 0.125rem;
        margin-left: 1.25rem;
        text-decoration: none;
    }

    .btn-toggle-nav a:hover,
    .btn-toggle-nav a:focus {
        background-color: #d2f4ea;
    }

    .scrollarea {
        overflow-y: auto;
    }

    .fw-semibold {
        font-weight: 600;
    }

    .lh-tight {
        line-height: 1.25;
    }

    .list-wrapper {
        position: relative;
    }

    .list-item-wrapper {
        margin-top: 10px;
        position: relative;
    }

    .list-bullet {
        float: left;
        margin-right: 20px;
        background: #0b015b;
        height: 30px;
        width: 30px;
        line-height: 30px;
        border-radius: 100px;
        font-weight: 700;
        color: white;
        text-align: center;
        outline-style: solid;
    }

    .list-bullet2 {
        float: left;
        margin-right: 20px;
        background: #fff;
        height: 30px;
        width: 30px;
        line-height: 30px;
        border-radius: 100px;
        font-weight: 700;
        color: #0b015b;
        text-align: center;
        outline-style: solid;
    }

    .list-item {
        display: table-row;
        vertical-align: middle;
    }

    .list-title {
        font-weight: 700;
    }

    .list-text {
        font-weight: 400;
    }

    .red-line {
        background: #0b015b;
        z-index: -1;
        width: 1px;
        height: 100%;
        position: absolute;
        left: 15px;
    }

    .white-line {
        background: #fff;
        z-index: -1;
        top: 0px;
        width: 1px;
        height: 100%;
        position: absolute;
        left: 15px;


    }

    .active-card {
        outline: solid rgb(22, 44, 142) 1.5px;
    }

    .active-card1 {
        outline: solid rgb(22, 44, 142) 1.5px;
    }

</style>
<style>
    .list-items-layout3 li:before {
        color: #ffffff;
        border-color: #3f6d6a;
        background-color: #547d7a;
    }

</style>

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
                    <a href="{{ route('jadwal.index') }}" class="nav__item-link active">Layanan</a>
                </li><!-- /.nav-item -->
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

</header>
<div class="about-layout4 pb-0 ">
    <div class="row ">
        {{-- Sidebar --}}
        {{-- <div class="col-md-2 bg-dark">
            <div class="mt-4 py-5 px-4 text-center">
                <img src="https://i.ibb.co/3yYMBtB/profil.png" alt="">
                <h5 class="text-white py-2">dr. Alexander Bell</h5>
                <p class="text-white">Dokter Spesialis Umum</p>
                <div class="about__Text mt-5">
                    <p class="mb-30">
                        <a href="" class="mt-5 text-white">Kondisi & Minat Klinis</a>
                        <a href="" class="mt-5 text-white">Kondisi & Minat Klinis</a>
                        <a href="" class="mt-5 text-white">Kondisi & Minat Klinis</a>
                        <a href="" class="mt-5 text-white">Kondisi & Minat Klinis</a>
                    </p>
                </div>
            </div>
        </div> --}}
        {{-- End of Sidebar --}}
        {{-- sebelah sidebar --}}
        <div class="col-md-2">
            <div class="px-5 py-5">
                <ul class="package__list list-items list-items-layout2 list-unstyled">
                    <li>
                        <h6>Alur Jadwal</h6>
                    </li>
                </ul>
                <ul class=" list-items list-items-layout3 list-unstyled">
                    <li>
                        <h6>Konfirmasi Data</h6>
                    </li>
                    <li>
                        <h6>Bukti Pembayaran</h6>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 px-5 py-5">
            <h5>
                Pilih tanggal dan waktu kunjungan
            </h5>
            <form action="/confirm" method="get">
                <div id="mycard" class="dates" >
                    <div class="row">
                    @foreach($schedules as $schedule)
                    <div class="col-md-3">
                        <a href="#">
                            <div class="card date">
                                <input class="form-check-input schedule_date" type="radio" name="schedule_date" id="schedule_date{{ $schedule->id }}" value="{{ $schedule->schedule_date}}">
                                <div class="card-body active-card1 form-check">
                                        <small class="card-title">{{ \Carbon\Carbon::parse($schedule->schedule_date)->format('l')}}</small><br>
                                        <small class="card-subtitle text-muted">
                                            {{\Carbon\Carbon::parse($schedule->schedule_date)->format('d-m-Y')}}
                                        </small>
                                    </div>
                                </div>
                            </a>
                    </div>
                    @endforeach
                </div>
            </div>
            
        
            <div class="row">
    <div class="py-5 mt-5">
        <h5>Pilih Waktu</h5>
        <div id="accordion">
            <div class="accordion-item">
                <div class="accordion__header" data-toggle="collapse" data-target="#collapse1">
                    <a class="accordion__title" href="#">Waktu</a>
                </div>
                <div id="collapse1" class="collapse show" data-parent="#accordion">
                    <div class="accordion__body" id="schedule_time">
                        {{-- Example time slots --}}
                        {{-- <div class="row">
                            <div class="col-md-3">
                                <a href="#">
                                    <input class="form-check-input" type="radio" name="schedule_date" id="schedule_date{{ $schedule->id }}" value="{{ $schedule->schedule_date }}">
                                    <label for="schedule_date{{ $schedule->id }}">
                                        <div class="card active-card">
                                            <div class="card-body">
                                                <p class="card-title">08.00</p>
                                            </div>
                                        </div>
                                    </label>
                                </a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            
            <button class="btn btn-primary mt-3 text-end">Lanjutkan</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".schedule_date").on('change', function() {
            var selectedScheduleId = $(this).val();
            if(selectedScheduleId){
            $.ajax({
                type:'GET',
                data : {"_token":"{{ csrf_token() }}"},
                url: '/getTime/' + selectedScheduleId,
                dataType: "json",
            success:function(data) {
                console.log("success");
                document.getElementById('schedule_time').innerHTML = data;
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }
    });
});
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
