@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Tambah Pegawai                  
    </h1>
@endsection

@section('container')
    <div class="container">
        <div id="rcorners1">
            <form action="{{ url('/tambahpegawai') }}" method="post">
                @csrf
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Nama Pegawai">Nama Pegawai</label>
                        <input type="text" placeholder="Masukkan Nama Pegawai" class="form-control" name="namapegawai" id="namapegawai" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Tanggal Lahir">Tanggal Lahir</label>
                        <input type="date" placeholder="Masukkan Tanggal Lahir" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="tanggallahir" id="tanggallahir" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="Gender">Gender</label>
                <select class="form-control">
                    <option value="" disabled selected hidden>Pilih Gender</option>
                    <option>Pria</option>
                    <option>Wanita</option>
                </select>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" placeholder="Masukkan Email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Nomor Handphone">Nomor Handphone</label>
                        <input type="number" placeholder="Masukkan Nomor Handphone" class="form-control" name="nomorhandphone" id="nomorhandphone" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="kualifikasi">Kualifikasi</label>
                        <input type="text" placeholder="Masukkan Kualifikasi" class="form-control" name="kualifikasi" id="kualifikasi" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Role">Role</label>
                        <input type="text" placeholder="Masukkan Role" class="form-control" name="role" id="role" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" placeholder="Masukkan Username" class="form-control" name="username" id="username" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="text" placeholder="Masukkan Password" class="form-control" name="password" id="password" required>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalconfirm">Simpan</button>
                <button type="reset" class="btn btn-warning" data-toggle="modal" data-target="#modalconfirm"> Batal </button>
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