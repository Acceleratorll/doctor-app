@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Tambah Tempat Praktik                  
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
            <form action="/admin/tempat" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="number" name="employee_id" value="{{ auth()->user()->employee->id }}" id="linkmaps" required hidden>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Nama Tempat</label>
                        <input type="text" placeholder="Masukkan Nama Tempat Praktik" class="form-control" name="name" id="linkmaps" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="address">Alamat Tempat</label>
                        <input type="text" placeholder="Masukkan Alamat Tempat Praktik" class="form-control" name="address" id="address" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="reservationable">Bisa Reservasi ?</label>
                        <select name="reservationable" id="reservationable">
                            <option value="1">Bisa</option>
                            <option value="0">Tidak Bisa</option>
                        </select>
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