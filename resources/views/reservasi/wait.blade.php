@extends('layouts.main')

@section('header')
<h1 class="m-0">
    Menunggu Approval Reservasi
</h1>
@endsection

@section('container')
<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped" id="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Reservation Code</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Spesialis</th>
                                    <th scope="col" class="text-center">Jadwal</th>
                                    <th scope="col" class="text-center">Image</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($waits as $wait)
                                    <tr>
                                        <td class="text-center">{{ $wait->reservation_code }}</td>
                                        <td>{{ $wait->patient->user->name }}</td>
                                        <td>{{ $wait->schedule->schedule_type->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($wait->schedule->schedule_date)->format('l, d F Y') . ' / ' .
                                            $wait->schedule->schedule_time }}</td>
                                        <td class="text-center">
                                            @if($wait->bpjs == 0)
                                                <img src="{{ asset('storage/'.$wait->bukti_pembayaran)}}" class="toZoom img-thumbnail" style="max-height: 150px; max-width: 150px; cursor: pointer;" data-zoom-image>
                                            @else
                                                <img src="{{ asset('storage/'.$wait->ktp)}}" class="toZoom img-thumbnail" style="max-height: 150px; max-width: 150px; cursor: pointer;" data-zoom-image>
                                                <img src="{{ asset('storage/'.$wait->surat_rujukan)}}" class="toZoom img-thumbnail" style="max-height: 150px; max-width: 150px; cursor: pointer;" data-zoom-image>
                                                <img src="{{ asset('storage/'.$wait->bpjs_card)}}" class="toZoom img-thumbnail" style="max-height: 150px; max-width: 150px; cursor: pointer;" data-zoom-image>
                                            @endif
                                        </td>
                                        <td class="project-actions text-center">
                                            <div class="d-flex">
                                                <form id="approve-form" action="{{ route('admin.approve', ['id' => $wait->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <a onclick="approve()" class="btn btn-primary" style="margin-right:4px">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                </form>
                                                    <button id="reject" data-id="{{ $wait->id }}" class="reject btn btn-sm btn-danger">
                                                        <i class="fa fa-times-circle"></i>
                                                    </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imageModalLabel">Zoomed Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <img src="" id="modalImage" class="img-fluid" alt="Zoomed Image">
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

    function approve(){
        Swal.fire({
            title: 'Approve Reservasi',
                type: 'info',
                icon: 'info',
                showCancelButton: true,
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#approve-form').submit();
                }
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
                    console.log(result, defaultId);
                    $.ajax({
                        type: 'PUT',
                        url: `{{ route("admin.reservation.reject", ["id" => ":id"]) }}`.replace(':id', defaultId),
                        data: {
                            _token: '{{ csrf_token() }}',
                            data:result.value,
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Rejected!',
                                text: 'Reservation has been rejected.',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to reject the reservation.',
                                icon: 'error'
                            });
                        }
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
