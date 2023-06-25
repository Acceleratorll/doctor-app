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
                        Sudah Melakukan Pemeriksaan                 
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            @if($reservations->count() < 1) Tidak ada Data Pasien @else <thead>
                                <tr>
                                    <th scope="col" class="text-center">Reservation Code</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Jadwal</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($reservations->count() < 1)
                                    <h1>Tidak ada Data</h1>
                                    @else
                                    @foreach($reservations as $reservation)
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
                                        <form action="{{ route('admin.reservation.destroy', $reservation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <td class="project-actions text-center">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservarion?')">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                                <a href="/admin/reservation/{{ $reservation->id }}/edit"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                    Edit
                                                </a>
                                                <a href="#hasil1" class="btn btn-primary btn-sm" data-toggle="collapse" aria-expanded="false">
                                                    <i class="fa fa-edit">
                                                    </i>
                                                    <span>Isi Hasil</span>
                                                </a>
                                                <div class="collapse multi-collapse" id="hasil1">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="Isi Hasil">Isi Hasil</label>
                                                                <textarea class="form-control" name="isihasil1" id="isihasil1" placeholder="Masukkan Hasil"></textarea>
                                                                <div class="text-center" style = "margin-top: 10px; margin-bottom: -20px">
                                                                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalconfirm">Simpan</button>
                                                                    <button type="reset" class="btn btn-warning" data-toggle="modal" data-target="#modalconfirm"> Batal </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </form>
                                        @endforeach
                                        @endif
                                </tbody>
                                @endif
                        </table>
                    </div>
                    <div><br><br><br></div>
                    <h4 class="m-0">
                        Belum Melakukan Pemeriksaan                 
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            @if($reservations->count() < 1) Tidak ada Data Pasien @else <thead>
                                <tr>
                                    <th scope="col" class="text-center">Reservation Code</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Jadwal</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if($reservations->count() < 1)
                                    <h1>Tidak ada Data</h1>
                                    @else
                                    @foreach($reservations as $reservation)
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
                                        <form action="{{ route('admin.reservation.destroy', $reservation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <td class="project-actions text-center">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservarion?')">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                                <a href="/admin/reservation/{{ $reservation->id }}/edit"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                    Edit
                                                </a>
                                                <a href="#hasil2" class="btn btn-primary btn-sm" data-toggle="collapse" aria-expanded="false">
                                                    <i class="fa fa-edit">
                                                    </i>
                                                    <span>Isi Hasil</span>
                                                </a>
                                                <div class="collapse multi-collapse" id="hasil2">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="Isi Hasil">Isi Hasil</label>
                                                                <textarea class="form-control" name="isihasil2" id="isihasil2" placeholder="Masukkan Hasil"></textarea>
                                                                <div class="text-center" style = "margin-top: 10px; margin-bottom: -20px">
                                                                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalconfirm">Simpan</button>
                                                                    <button type="reset" class="btn btn-warning" data-toggle="modal" data-target="#modalconfirm"> Batal </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </form>
                                        @endforeach
                                        @endif
                                </tbody>
                                @endif
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
