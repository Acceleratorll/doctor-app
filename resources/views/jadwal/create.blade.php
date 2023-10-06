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
            <form action="/admin/jadwal" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <select name="place_id" id="tempat" class="form-control">
                            @if($places->count() < 1)
                            <option>Tidak ada Tempat</option>
                            @else
                            @foreach($places as $place)
                            <option value="{{ $place->id }}">{{ $place->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Tanggal">Tanggal</label>
                        <input type="number" name="employee_id" value="{{ auth()->user()->employee->id }}" id="linkmaps" required hidden>
                        <input type="date" placeholder="Masukkan Tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="schedule_date" id="linkmaps" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Jam">Jam Mulai</label>
                        <input type="time" placeholder="Masukkan Jam Mulai" class="form-control" name="schedule_time" id="jam" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Jam">Jam Berakhir</label>
                        <input type="time" placeholder="Masukkan Jam Berakhir" class="form-control" name="schedule_time_end" id="jam" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Jam">Kuota</label>
                        <input type="number" placeholder="Masukkan Banyak Kuota" class="form-control" name="qty" id="qty" required>
                    </div>
                </div>
            </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalconfirm">Simpan</button>
                <a href="javascript:history.go(-1)" class="btn btn-warning" data-toggle="modal" data-target="#modalconfirm"> Batal </a>
            </div>
            </form>
        </div>
    </div>
    
    <script>
        $("#tempat").select2();
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