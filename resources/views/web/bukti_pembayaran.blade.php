@extends('layouts.mainweb')

@section('content')

<style>
    .image-preview {
        margin-bottom: 20px;
    }

    .image-preview img {
        max-height: 120px;
        max-width: 100px;
    }
</style>

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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        {{ $message }}
    </div>
    @elseif($message =  Session::get('error'))
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @endif
    <div class="row ">
        <div class="col-md-2">
            <div class="px-5 py-5">
                <ul class=" list-items list-items-layout3 list-unstyled">
                    <li>
                        <h6>Alur Jadwal</h6>
                    </li>
                    <li>
                        <h6>Konfirmasi Data</h6>
                    </li>
                </ul>
                <ul class="package__list list-items list-items-layout2 list-unstyled">
                    <li>
                        <h6>Bukti Pembayaran</h6>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row" style="margin-top: 50px">
            <div class="form-container">
                <form id="default-form" action="{{ route('reservasi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="-col-md-4">
                            <div class="file-input">
                                <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
                                <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran" accept=".jpg, .jpeg, .png, .pdf" required>
                                <small class="text-muted">Maximum file size: <b>*2MB</b></small>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="image-preview">
                                <img id="preview-image" src="">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="schedule_date" value="{{ $request->schedule_date }}">
                    <input type="hidden" name="schedule_time" value="{{ $request->schedule_time }}">
                    <input type="hidden" name="nomor_urut" value="{{ $request->nomor_urut }}">
                    <input type="hidden" name="reservation_code" value="{{ $request->reservation_code }}">
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" id="kembali-btn">Kembali</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <form id="alternative-form" action="{{ route('reservasi.store') }}" method="post" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <div class="row" style="margin-bottom: 20px">
                        <div class="-col-md-4">
                            <div class="file-input">
                                <label for="ktp">Upload KTP</label>
                                <input type="file" class="form-control" name="ktp" id="ktp" accept=".jpg, .jpeg, .png" required>
                                <small class="text-muted">Maximum file size: <b>*2MB</b></small>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="image-preview">
                                <img id="ktp-image" src="">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px">
                        <div class="-col-md-4">
                            <div class="file-input">
                                <label for="surat_rujukan">Upload Surat Rujukan</label>
                                <input type="file" class="form-control" name="surat_rujukan" id="surat_rujukan" accept=".jpg, .jpeg, .png" required>
                                <small class="text-muted">Maximum file size: <b>*2MB</b></small>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="image-preview">
                                <img id="surat-image" src="">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px">
                        <div class="-col-md-4">
                            <div class="file-input">
                                <label for="bpjs_card">Upload Kartu BPJS</label>
                                <input type="file" class="form-control" name="bpjs_card" id="bpjs_card" accept=".jpg, .jpeg, .png" required>
                                <small class="text-muted">Maximum file size: <b>*2MB</b></small>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                                <div class="image-preview">
                                    <img id="bpjs-image" src="">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="schedule_date" value="{{ $request->schedule_date }}">
                        <input type="hidden" name="schedule_time" value="{{ $request->schedule_time }}">
                        <input type="hidden" name="nomor_urut" value="{{ $request->nomor_urut }}">
                        <input type="hidden" name="reservation_code" value="{{ $request->reservation_code }}">
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary" id="kembali-btn">Kembali</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <!-- Dropdown to select form option -->
            </div>
        </div>
        <div class="row" style="margin-top: 50px; margin-left: 50px">
            <div class="-col-md-12 justify-content-end">
                <select id="bpjs" name="bpjs" class="form-control">
                    <option value="0">Bayar</option>
                    <option value="1">BPJS</option>
                </select>
            </div>
        </div><br><br>
    </div>
</div>

<script>
    var bpjs = document.getElementById('bpjs');
    var defaultForm = document.getElementById('default-form');
    var alternativeForm = document.getElementById('alternative-form');
    
    bpjs.addEventListener('change', function() {
        var selectedOption = this.value;
        if (selectedOption == '1') {
            defaultForm.style.display = 'none';
            alternativeForm.style.display = 'block';
        }else{
            defaultForm.style.display = 'block';
            alternativeForm.style.display = 'none';
        }
    });

    var previewImage = document.getElementById('preview-image');
    var ktpImage = document.getElementById('ktp-image');
    var suratImage = document.getElementById('surat-image');
    var bpjsImage = document.getElementById('bpjs-image');

    document.getElementById('ktp').addEventListener('change', function(e) {
        var uploadedImage = e.target.files[0];
        ktpImage.src = URL.createObjectURL(uploadedImage);
        ktpImage.style.display = 'block';
    })

    document.getElementById('surat_rujukan').addEventListener('change', function(e) {
        var uploadedImage = e.target.files[0];
        suratImage.src = URL.createObjectURL(uploadedImage);
        suratImage.style.display = 'block';
    })

    document.getElementById('bpjs_card').addEventListener('change', function(e) {
        var uploadedImage = e.target.files[0];
        bpjsImage.src = URL.createObjectURL(uploadedImage);
        bpjsImage.style.display = 'block';
    })

    document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
        var uploadedImage = e.target.files[0];
        previewImage.src = URL.createObjectURL(uploadedImage);
        previewImage.style.display = 'block';
    });

    document.getElementById('kembali-btn').addEventListener('click', function() {
        window.window.history.go(-1); return false;;
    });
</script>

@endsection