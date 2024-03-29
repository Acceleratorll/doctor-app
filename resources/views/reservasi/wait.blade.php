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
                        <table class="table table-dark table-striped" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">Reservation Code</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Jadwal</th>
                                    {{-- <th scope="col" class="text-center">Nomor Urut</th> --}}
                                    <th scope="col" class="text-center">Image</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($waits as $wait)
                                    <tr>
                                        <td class="text-center">{{ $wait->reservation_code }}</td>
                                        <td>{{ $wait->patient->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($wait->schedule->schedule_date)->format('l, d F Y') . ' / ' .
                                            $wait->schedule->schedule_time }}</td>
                                        {{-- <td class="text-center">{{ $wait->nomor_urut }}</td> --}}
                                        <td>
                                            @if($wait->bpjs == 0)
                                            <img src="{{ asset('storage/'.$wait->bukti_pembayaran)}}" class="toZoom" style="max-height: 150px; max-width: 150px;" data-zoom-image>
                                            @else
                                            <img src="{{ asset('storage/'.$wait->ktp)}}" class="toZoom" style="max-height: 150px; max-width: 150px;" data-zoom-image>
                                            <img src="{{ asset('storage/'.$wait->surat_rujukan)}}" class="toZoom" style="max-height: 150px; max-width: 150px;" data-zoom-image>
                                            <img src="{{ asset('storage/'.$wait->bpjs_card)}}" class="toZoom" style="max-height: 150px; max-width: 150px;" data-zoom-image>
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
                                            <button type="submit" id="reject" class="reject btn btn-sm btn-warning" data-id="{{ $wait->id }}">
                                                <i class="fa fa-edit"></i>
                                                Tidak Approve
                                            </button>
                                            </td>
                                            <div class="idMyModal modal">
                                              <span class="close">&times;</span>
                                              <img class="modal-content">
                                            </div><div class="idMyModal modal">
                                              <span class="close">&times;</span>
                                              <img class="modal-content">
                                            </div>
                                            <div class="idMyModal modal">
                                              <span class="close">&times;</span>
                                              <img class="modal-content">
                                            </div>
                                            <div class="idMyModal modal">
                                              <span class="close">&times;</span>
                                              <img class="modal-content">
                                            </div>
                                        @endforeach
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

    var dropdown = document.getElementsByClassName("dropdown-btn");

    function showSweetAlert(type, message) {
        Swal.fire({
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 2500 // Change this value to adjust the display time
        });
    }

    
    $(document).ready( function () {
        @if ($message = Session::get('success'))
        showSweetAlert('success', '{{ $message }}');
        @elseif ($message = Session::get('error'))
        showSweetAlert('error', '{{ $message }}');
        @endif
        
        $('#table').DataTable();

        $('.reject').on('click', function(){
            var rejectButton = $(this);
            var defaultId = rejectButton.data('id');
            Swal.fire({
                title: 'Tolak Reservasi',
                input: "textarea",
                inputLabel: "Alasan",
                inputPlaceholder: "Masukkan Alasan penolakan reservasi",
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(result);
                    $.ajax({
                        type: 'PUT',
                        url: `{{ route("admin.reservation.reject", ["id" => ":id"]) }}`.replace(':id', defaultId),
                        data: {
                            _token: '{{ csrf_token() }}',
                            data:result.value,
                        },
                        success: function (response) {
                            Swal.fire({
                                title: 'Reservasi Berhasil Ditolak!',
                                type: 'success',
                                icon: 'success',
                                timer: 1700,
                            });
                            Swal.showLoading();
                            location.reload();
                        },
                        error: function (error) {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Failed !', 'error');
                        },
                    });
                }
            });
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
        }
        
        $('#sidebarcollapse').on('click',function(){
            $('#sidebar').toggleClass('active');
        });
    });

 
</script>
</body>

</html>
@endsection
