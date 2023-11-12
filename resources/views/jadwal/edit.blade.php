@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Edit Jadwal                  
    </h1>
@endsection

@section('container')
    <div class="container">
        <div id="rcorners1">
           <form action="/admin/jadwal/{{ $schedule->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col">
                    <label for="tempat">Tempat</label>
                    <select name="place_id" id="tempat" class="form-control">
                        <option value="{{ $schedule->place_id }}">{{ $schedule->place->name }}</option>
                        @foreach($places as $place)
                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <input type="number" name="employee_id" value="{{ auth()->user()->employee->id }}" id="linkmaps" required hidden>
                        <label for="Tanggal">Tanggal</label>
                        <input type="date" placeholder="Masukkan Tanggal" class="form-control" value="{{ $schedule->schedule_date }}" name="schedule_date" id="linkmaps" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Jam">Jam</label>
                        <input type="time" placeholder="Masukkan Jam Mulai" class="form-control" value="{{ $schedule->schedule_time }}" name="schedule_time" id="jam" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Jam">Jam Berakhir</label>
                        <input type="time" placeholder="Masukkan Jam Berakhir" class="form-control" value="{{ $schedule->schedule_time_end }}" name="schedule_time_end" id="jam" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="qty">Kuota</label>
                        <input type="number" placeholder="Masukkan Kuota Reservasi" class="form-control" value="{{ $schedule->qty }}" name="qty" id="qty" required>
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