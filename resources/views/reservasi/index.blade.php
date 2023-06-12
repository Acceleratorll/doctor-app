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
                        <button type="button" class="btn btn-primary" onclick="location.href='/pasien/create'">
                            <span>+ Add Items</span>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            @if($reservations->count() < 1) Tidak ada Data Pasien @else <thead>
                                <tr>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Doktor</th>
                                    <th scope="col" class="text-center">Jadwal</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->patient->name }}</td>
                                        <td>{{ $reservation->schedule->employee->name }}</td>
                                        <td>{{ $reservation->schedule->schedule_date . ' / ' .
                                            $reservation->schedule->schedule_time }}</td>
                                        <td>{{ $reservation->status }}</td>

                                        <td class="project-actions text-center">

                                            <a href="/reservation/{{ $reservation->id }}/edit"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                        </td>
                                        @endforeach
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
    $(document).ready( function () {
        $('#table').DataTable();
    } );
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
