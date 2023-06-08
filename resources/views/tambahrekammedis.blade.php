@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Tambah Rekam Medis                  
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
                        <label for="Nama Pasien">Nama Pasien</label>
                        <input type="text" placeholder="Masukkan Nama Pasien" class="form-control" name="namapasien" id="namapasien" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Tanggal Lahir">Tanggal Lahir</label>
                        <input type="date" placeholder="Masukkan Tanggal Lahir" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="tanggallahir" id="tanggallahir" required>
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
                        <label for="Hasil Diagnosa">Hasil Diagnosa</label>
                        <input type="text" placeholder="Masukkan Hasil Diagnosa" class="form-control" name="hasildiagnosa" id="hasildiagnosa" required>
                    </div>
                </div>
            </div><div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Hasil Tes">Hasil Tes</label>
                        <input type="text" placeholder="Masukkan Hasil Tes" class="form-control" name="hasiltes" id="hasiltes" required>
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