@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Update Tempat Praktik                  
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
            <form action="/admin/tempat/{{ $place->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="fotopasien">Foto Tempat</label>&nbsp;
                <img src="{{ asset('storage/'.$place->image) }}" alt="Photo Tempat Praktik" width="100">
                <br>
                <input type="file" placeholder="Masukkan Foto Tempat Praktik" class="form-control" name="image" id="fototempat">
            </div>
        </div>
    </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Nama Tempat</label>
                        <input type="number" name="employee_id" value="{{ auth()->user()->employee->id }}" id="linkmaps" required hidden>
                        <input type="text" value="{{ $place->name }}" placeholder="Masukkan Nama Tempat Praktik" class="form-control" name="name" id="linkmaps" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="address">Alamat Tempat</label>
                        <input type="text" value="{{ $place->address }}" placeholder="Masukkan Alamat Tempat Praktik" class="form-control" name="address" id="address" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="reservationable">Bisa Reservasi ?</label>
                        <select name="reservationable" id="reservationable">
                            @if($place->reservationable == 0)
                            <option value="{{ $place->reservationable }}" selected>Bisa</option>
                            <option value="0">Tidak Bisa</option>
                            @else
                            <option value="{{ $place->reservationable }}" selected>Tidak Bisa</option>
                            <option value="1">Bisa</option>
                            @endif
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