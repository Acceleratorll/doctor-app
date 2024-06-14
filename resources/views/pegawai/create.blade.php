@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Tambah Pegawai                  
    </h1>
@endsection

@section('container')
    <div class="container">
        <div id="rcorners1">
            <form action="/admin/pegawai" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Nama Pegawai">Nama Pegawai</label>
                        <input type="text" placeholder="Masukkan Nama Pegawai" class="form-control" name="name" id="namapegawai" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" placeholder="Masukkan Alamat" class="form-control" name="address" id="alamat" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Tanggal Lahir">Tanggal Lahir</label>
                        <input type="date" placeholder="Masukkan Tanggal Lahir" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="birth_date" id="tanggallahir" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="Gender">Gender</label>
                <select class="form-control" name="gender">
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
                        <input type="number" placeholder="Masukkan Nomor Handphone" class="form-control" name="phone" id="nomorhandphone" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="kualifikasi">Spesialisasi</label>
                        <input type="text" placeholder="Masukkan Kualifikasi" class="form-control" name="qualification" id="kualifikasi" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Role">Role</label>
                        <select name="role[]" id="role" class="form-control select-custom" multiple>
                            <option value="" disabled>Pilih Role</option>
                            <option value="pegawai">Pegawai</option>
                            <option value="dokter_umum">Dokter Umum</option>
                            <option value="dokter_gigi">Dokter Gigi</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="hidden" placeholder="Masukkan Role" class="form-control" name="role_id" id="role_id" value="2" hidden>
                        <input type="text" placeholder="Masukkan Username" class="form-control" name="username" id="username" required>
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

        function showSweetAlert(type, message) {
            Swal.fire({
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 2000 // Change this value to adjust the display time
            });
        }

        $(document).ready(
            function(){
                @if ($message = Session::get('success'))
                showSweetAlert('success', '{{ $message }}');
                @elseif ($message = Session::get('error'))
                showSweetAlert('error', '{{ $message }}');
                @endif

                @if ($errors->any())
                    var errorMessages = '';
                    @foreach ($errors->all() as $error)
                        errorMessages += '{{ $error }}<br>';
                    @endforeach
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMessages,
                        showConfirmButton: true
                    });
                @endif

                $('#sidebarcollapse').on('click',function(){
                    $('#sidebar').toggleClass('active');
                });

                $('.select-custom').select2({
                    closeOnSelect: false,
                    placeholder: "choose role",
                    allowClear: true
                });
            }
        )
    </script>
@endsection