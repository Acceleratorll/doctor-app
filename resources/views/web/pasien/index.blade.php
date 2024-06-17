@extends('layouts.mainweb')

@section('content')
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
                      <a class="btn btn-info" href="/profile/{{ auth()->user()->patient->id }}/edit">Edit</a>
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
              </div><div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex justify-content-center mb-3"><i class="material-icons text-info mr-2">List</i>Rekam Medis</h6>
                      @if(auth()->user()->patient->access_code != null)
                        @if($records->count() > 0)
                        <div id="medical-records-container">
                          @if($data != null)
                            @foreach($records as $record)
                            <div class="card mb-3">
                              <div class="card-body">
                                <h5 class="card-title">Tanggal <strong>{{ date('d F Y', strtotime($record->schedule->schedule_date)) }}</strong></h5>
                                <p class="card-text">
                                  <small class="text-muted">Dokter: <strong>{{ $record->schedule->employee->user->name }} [{{ $record->schedule->employee->qualification }}]</strong></small>
                                </p>
                                <span class="float-left">
                                    <a href="/print/{{ $record->medical_record->id }}" class="btn btn-primary btn-sm custom-btn-small">Lihat Rekam Medis</a>
                                </span>
                                @if ($record->medical_record->files->count() > 0)
                                <span class="float-right">
                                    <a href="/download/{{ $record->medical_record->id }}" class="btn btn-primary btn-sm custom-btn-small">File Lainnya</a>
                                </span>
                                @endif
                              </div>
                            </div>
                            @endforeach
                          @else
                            <a class="btn btn-info" href="{{ route('code.index') }}" name="btn-code">Lihat Hasil Periksa</a>
                          @endif
                        </div>
                        @else
                        <strong>Tidak ada Data Rekam Medis</strong><br><br>
                        @endif
                      @else
                      <strong>Penting ! <br>Dimohon untuk membuat PIN terlebih dahulu</strong><br><br>
                      @endif
                    </div>
                </div>
                </div>
                <div class="col-sm-6 mb-3 mx-auto">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center">
                        <h6 class="mb-4"><i class="material-icons text-info mr-2">List</i>Reservasi</h6>
                        @if($reservation->count() > 0)
                          @foreach($reservation as $reservationItem)
                            <div class="card mb-3 w-100">
                              <div class="card-body">
                                @if($reservationItem->status == 3)
                                <h5 class="card-title text-center">Tertolak</strong></h5>
                                @else
                                <h5 class="card-title text-center">Nomor Urut: <strong>{{ $reservationItem->nomor_urut }}</strong></h5>
                                @endif
                                <p class="card-text text-center">
                                  <table class="centered-table">
                                    <tr>
                                      <td><small class="text-muted">Tanggal</small></td>
                                      <td>:</td>
                                      <td><small class="text-muted"><b>{{ date('d F Y', strtotime($reservationItem->schedule->schedule_date)) }}</b></small></td>
                                  </tr>
                                  <tr>
                                      <td><small class="text-muted">Jam Mulai</small></td>
                                      <td>:</td>
                                      <td><small class="text-muted"><b>{{ date('H:i', strtotime($reservationItem->schedule->schedule_time)) }}</b></small></td>
                                  </tr>
                                  <tr>
                                      <td><small class="text-muted">{{ $reservationItem->status == 3 ? 'Alasan' : 'Status' }}</small></td>
                                      <td>:</td>
                                      <td>
                                          @if($reservationItem->status == 3)
                                          <strong class="text-danger">{{ $reservationItem->reject_reason }}</strong>
                                          @elseif($reservationItem->status == 2)
                                          <strong class="text-primary">Telah Periksa</strong>
                                          @elseif($reservationItem->approve == 1)
                                          <strong class="text-success">Sudah di Konfirmasi</strong>
                                          @elseif($reservationItem->approve == 0)
                                          <strong class="text-warning">Menunggu Konfirmasi</strong>
                                          @endif
                                      </td>
                                  </tr>
                                  </table>
                                </p>
                                <div class="text-center">
                                  {{-- @if ($reservationItem->status !== 3)
                                    <button id="reject" data-id="{{ $reservationItem->id }}" class="reject btn btn-sm btn-danger">
                                      Batalkan Pesanan
                                    </button>
                                  @endif --}}
                                </div>
                              </div>
                            </div>
                          @endforeach
                        @else
                          <strong>Anda belum melakukan reservasi</strong>
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

@push('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
  <style>
    #medical-records-container {
      margin-top: 20px;
    }

    .card {
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-title {
      font-size: 1.25rem;
      margin-bottom: 0.75rem;
    }

    .card-text {
      margin-bottom: 1rem;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      padding: 0.5rem 1rem;
      font-size: 1rem;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .divider {
      border-top: 1px solid #e0e0e0;
      margin: 20px 0;
    }
  </style>
@endpush

@push('js')
    <script>
      $(document).ready( function () {
        @if ($message = Session::get('success'))
            showSweetAlert('success', '{{ $message }}');
            @elseif ($message = Session::get('error'))
            showSweetAlert('error', '{{ $message }}');
            @endif
      });

      // $('.reject').on('click', function(){
      //   var rejectButton = $(this);
      //   var defaultId = rejectButton.data('id');
      //   Swal.fire({
      //       title: 'Batalkan Reservasi',
      //       input: "textarea",
      //       inputLabel: "Alasan",
      //       inputPlaceholder: "Masukkan Alasan batalkan reservasi",
      //       icon: 'warning',
      //       showCancelButton: true,
      //       cancelButtonText: 'Batal',
      //   }).then((result) => {
      //       if (result.isConfirmed) {
      //           var reason = result.value; // Mengambil alasan dari input
      //           $.ajax({
      //               type: 'PUT',
      //               url: `{{ route("pasien.reservation.cancel", ["id" => ":id"]) }}`.replace(':id', defaultId),
      //               data: {
      //                   _token: '{{ csrf_token() }}',
      //                   reason: reason, // Mengirim alasan sebagai 'reason'
      //               },
      //               success: function(response) {
      //                   Swal.fire({
      //                       title: 'Success!',
      //                       text: 'Reservasi telah dibatalkan.',
      //                       icon: 'success',
      //                       timer: 2000,
      //                       showConfirmButton: false
      //                   }).then(() => {
      //                       location.reload();
      //                   });
      //               },
      //               error: function(xhr) {
      //                   Swal.fire({
      //                       title: 'Error!',
      //                       text: 'Gagal membatalkan reservasi.',
      //                       icon: 'error'
      //                   });
      //               }
      //           });
      //       }
      //   });
      // });
        
      function showSweetAlert(type, message) {
        Swal.fire({
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 2000 // Change this value to adjust the display time
        });
      }

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