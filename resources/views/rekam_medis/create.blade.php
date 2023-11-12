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
                                <option value="0" selected disabled>Pilih Pasien</option>
                                <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reservation_id">Kode Reservasi</label>
                    <select class="form-control select2" name="reservation_id" id="reservation_id" required></select>
                </div>
                <div class="form-group">
                    <label for="icd_code">ICD (Optional)</label>
                    <select class="form-control select2" name="icd_code" id="icd_code"></select>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="files">Files (Optional)</label>
                            <input class="form-control" type="file" name="files[]" id="files" multiple>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="complaint">Keluhan</label>
                            <input class="form-control" type="text" name="complaint" id="complaint" placeholder="Masukkan Keluhan" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="physical_exam">Pemeriksaan Fisik</label>
                            <input class="form-control" type="text" name="physical_exam" id="physical_exam" placeholder="Masukkan Hasil Pemeriksaan Fisik" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="diagnosis">Diagnosa</label>
                            <input class="form-control" type="text" name="diagnosis" id="diagnosis" placeholder="Masukkan Hasil Diagnosa" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="recommendation">Anjuran</label>
                            <input class="form-control" type="text" name="recommendation" id="recommendation" placeholder="Masukkan Anjuran" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="recipe">Resep</label>
                            <input class="form-control" type="text" name="recipe" id="recipe" placeholder="Masukkan Resep" required>
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
                            <label for="Hasil Tes">Keterangan (Optional)</label>
                            <textarea type="text" placeholder="Masukkan Keterangan" class="form-control" name="desc" id="hasiltes"></textarea>
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
		$("#namapasien").select2();
		$("#reservation_id").select2();
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

		$("#namapasien").change(function () {
            var selectedUserId = $(this).val();
            $.ajax({
                url: '{{ route("reservations.get.by.patient", ["patient" => ":patient"]) }}'.replace(':patient', selectedUserId),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $("#reservation_id").empty();
                    console.log(data);
                    $.each(data, function (index, reservation) {
                        $("#reservation_id").append('<option value="' + reservation.id + '">' + reservation.text + '</option>');
                    });

                    // Trigger change event to refresh Select2
                    $("#reservation_id").trigger('change');
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });
            

        
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