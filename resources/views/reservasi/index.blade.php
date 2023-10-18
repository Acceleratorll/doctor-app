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
            @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
            @elseif($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @endif
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
                        <table class="table table-bordered" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">Reservation Code</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Nomor Urut</th>
                                    <th scope="col" class="text-center">Jadwal</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($reservations_no->count() < 1)
                                    <td><strong>Tidak ada Data</strong></td>
                                    @else
                                    @foreach($reservations_no as $reservation)
                                    <tr>
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
                                                        <i class="fas fa-trash"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('admin.reservation.skip', $reservation->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to skip this reservation?')">
                                                        Skip
                                                    </button>
                                                </form>
                                            
                                                <a href="/admin/reservation/{{ $reservation->id }}/edit"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                    Edit
                                                </a>
                                                <a href="#belumhasil{{ $reservation->id }}" class="btn btn-primary btn-sm" data-toggle="collapse" aria-expanded="false">
                                                    <i class="fa fa-edit">
                                                    </i>
                                                    <span>Isi Hasil</span>
                                                </a>
                                                <div class="collapse multi-collapse" id="belumhasil{{ $reservation->id }}">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <form action="/admin/storeMed" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                <br>
                                                                <label for="Isi Hasil">Isi Hasil Pemeriksaan</label>
                                                                <textarea class="form-control" name="action" id="isihasil1" placeholder="Masukkan Tindakan"></textarea>
                                                                <textarea class="form-control" name="desc" id="isihasil1" placeholder="Masukkan Keterangan"></textarea>
                                                                <select class="form-control" data-role="select2" name="icd_code" id="icd_code{{ $reservation->id }}" width="200px"></select>
                                                                <input type="file" id="file-input" name="files[]" multiple>
                                                                <input type="text" value="{{ auth()->user()->id }}" name="patient_id" hidden>
                                                                <input type="text" value="{{ $reservation->id }}" name="reservation_id" hidden>
                                                                <div class="text-center" style = "margin-top: 10px; margin-bottom: -20px">
                                                                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalconfirm">Simpan</button>
                                                                    <button id="cancelButton{{ $reservation->id }}" type="reset" class="btn btn-warning" data-toggle="modal" data-target="#modalconfirm"> Batal </button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endforeach
                                        @endif
                                </tbody>
                        </table>
                    </div>
                    <div><br><br><br></div>
                    <h4 class="m-0">
                        Sudah Melakukan Pemeriksaan                 
                    </h4><br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">Reservation Code</th>
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

<script>
    $(document).ready( function () {
        $('#table').DataTable();
        $('#myTable').DataTable();
        for (var i = 0; i <100; i++) {
            $('#icd_code'+i).select2({
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
        }
        
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
</body>

</html>
@endsection
