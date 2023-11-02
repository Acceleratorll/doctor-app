@extends('layouts.main')

@section('header')
<h1 class="m-0">
    Pembatalan Reservasi
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
                        <table class="table table-dark table-striped" id="table">
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
                                    @if ($cancels->count() < 1)
                                    <tr>
                                        <td><strong>Tidak ada Data</strong></td>
                                    @else
                                    @foreach($cancels as $cancel)
                                    <tr>
                                        <td>{{ $cancel->reservation_code }}</td>
                                        <td>{{ $cancel->patient->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($cancel->schedule->schedule_date)->format('l, d F Y') . ' / ' .
                                            $cancel->schedule->schedule_time }}</td>
                                            @if($cancel->status == 0)
                                        <td>Belum Periksa</td>
                                        @elseif($cancel->status == 1)
                                        <td>Sudah Periksa</td>
                                        @endif
                                        <td class="project-actions text-center">
                                                <form action="{{ route('admin.reservation.destroy', $cancel->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservarion?')">
                                                    <i class="fas fa-trash"></i>
                                                    Approve
                                                </button>
                                        </form>
                                                <form action="/admin/restore/{{ $cancel->id }}" method="POST" enctype="multipart/form-data">
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

    function showSweetAlert(type, message) {
        Swal.fire({
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 2000 // Change this value to adjust the display time
        });
    }

    
    $(document).ready( function () {
        @if ($message = Session::get('success'))
        showSweetAlert('success', '{{ $message }}');
        @elseif ($message = Session::get('error'))
        showSweetAlert('error', '{{ $message }}');
        @endif
        
        $('#table').DataTable();
        $('#myTable').DataTable();

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
        function(){
            $('#sidebarcollapse').on('click',function(){
                $('#sidebar').toggleClass('active');
            });
        }
    });
</script>
</body>

</html>
@endsection
