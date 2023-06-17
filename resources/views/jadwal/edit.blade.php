@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Edit Jadwal                  
    </h1>
@endsection

@section('container')
    <div class="container">
        <div id="rcorners1">
           <form action="/admin/jadwal/{{ $schedule->id }}" method="POST">
            @csrf
            @method('PUT')
            {{-- <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Nama Dokter">Nama Dokter</label>
                        <input type="text" placeholder="Masukkan Nama Dokter" class="form-control" value="{{ $schedule->employee->user->name }}" name="namadokter" id="namadokter" readonly>
                        <input type="number" class="form-control" value="{{ auth()->user()->id }}" name="employee_id" hidden>
                    </div>
                </div>
            </div> --}}
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Tanggal">Tanggal</label>
                        <input type="date" placeholder="Masukkan Tanggal" class="form-control" value="{{ $schedule->schedule_date }}" name="schedule_date" id="linkmaps" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Jam">Jam</label>
                        <input type="time" placeholder="Masukkan Jam" class="form-control" value="{{ $schedule->schedule_time }}" name="schedule_time" id="jam" required>
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