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
            <form action="/admin/jadwal" method="POST" enctype="multipart/form-data">
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
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Tanggal">Tanggal</label>
                        <input type="number" name="employee_id" value="{{ auth()->user()->employee->id }}" id="linkmaps" required hidden>
                        <input type="date" placeholder="Masukkan Tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="schedule_date" id="linkmaps" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="Jam">Jam Mulai</label>
                        <input type="time" placeholder="Masukkan Jam Mulai" class="form-control" name="schedule_time" id="jam" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
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

            $('#sidebarcollapse').on('click',function(){
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
@endsection