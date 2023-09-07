@extends('layouts.main')

@section('header')
<h1 class="m-0">
    Menunggu Approval Reservasi
</h1>
@endsection

@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row" style="height: 10px"></div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">Reservation Code</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Jadwal</th>
                                    <th scope="col" class="text-center">Nomor Urut</th>
                                    <th scope="col" class="text-center">Image</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if ($waits->count() < 1)
                                    <tr>
                                        <td><strong>Tidak ada Data</strong></td>
                                    @else
                                    @foreach($waits as $wait)
                                    <tr>
                                        <td class="text-center">{{ $wait->reservation_code }}</td>
                                        <td>{{ $wait->patient->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($wait->schedule->schedule_date)->format('l, d F Y') . ' / ' .
                                            $wait->schedule->schedule_time }}</td>
                                        <td class="text-center">{{ $wait->nomor_urut }}</td>
                                        <td>
                                            @if($wait->bpjs == 0)
                                            <img src="{{ asset('storage/'.$wait->bukti_pembayaran)}}" width="300px" height="300px">
                                            @else
                                            <img src="{{ asset('storage/'.$wait->ktp)}}" width="100px" height="100px">
                                            <img src="{{ asset('storage/'.$wait->surat_rujukan)}}" width="100px" height="100px">
                                            <img src="{{ asset('storage/'.$wait->bpjs_card)}}" width="100px" height="100px">
                                            @endif
                                        </td>
                                        <td class="project-actions text-center">
                                            <form action="{{ route('admin.approve', ['id' => $wait->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Approve
                                                </button>
                                            </form>
                                                <form action="/admin/restore/{{ $wait->id }}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning">
                                                        <i class="fa fa-edit"></i>
                                                        Tidak Approve
                                                    </button>
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
