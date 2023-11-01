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
                <li class="nav__item dropdown active">
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
    
          <form action="/profile/{{ auth()->user()->patient->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row gutters-sm">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                      <div class="mt-3">
                        <h4>{{ auth()->user()->name }}</h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-8">
                  <div class="card">
                      <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" name="name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="email" class="form-control" value="{{ auth()->user()->email }}" name="email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nomor Hp</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ auth()->user()->phone }}" name="phone">
                                <input type="text" class="form-control" value="3" name="role_id" hidden>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tinggi Badan</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ auth()->user()->patient->height }}" name="height">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Berat Badan</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ auth()->user()->patient->weight }}" name="weight">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tanggal Lahir</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ auth()->user()->birth_date }}" name="birth_date">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Gender</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ auth()->user()->gender }}" name="gender">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Alamat</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" value="{{ auth()->user()->address }}" name="address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <a href="window.history.go(-1); return false;" class="btn btn-danger px-4" >Cancel</a>
                                <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection