@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Tambah Pengumuman
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
            <form action="/admin/pengumuman" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="fotopengumuman">Foto Pengumuman</label>&nbsp;
                <input type="file" placeholder="Masukkan Foto Pengumuman" class="form-control" name="image" id="fotopasien">
            </div>
        </div>
    </div>
                <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Judul Pengumuman</label>
                        <input type="text" placeholder="Masukkan Judul Pengumuman" class="form-control" name="title" id="linkmaps" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Content Pengumuman</label>
                        <textarea type="text" placeholder="Masukkan Content Pengumuman" class="form-control" name="content" id="linkmaps" required></textarea>
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