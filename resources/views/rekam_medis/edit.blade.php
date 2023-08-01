@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Tambah Rekam Medis                  
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
            <form action="/admin/medis/{{ $medical_record->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="namapasien">Nama Pasien</label>
                            <select class="form-control" name="patient_id" id="namapasien" required>
                                <option value="{{ $medical_record->patient->id }}">{{ $medical_record->patient->user->name }}</option>
                                @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
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
                            <input type="text" value="{{ $medical_record->diagnosis }}" placeholder="Masukkan Hasil Diagnosa" class="form-control" name="diagnosis" id="hasildiagnosa" required>
                            <input type="hidden" name="employee_id" value="1">
                            {{-- <input type="hidden" name="employee_id" value="{{ auth()->user()->id }}"> --}}
                        </div>
                    </div>
                </div><div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Hasil Tes">Hasil Tes</label>
                            <textarea type="text" placeholder="Masukkan Hasil Tes" class="form-control" name="test_result" id="hasiltes" required>{{ $medical_record->test_result }}</textarea>
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