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
                                <option value="{{ $medical_record->reservation->patient_id }}">{{ $medical_record->reservation->patient->user->name }}</option>
                                @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reservation_id">Reservation Code</label>
                    <select class="form-control select2" name="reservation_id" id="reservation_id" required>
                        @if ($medical_record->reservation != null)
                        <option value="{{ $medical_record->reservation_id }}" selected>{{ $medical_record->reservation->reservation_code }}</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="icd_code">ICD  (Optional)</label>
                    <select class="form-control select2" name="icd_code" id="icd_code">
                        @if ($medical_record->icd != null)
                        <option value="{{ $medical_record->icd_code }}" selected>{{ $medical_record->icd->name_id }}</option>
                        @endif
                    </select>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="files">Files  (Optional)</label>
                            <input class="form-control" type="file" name="files[]" id="files" multiple>
                        </div>
                    </div>
                </div>
                @isset($currentFiles)
                @foreach($files as $file)
                <input type="hidden" name="current_files[]" value="{{ $file }}">
                @endforeach
                @endisset
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="complaint">Keluhan</label>
                            <input class="form-control" type="text" name="complaint" id="complaint" value="{{ $medical_record->complaint }}" placeholder="Masukkan Keluhan" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="physical_exam">Pemeriksaan Fisik</label>
                            <input class="form-control" type="text" name="physical_exam" id="physical_exam" value="{{ $medical_record->physical_exam }}" placeholder="Masukkan Hasil Pemeriksaan Fisik" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="diagnosis">Diagnosa</label>
                            <input class="form-control" type="text" name="diagnosis" id="diagnosis" value="{{ $medical_record->diagnosis }}" placeholder="Masukkan Hasil Diagnosa" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="recommendation">Anjuran</label>
                            <input class="form-control" type="text" name="recommendation" id="recommendation" value="{{ $medical_record->recommendation }}" placeholder="Masukkan Anjuran" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="recipe">Resep</label>
                            <input class="form-control" type="text" name="recipe" id="recipe" value="{{ $medical_record->recipe }}">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="action">Tindakan</label>
                            <input class="form-control" type="text" name="action" id="action" value="{{ $medical_record->action }}">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="Hasil Tes">Keterangan  (Optional)</label>
                            <input type="number" name="employee_id" value="{{ auth()->user()->employee->id }}" id="linkmaps" required hidden>
                            <textarea type="text" placeholder="Masukkan Hasil Tes" class="form-control" name="desc" id="hasiltes" >{{ $medical_record->desc }}</textarea>
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
        var dropdown = document.getElementsByClassName("dropdown-btn");
        
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
        // placeholder: 'Select an ICD',
        minimumInputLength: 1
    });
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
        };
        $(document).ready(function(){
                $('#sidebarcollapse').on('click',function(){
                    $('#sidebar').toggleClass('active');
                });
        });
    </script>
@endsection