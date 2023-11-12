@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Daftar Jadwal                 
    </h1>
@endsection

@section('container')
@if($schedules != null)
@foreach ($schedules as $placeId => $placeSchedules)
<div class="content-header">
    
    <div class="container-fluid">
        <div class="row mb-2">
            <h4 class="m-0">
                @php
                $place = \App\Models\Place::find($placeId);
                @endphp
                Jadwal {{ $place->name }}                 
            </h4>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="row" style="height: 10px"></div>
                <div class="card">
                    <div class="card-body">
                        <div class="button-action" style="margin-bottom: 20px">
                            <button type="button" class="btn btn-primary" onclick="location.href='{{ url('/admin/jadwal/create') }}'">
                                <span>+ Add Items</span>
                            </button>
                        </div>
                        <div class="table-responsive">
                            {{-- <input type="text" value="table{{ $placeId }}" id="table{{ $placeId }}" hidden> --}}
                            <table class="table-dark table-striped" id="table{{ $placeId }}">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="text-center">Tanggal</th>
                                        <th scope="col" class="text-center">Kuota</th>
                                        <th scope="col" class="text-center">Jam Mulai</th>
                                        <th scope="col" class="text-center">Jam Berakhir</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($placeSchedules as $schedule)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($schedule->schedule_date)->format('l, d F Y') }}</td>
                                        <td>{{ $schedule->qty }}</td>
                                        <td>{{ $schedule->schedule_time }}</td>
                                        <td>{{ $schedule->schedule_time_end }}</td>
                                        <td class="project-actions text-center">
                                            
                                                <button type="submit" id="delete" data-id="{{ $schedule->id }}" class="delete btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                                <button type="button" class="btn btn-sm btn-warning" onclick="location.href='/admin/jadwal/{{ $schedule->id }}/edit'">
                                                    <i class="fa fa-edit"></i>
                                                    Edit
                                                </button>
                                                <form action="{{ route('admin.jadwal.destroy', $schedule->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
</div>
@endforeach
@else
<strong>Tidak ada Jadwal</strong>
@endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
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

        document.addEventListener('DOMContentLoaded', function () {
        let table1 = new DataTable('#table1');
        let table2 = new DataTable('#table2');
    });

    function showSweetAlert(type, message) {
        Swal.fire({
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 2000
        });
    }

    
    $(document).ready( function () {
        @if ($message = Session::get('success'))
        showSweetAlert('success', '{{ $message }}');
        @elseif ($message = Session::get('error'))
        showSweetAlert('error', '{{ $message }}');
        @endif

        var table1 = $('#table1').DataTable();
        var table2 = $('#table2').DataTable();
        var table3 = $('#table3').DataTable();
        var table4 = $('#table4').DataTable();
        var table5 = $('#table5').DataTable();
        var table6 = $('#table6').DataTable();
        var table7 = $('#table7').DataTable();

        $('.delete').on('click', function(){
            var deleteButton = $(this);
            var defaultId = deleteButton.data('id');
    
            Swal.fire({
                title: 'Delete Schedule',
                text: 'Are you sure you want to delete this schedule?',
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                console.log(result);
                if (result.value == true) {
                    console.log('confirmed');
                    $.ajax({
                        type: 'POST',
                        url: `{{ route("admin.jadwal.destroy", ["jadwal" => ":scheduleId"]) }}`.replace(':scheduleId', defaultId),
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                    });
                    location.reload();
                }
            });
        });
    });
    
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