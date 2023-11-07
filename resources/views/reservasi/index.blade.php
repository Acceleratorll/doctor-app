@extends('layouts.main')

@section('header')
<h1 class="m-0">
    Master Reservasi
</h1>
@endsection

@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-between">
                        <div class="col-md-2">
                            <div class="button-action" style="margin-bottom: 20px">
                                <button type="button" class="btn btn-primary" onclick="location.href='/admin/reservation/create'">
                                    <span>+ Add Items</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-7"></div>
                        <div class="col-md-3">
                            <form action="{{ route('admin.reservation.index') }}" method="GET">
                                <label for="bpjsFilter">Filter Pembayaran:</label><br>
                                <select class="" id="bpjsFilter" name="bpjs">
                                    <option value="">All</option>
                                    <option value="0">Bayar</option>
                                    <option value="1">BPJS</option>
                                </select>&nbsp;
                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                            </form>
                        </div>
                    </div><br>
                    <h4 class="m-0">
                        Belum Melakukan Pemeriksaan                 
                    </h4><br>
                    <div class="table-responsive">
                        <table class="table-dark table-striped" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" class="text-center">Kode Reservasi</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Nomor Urut</th>
                                    <th scope="col" class="text-center">Jadwal</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- @if($reservations_no->count() < 1)
                                    <td><strong>Tidak ada Data</strong></td>
                                    @else --}}
                                    @foreach($reservations_no as $reservation)
                                    <tr>
                                        <td>{{ $reservation->id }}</td>
                                        <td>{{ $reservation->reservation_code }}</td>
                                        <td>{{ $reservation->patient->user->name }}</td>
                                        <td>{{ $reservation->nomor_urut }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->schedule->schedule_date)->format('l, d F Y') . ' / ' .
                                            $reservation->schedule->schedule_time }}</td>
                                            @if($reservation->status == 0)
                                        <td>Belum Periksa</td>
                                        @else
                                        <td>Sudah Periksa</td>
                                        @endif
                                        <td class="project-actions text-center">
                                            <form action="{{ route('admin.reservation.destroy', $reservation->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservarion?')">
                                                    Delete
                                                </button>
                                            </form>
                                            
                                            <button class="btn btn-primary btn-sm isiHasil" id="isiHasil" data-id="{{ $reservation->id }}" data-toggle="modal" data-target="#medicalRecordModal">
                                                <span>Hasil</span>
                                            </button>

                                            <form action="{{ route('admin.reservation.skip', $reservation->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to skip this reservation?')">
                                                    Skip
                                                </button>
                                            </form>
                                        
                                            <a href="/admin/reservation/{{ $reservation->id }}/edit"
                                                class="btn btn-sm btn-warning">
                                                Edit
                                            </a>
                                        </td>
                                    @endforeach
                                    {{-- @endif --}}
                                </tbody>
                        </table>
                </div><br><br><br>
                <h4 class="m-0">
                    Sudah Melakukan Pemeriksaan                 
                </h4><br>
                <div class="table-responsive">
                    <table class="table-dark table-striped" id="myTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Kode Reservasi</th>
                                <th scope="col" class="text-center">Nama Pasien</th>
                                <th scope="col" class="text-center">Nomor Urut</th>
                                <th scope="col" class="text-center">Jadwal</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($reservations_yes->count() < 1)
                        </tbody>
                        @else
                        @foreach($reservations_yes as $reservation)
                            <tr>
                                <td>{{ $reservation->reservation_code }}</td>
                                <td>{{ $reservation->patient->user->name }}</td>
                                <td><center>{{ $reservation->nomor_urut }}</center></td>
                                <td>{{ \Carbon\Carbon::parse($reservation->schedule->schedule_date)->format('l, d F Y') . ' / ' .
                                    $reservation->schedule->schedule_time }}</td>
                                    @if($reservation->status == 0)
                                <td>Belum Periksa</td>
                                @else
                                <td>Sudah Periksa</td>
                                @endif
                                <td class="project-actions text-center">
                                    <form action="{{ route('admin.reservation.destroy', $reservation->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservarion?')">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                        <a href="/admin/reservation/{{ $reservation->id }}/edit"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i>
                                            Edit
                                        </a>
                                    </form>
                                </td>
                                @endforeach
                                @endif
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="medicalRecordModal" style="overflow:hidden;" role="dialog" aria-labelledby="medicalRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="medicalRecordModalLabel">Add Medical Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.medis.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="number" name="reservation_id" id="reservation_id" hidden>
                    <div class="form-group">
                        <select class="form-control select2" name="icd_code" id="icd_code"></select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="action" placeholder="Masukkan Tindakan" class="form-control" id="action"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="complaint" placeholder="Masukkan Keluhan Pasien" class="form-control" id="complaint"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="physical_exam" placeholder="Masukkan Hasil Pemeriksaan Fisik" class="form-control" id="physical_exam"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="diagnosis" placeholder="Masukkan Hasil Diagnosa" class="form-control" id="diagnosis"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="recommendation" placeholder="Masukkan Anjuran" class="form-control" id="recommendation"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="recipe" placeholder="Masukkan Resep" class="form-control" id="recipe"/>
                    </div>
                    <div class="form-group">
                        <textarea name="desc" placeholder="Masukkan Deskripsi(Optional)" class="form-control" id="desc"></textarea>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="file" name="files[]" id="files" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    #action::placeholder,
    #complaint::placeholder,
    #physical_exam::placeholder,
    #diagnosis::placeholder,
    #recommendation::placeholder,
    #recipe::placeholder,
    #desc::placeholder {
        color: white;
    }

    .modal-body {
        max-height: 60vh;
        overflow-y: auto;
    }
</style>
@endsection

@section('js')
<script>
    function showSweetAlert(type, message) {
        Swal.fire({
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 2000 // Change this value to adjust the display time
        });
    }
    $(document).ready( function () {
        $('#icd_code').select2({
            dropdownParent: $('#medicalRecordModal'),
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
            placeholder: 'Select an ICD(Optional)',
            minimumInputLength: 1
        });
        
        @if ($message = Session::get('success'))
        showSweetAlert('success', '{{ $message }}');
        @elseif ($message = Session::get('error'))
        showSweetAlert('error', '{{ $message }}');
        @endif
        
        document.querySelectorAll('.isiHasil').forEach(function(element) {
            element.addEventListener('click', function() {
                var reservationId = $(this).data('id');
                $('#reservation_id').val(reservationId);
                console.log(reservationId);
                console.log("Success");
            });
        });
            
        $('#table').DataTable({
            "order": []
        });
        $('#myTable').DataTable({
            "order": []
        });
        for (var i = 0; i <100; i++) {
        }
        
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var j;
        for (j = 0; j < dropdown.length; j++) {
            dropdown[j].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }

        $('#sidebarcollapse').on('click',function(){
            $('#sidebar').toggleClass('active');
        });
        
        function hideCollapsible(reservationId) {
            $('#belumhasil' + reservationId).collapse('hide');
        }
        
        $('[id^="saveButton"]').click(function() {
            const reservationId = this.id.replace('saveButton', '');
            hideCollapsible(reservationId);
        });
            
        $('[id^="cancelButton"]').click(function() {
            const reservationId = this.id.replace('cancelButton', '');
            hideCollapsible(reservationId);
        });
    });
        
</script>
@endsection