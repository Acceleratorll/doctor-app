@extends('layouts.mainweb')

@section('content')

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
                    <a href="{{ route('pengumuman.index') }}" class="nav__item-link">Pengumuman</a>
                </li><!-- /.nav-item -->
                <li class="nav__item">
                    <a href="{{ route('contact.index') }}" class="nav__item-link">Contacts Us</a>
                </li><!-- /.nav-item -->
                <li class="nav__item notif">
                    <a href="{{ url('/notifikasi') }}" class="nav__item-link">Notifikasi<span>{{session('notification.count', 0)}}</span></a>
                </li><!-- /.nav-item -->
                @if(auth()->user())
                <li class="nav__item dropdown active">
                                <a class="nav__item-link dropdown-toggle" href="#" role="button" id="profileDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="Profile Picture" class="nav-profile__image">
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
<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ asset('storage/'.auth()->user()->image) }}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{ auth()->user()->name }}</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nama</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ auth()->user()->name }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ auth()->user()->email }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nomor Hp</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ auth()->user()->phone }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Tinggi Badan</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ auth()->user()->patient->height }} cm
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Berat Badan</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ auth()->user()->patient->weight }} kg
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Tanggal Lahir</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ date('d F Y', strtotime(auth()->user()->birth_date)) }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ auth()->user()->gender }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Alamat</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ auth()->user()->address }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <a class="btn btn-info" target="__blank" href="/profile/{{ auth()->user()->patient->id }}/edit">Edit</a>
                    </div>
                      @if(auth()->user()->patient->access_code == null)
                    <div class="col-sm-6">
                      <a class="btn btn-danger" target="__blank" href="{{ route('code.create') }}">Set PIN</a>
                    </div>
                    @else
                    <div class="col-sm-6">
                      <a class="btn btn-primary" target="__blank" href="/code/{{ auth()->user()->patient->id }}/edit">Edit PIN</a>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">List</i>Rekam Medis</h6>
                      @if(auth()->user()->patient->access_code != null)
                      @if($records->count() > 0)
                      <div id="medical-records-container">
                        @if($data != null)
                        @foreach($data as $dataItem)
                        <small>Periksa pada tanggal {{ date('d F Y', strtotime($dataItem->updated_at)) }}</small><br>
                        <strong>{{ $dataItem->desc }}</strong><br><br>
                        <button type="button" class="btn btn-sm btn-primary" onclick="location.href='/download/{{ $dataItem->id }}'">
                          <i class="fa fa-edit"></i>
                          Download
                        </button>
                        @endforeach
                        @else
                        <a class="btn btn-info" target="__blank" href="{{ route('code.index') }}" name="btn-code">Lihat Hasil Periksa</a>
                        @endif
                      </div>
                      @else
                      <strong>Tidak ada Data Rekam Medis</strong><br><br>
                      @endif
                      @else
                      <strong>Penting ! <br>Dimohon untuk membuat PIN terlebih dahulu</strong><br><br>
                      <a class="btn btn-danger" target="__blank" href="{{ route('code.create') }}">Set PIN Here !</a>
                      @endif
                    </div>
                </div>
                </div>
                <div class="col-sm-6 mb-3 mx-auto">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center">
                      <h6><i class="material-icons text-info mr-2">List</i>Reservasi</h6>
                      @if($reservation->count() > 0)
                      @foreach($reservation as $reservationItem)
                      <p>Nomor Urut</p><h5>{{ $reservationItem->nomor_urut }}</h5>
                      <small>Tanggal <b>{{ date('d F Y', strtotime($reservationItem->schedule->schedule_date)) }}</b></small><br>
                      <small>Jam Periksa Dimulai <b>{{ date('H:i', strtotime($reservationItem->schedule->schedule_time)) }}</b></small><br><br>
                      @if($reservationItem->approve == 0)
                      <p class="text-center"><b>Status :</b> <strong>Menunggu Konfirmasi</strong></p><br>
                      @else
                      <p class="text-center"><b>Status :</b> <strong>Sudah di Konfirmasi</strong></p><br>
                      @endif
                      <a href="cancel/{{ $reservationItem->id }}" class="btn btn-danger">Batalkan Pesanan</a><br>
                      @endforeach
                      @else
                      <strong>Anda belum melakukan reservasi</strong><br><br>
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
    </div>
@endsection