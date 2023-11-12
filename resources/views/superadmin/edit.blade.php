@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Tambah Dokter                  
    </h1>
@endsection

@section('container')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <div id="rcorners1">
            <form action="/admin/dokter/{{ $superadmin->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Nama Dokter">Nama Dokter</label>
                        <input type="text" value="{{ $superadmin->name }}" placeholder="Masukkan Nama Dokter" class="form-control" name="name" id="namadokter" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" value="{{ $superadmin->address }}" placeholder="Masukkan Alamat" class="form-control" name="address" id="alamat" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Tanggal Lahir">Tanggal Lahir</label>
                        <input type="date" value="{{ $superadmin->birth_date->format('Y-m-d') }}" placeholder="Masukkan Tanggal Lahir" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="birth_date" id="tanggallahir" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="Gender">Gender</label>
                <select class="form-control" name="gender" required>
                    <option value="" disabled selected hidden>Pilih Gender</option>
                    <option value="Pria" {{ $superadmin->gender == 'Pria' ? 'selected' : '' }}>Pria</option>
                    <option value="Wanita" {{ $superadmin->gender == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                </select>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" value="{{ $superadmin->email }}" placeholder="Masukkan Email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Nomor Handphone">Nomor Handphone</label>
                        <input type="text" value="{{ $superadmin->phone }}" placeholder="Masukkan Nomor Handphone" class="form-control" name="phone" id="nomorhandphone" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="qualification">Spesialisasi</label>
                        <input type="text" value="{{ $superadmin->employee->qualification }}" placeholder="Masukkan Kualifikasi" class="form-control" name="qualification" id="qualification" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" placeholder="Masukkan Role" class="form-control" name="role_id" id="role_id" value="1" hidden>
                        <input type="text" value="{{ $superadmin->username }}" placeholder="Masukkan Username" class="form-control" name="username" id="username" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" placeholder="Masukkan Password" class="form-control" name="password" id="password" required>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalconfirm">Simpan</button>
                <form>
                    <input type="button" value="Batal" class="btn btn-danger" onclick="history.back()">
                   </form>
            </div>
            
            </form>
        </div>
    </div>
    
    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
            } else {
            dropdownContent.style.display = "block";
            }
        });
        }
        $(document).ready(
            function(){
                $('#sidebarcollapse').on('click',function(){
                    $('#sidebar').toggleClass('active');
                });
            }
        )
    </script>
@endsection