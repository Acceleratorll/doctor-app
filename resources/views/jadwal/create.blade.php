@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Tambah Jadwal                  
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
            <form id="jadwal" action="/admin/jadwal" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <select name="place_id" id="tempat" class="form-control">
                            @if($places->count() < 1)
                            <option>Tidak ada Tempat</option>
                            @else
                            @foreach($places as $place)
                            <option value="{{ $place->id }}">{{ $place->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row justify-content-between">
                <div class="col-md-6">
                    <label for="basic-url">Jadwal untuk</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Spesialis</span>
                        </div>
                        <select name="schedule_type_id" class="custom-select" id="inputGroupSelect01">
                            <option selected disabled>Pilih...</option>
                            @foreach ($schedule_types as $schedule_type)
                            <option value="{{ $schedule_type->id }}">{{ $schedule_type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Tanggal">Tanggal</label>
                        {{-- <input type="number" name="employee_id" value="{{ auth()->user()->employee->id }}" id="linkmaps" required hidden> --}}
                        <input type="date" placeholder="Masukkan Tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="schedule_date" id="linkmaps" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="doctor">Dokter</label>
                        <select class="form-control" name="employee_id" id="employee_id">
                            <option value="#" selected disabled>Pilih Dokter...</option>
                            @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->employee->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Jam">Jam Mulai</label>
                        <input type="time" placeholder="Masukkan Jam Mulai" class="form-control" name="schedule_time" id="jam" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Jam">Jam Berakhir</label>
                        <input type="time" placeholder="Masukkan Jam Berakhir" class="form-control" name="schedule_time_end" id="jam" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Jam">Kuota</label>
                        <input type="number" placeholder="Masukkan Banyak Kuota" class="form-control" name="qty" id="qty" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Jam">Di Ulang</label>
                        <select class="form-control" name="frequency" id="frequency">
                            <option value="-1" selected>Tidak Berulang</option>
                            <option value="daily">Setiap Hari</option>
                            <option value="weekly">Setiap Minggu</option>
                            <option value="monthly">Setiap Bulan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="Jam">Selama ?</label>
                        <input type="number" placeholder="Input Durasi" class="form-control" name="duration" id="duration"/>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="identifier">Satuan</label>
                        <input class="form-control" name="identifier" id="identifier" placeholder="satuan" readonly/>
                    </div>
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
        $(document).ready(function() {
            $("#tempat").select2();
            
            $('#frequency').on('change', function () {
                var selectedFrequency = $(this).val();
                console.log(selectedFrequency);
    
                switch (selectedFrequency) {
                    case 'daily':
                        $('#identifier').val('day');
                        break;
                    case 'weekly':
                        $('#identifier').val('week');
                        break;
                    case 'monthly':
                        $('#identifier').val('month');
                        break;
                    default:
                        // If none of the specific frequencies are selected, reset the identifier dropdown
                        $('#identifier').val('');
                }
            });
            
            $('#inputGroupSelect01').change(function() {
                var id = $(this).val();

                $.ajax({
                    url: "{{ route('get.users', ['id' => ':id']) }}".replace(':id', id),
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#employee_id').empty();
                        $('#employee_id').append('<option value="">Pilih Dokter...</option>');
                        $.each(response, function(i,data) {
                            console.log(i, data.employee, data.name);
                            $('#employee_id').append('<option value="' + data.employee.id + '">' + data.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#sidebarcollapse').on('click',function(){
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
@endsection