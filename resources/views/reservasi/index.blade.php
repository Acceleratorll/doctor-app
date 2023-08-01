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
            <div class="row" style="height: 10px"></div>
            <div class="card">
                <div class="card-body">
                    <div class="button-action" style="margin-bottom: 20px">
                        <button type="button" class="btn btn-primary" onclick="location.href='/admin/reservation/create'">
                            <span>+ Add Items</span>
                        </button>
                    </div>
                    <h4 class="m-0">
                        Belum Melakukan Pemeriksaan                 
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">Reservation Code</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
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
                                                                <label for="Isi Hasil">Isi Hasil</label>
                                                                <textarea class="form-control" name="desc" id="isihasil1" placeholder="Masukkan Hasil"></textarea>
                                                                <input type="text" value="{{ auth()->user()->id }}" name="patient_id" hidden>
                                                                <input type="text" value="{{ $reservation->id }}" name="reservation_id" hidden>
                                                                <div class="text-center" style = "margin-top: 10px; margin-bottom: -20px">
                                                                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalconfirm">Simpan</button>
                                                                    <button type="reset" class="btn btn-warning" data-toggle="modal" data-target="#modalconfirm"> Batal </button>
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
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">Reservation Code</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Jadwal</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($reservations_yes->count() < 1)
                                    <td><strong>Tidak ada Data</strong></td>
                                    @else
                                    @foreach($reservations_yes as $reservation)
                                    <tr>
                                        <td>{{ $reservation->reservation_code }}</td>
                                        <td>{{ $reservation->patient->user->name }}</td>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    $(document).ready( function () {
        $('#table').DataTable();
        $('#myTable').DataTable();
    } );
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
</body>

</html>
@endsection
