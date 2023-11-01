@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Update Pengumuman
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
            <form action="/admin/pengumuman/{{ $announcement->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Judul Pengumuman</label>
                        <input type="number" name="employee_id" value="{{ auth()->user()->employee->id }}" id="linkmaps" required hidden>
                        <input type="text" placeholder="Masukkan Judul Pengumuman" value="{{ $announcement->title }}" class="form-control" name="title" id="linkmaps" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Content Pengumuman</label>
                        <textarea type="text" placeholder="Masukkan Content Pengumuman" class="form-control" name="content" id="linkmaps" required>{{ $announcement->content }}</textarea>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalconfirm">Simpan</button>
                <a href="window.history.go(-1); return false;" class="btn btn-warning" data-toggle="modal" data-target="#modalconfirm"> Batal </a>
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