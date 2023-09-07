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
            <form action="/admin/medis" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="namapasien">Nama Pasien</label>
                            <select class="form-control" name="patient_id" id="namapasien" required>
                                @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="icd_code">ICD</label>
                    <select class="form-control select2" name="icd_code" id="icd_code"></select>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="files">Files</label>
                            <input class="form-control" type="file" name="files[]" id="files" multiple>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="action">Tindakan</label>
                            <input class="form-control" type="text" name="action" id="action" placeholder="Masukkan Tindakan" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Hasil Tes">Keterangan</label>
                            <textarea type="text" placeholder="Masukkan Keterangan" class="form-control" name="desc" id="hasiltes"></textarea>
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
		// $("#icd_code").select2();
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;
        
        $('#icd_code').select2({
            ajax: {
                url: '/getIcd',
                type: 'GET',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                cache: true
            },
            placeholder: 'Select an ICD',
            minimumInputLength: 1
        }); 

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