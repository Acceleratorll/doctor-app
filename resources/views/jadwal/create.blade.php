@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Tambah Jadwal                  
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
            <form action="/admin/jadwal" method="post">
                @csrf
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Nama Dokter">Nama Dokter</label>
                        <input type="text" placeholder="Masukkan Nama Dokter" value="{{ $doctor->name }}" class="form-control" name="nama_dokter" id="namadokter" readonly>
                        <input type="hidden" name="employee_id" value="{{ $doctor->id }}">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Tanggal">Tanggal</label>
                        <input type="date" placeholder="Masukkan Tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="schedule_date" id="linkmaps" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Jam">Jam</label>
                        <input type="time" placeholder="Masukkan Jam" class="form-control" name="schedule_time" id="jam" required>
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