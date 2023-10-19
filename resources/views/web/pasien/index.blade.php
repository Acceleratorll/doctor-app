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
                      <button class="btn btn-danger" onclick="setPin()">Set PIN</button>
                    </div>
                    @else
                    <div class="col-sm-6">
                      <button class="btn btn-primary" onclick="editPin()">Edit PIN</button>
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
                        @foreach($records as $record)
                        <p>Periksa pada tanggal <strong>{{ date('d F Y', strtotime($record->medical_record->updated_at)) }}</strong></p>
                        <small>Dokter : <strong>{{ $record->schedule->employee->user->name }} [{{ $record->schedule->employee->qualification }}]</strong></small><br>
                        <small>Fisik : <strong>{{ $record->medical_record->physical_exam }}</strong></small><br>
                        <small>Anjuran : <strong>{{ $record->medical_record->recommendation }}</strong></small><br>
                        <small>Tindakan : <strong>{{ $record->medical_record->action }}</strong></small><br>
                        <small>Keluhan : <strong>{{ $record->medical_record->complaint }}</strong></small><br>
                        <small>Diagnosa : <strong>{{ $record->medical_record->diagnosis }}</strong></small><br>
                        @if($record->medical_record->icd)
                        <small>ICD : <strong>{{ $record->medical_record->icd->name_id }}</strong></small><br>
                        @endif
                        <strong>{{ $record->medical_record->desc ?? '' }}</strong><br>
                        {{-- <a href="" id="details"><i class="fa fa-info"></i>More Details</a> --}}
                        @if($record->files)
                        <button type="button" class="btn btn-sm btn-success" onclick="location.href='/download/{{ $record->medical_record_id }}'">
                          <i class="fa fa-download"></i>
                          Download
                        </button>
                        @endif
                        <br>
                        <div class="divider"></div>
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
                      {{-- <a class="btn btn-danger" target="__blank" href="{{ route('code.create') }}">Set PIN Here !</a> --}}
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

@push('js')
    <script>
        function editPin() {
            Swal.fire({
              title: 'Edit PIN',
              html: `
              <div class="row">
            <div class="col-md-4">
                <label for="currentPin">Current PIN</label>
            </div>
            <div class="col-md-6">
                <input type="password" id="currentPin" class="swal2-input" maxlength="4" style="text-security: disc;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="newPin">New PIN</label>
            </div>
            <div class="col-md-6">
                <input type="password" id="newPin" class="swal2-input" maxlength="4" style="text-security: disc;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="confirmPin">Confirm PIN</label>
            </div>
            <div class="col-md-6">
                <input type="password" id="confirmPin" class="swal2-input" maxlength="4" style="text-security: disc;">
            </div>
        </div>
              `,
              showCancelButton: true,
              confirmButtonText: 'Submit',
              cancelButtonText: 'Cancel',
              preConfirm: () => {
                  const currentPin = document.getElementById('currentPin').value;
                  const newPin = document.getElementById('newPin').value;
                  const confirmPin = document.getElementById('confirmPin').value;
          
                  // Add your validation logic here
                  if (!/^\d+$/.test(currentPin) || !/^\d+$/.test(newPin) || !/^\d+$/.test(confirmPin)) {
                      Swal.showValidationMessage('Please enter only numbers.');
                      return false;
                  }
          
                  if (newPin !== confirmPin) {
                      Swal.showValidationMessage('New PINs do not match.');
                      return false;
                  }
          
                  return { currentPin, newPin, confirmPin };
              },
          }).then((result) => {
              if (result.isConfirmed) {
                  const { currentPin, newPin, confirmPin } = result.value;
                  $.ajax({
                    url: '{{ route("code.update", ["code", ":code"]) }}'.replace(':code', newPin),
                    type: 'POST',
                    data: {
                      access_code: currentPin,
                      access_code_new: newPin,
                      _method: 'PUT',
                      _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                      Swal.fire({
                        icon: 'success',
                        title: 'PIN Registered!',
                        timer: 1700,
                        timerProgressBar: true,
                        showConfirmButton: false,
                      });
                    },
                    error: function(error){
                      Swal.fire({
                        icon: 'error',
                        title: 'PIN Salah!',
                        timer: 1700,
                        timerProgressBar: true,
                        showConfirmButton: false,
                      });
                    }
                  });
                }
              });
            }
                
        function setPin() {
            Swal.fire({
              title: 'Register PIN (Max: 4 Digit)',
              input: 'password',
              inputLabel: 'Set PIN',
              inputPlaceholder: 'Enter your PIN',
              inputAttributes: {
                  maxlength: 4,
                  autocapitalize: 'off',
                  autocorrect: 'off',
              },
              showCancelButton: true,
              confirmButtonText: 'Submit',
              cancelButtonText: 'Cancel',
              inputValidator: (value) => {
                  if (!/^\d+$/.test(value)) {
                      return 'Please enter only numbers.';
                  }
              },
          }).then((result) => {
              if (result.isConfirmed) {
                  const pin = result.value;
                  registerPin(pin);
              }
          });
        }
              
        function registerPin(pin)
        {
          $.ajax({
            type: 'POST',
            url: '{{ route("save.code") }}',
            data: {
              access_code: pin,
              _token: '{{ csrf_token() }}',
              _method: 'PUT',
            },
            success: function(data) {
              Swal.fire({
                icon: 'success',
                title: 'PIN Registered!',
                timer: 1700,
                timerProgressBar: true,
                showConfirmButton: false,
              });
              location.reload();
            }
          });
        }
            
      </script>
      @endpush