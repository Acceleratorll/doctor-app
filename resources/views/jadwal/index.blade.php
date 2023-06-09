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
                @if($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
                @elseif($message =  Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @endif
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
                            <table class="table table-bordered" id="table{{ $placeId }}">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col" class="text-center">ID Dokter</th>
                                        <th scope="col" class="text-center">Nama Dokter</th> --}}
                                        <th scope="col" class="text-center">Tanggal</th>
                                        <th scope="col" class="text-center">Jam Mulai</th>
                                        <th scope="col" class="text-center">Jam Berakhir</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($placeSchedules as $schedule)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($schedule->schedule_date)->format('l, d F Y') }}</td>
                                        <td>{{ $schedule->schedule_time }}</td>
                                        <td>{{ $schedule->schedule_time_end }}</td>
                                        <td class="project-actions text-center">
                                            <form action="{{ route('admin.jadwal.destroy', $schedule->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this schedule?')">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                                <button type="button" class="btn btn-sm btn-warning" onclick="location.href='/admin/jadwal/{{ $schedule->id }}/edit'">
                                                    <i class="fa fa-edit"></i>
                                                    Edit
                                                </button>
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

    $(document).ready( function () {
        $('#table1').DataTable();
        $('#table2').DataTable();
        $('#table3').DataTable();
        $('#table4').DataTable();
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