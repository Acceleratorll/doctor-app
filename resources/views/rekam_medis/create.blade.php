@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Tambah Rekam Medis                  
    </h1>
@endsection

@section('container')
    <div class="container">
        <div id="rcorners1">
            <form action="/medis" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="namapasien">Nama Pasien</label>
                            <select class="form-control" name="patient_id" id="namapasien" required>
                                @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Tanggal Lahir">Tanggal Lahir</label>
                            <input type="date" placeholder="Masukkan Tanggal Lahir" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="birth_date" id="tanggallahir" required>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="form-group">
                    <label for="Gender">Gender</label>
                    <select class="form-control">
                        <option value="" disabled selected hidden>Pilih Gender</option>
                        <option>Pria</option>
                        <option>Wanita</option>
                    </select>
                </div> --}}
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Hasil Diagnosa">Hasil Diagnosa</label>
                            <input type="text" placeholder="Masukkan Hasil Diagnosa" class="form-control" name="diagnosis" id="hasildiagnosa" required>
                            <input type="hidden" name="employee_id" value="1">
                            {{-- <input type="hidden" name="employee_id" value="{{ auth()->user()->id }}"> --}}
                        </div>
                    </div>
                </div><div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Hasil Tes">Hasil Tes</label>
                            <textarea type="text" placeholder="Masukkan Hasil Tes" class="form-control" name="test_result" id="hasiltes" required></textarea>
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
		$("#namapasien").select2();
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