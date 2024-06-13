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
                                <small>* Format: 1999-06-31 (tahun-bulan-hari)</small>
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
                                <button onclick="history.back()" class="btn btn-danger px-4" >Cancel</button>
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

@section('js')
<script>
    function showSweetAlert(type, message) {
            Swal.fire({
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 2000
            });
        }

        $(document).ready( function () {
            @if ($message = Session::get('success'))
                showSweetAlert('success', '{{ $message }}');
            @elseif ($message = Session::get('error'))
                showSweetAlert('error', '{{ $message }}');
            @endif
        });
</script>
    
@endsection