@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Master Pasien                 
    </h1>
@endsection

@section('container')
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="row" style="height: 10px"></div>
                        <div class="card">
                            <div class="card-body">
                                <div class="button-action" style="margin-bottom: 20px">
                                    <button type="button" class="btn btn-primary" onclick="location.href='/admin/pasien/create'">
                                        <span>+ Add Items</span>
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-dark table-striped" id="table">
                                        @if($patients->count() < 1)
                                        <p class="text-center">Tidak ada Data Pasien</p>
                                        @else
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col" class="text-center">ID Pasien</th>
                                                <th scope="col" class="text-center">Nama Pasien</th>
                                                <th scope="col" class="text-center">Tanggal Lahir</th>
                                                <th scope="col" class="text-center">Usia</th>
                                                <th scope="col" class="text-center">Gender</th>
                                                <th scope="col" class="text-center">Alamat</th>
                                                <th scope="col" class="text-center">Height</th>
                                                <th scope="col" class="text-center">Weight</th>
                                                <th scope="col" class="text-center">Nomor HP</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($patients as $patient)
                                            <tr>
                                                <td>{{ $patient->id }}</td>
                                                <td>{{ $patient->user->name }}</td>
                                                <td>{{ $patient->user->birth_date->format('d M Y') }}</td>
                                                <td>{{ $patient->user->birth_date->diff(now())->y }}</td>
                                                <td>{{ $patient->user->gender }}</td>
                                                <td>{{ $patient->user->address }}</td>
                                                <td>{{ $patient->height }}</td>
                                                <td>{{ $patient->weight }}</td>
                                                <td>{{ $patient->user->phone }}</td>
                                                <td class="project-actions text-center">
                                                    <form action="{{ route('admin.pasien.destroy', $patient->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this patient?')">
                                                            <i class="fas fa-trash"></i>
                                                            Delete
                                                        </button>
                                                        <a href="/admin/pasien/{{ $patient->id }}/edit" class="btn btn-sm btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                            Edit
                                                        </a>
                                                        <a href="#" class="btn btn-info btn-sm show-reservations" data-patient-id="{{ $patient->id }}">
                                                            <i class="fas fa-list"></i> Show Reservations
                                                        </a>
                                                        <button class="btn btn-info btn-sm hide-reservations" style="display: none">
                                                            <i class="fas fa-times"></i> Hide Reservations
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
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
        <div class="detail-container container" style="display: none;">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-dark table-striped text-center" id="details-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" class="text-center">Nama</th>
                                    <th scope="col" class="text-center">Dokter</th>
                                    <th scope="col" class="text-center">Tempat</th>
                                    <th scope="col" class="text-center">Tanggal</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>

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
                
                var table = $('#table').DataTable();
                var detailTable = $('#details-table').DataTable();
                
                $('#sidebarcollapse').on('click',function(){
                    $('#sidebar').toggleClass('active');
                });
                
                $('.show-reservations').click(function (e) {
                    e.preventDefault();
                    var patientId = $(this).data('patient-id');
                    var detailContainer = $('.detail-container');
                    var showButton = $('.show-reservations');
                    var hideButton = $('.hide-reservations');
                    
                     $.ajax({
                         url: '{{ route("admin.patient.reservations", ":id") }}'.replace(':id', patientId),
                         type: 'GET',
                         success: function (data) {
                             detailTable.clear().draw();
                 
                             data.forEach(function (reservation) {
                                 detailTable.row.add([
                                     reservation.id,
                                     reservation.patient.user.name,
                                     reservation.schedule.employee.user.name,
                                     reservation.schedule.place.name,
                                     reservation.schedule.schedule_date,
                                 ]).draw(false);
                             });
                 
                             // Show the detail container, hide the "Show Reservations" button, and show the "Hide Reservations" button
                             detailContainer.show();
                             showButton.hide();
                             hideButton.show();
                         },
                         error: function (error) {
                             console.log(error);
                         }
                     });
                         
                    detailContainer.show();
                    showButton.hide();
                    hideButton.show();
                });
        
                $('.hide-reservations').click(function (e) {
                    e.preventDefault();
                    var detailContainer = $('.detail-container');
                    var showButton = $('.show-reservations');
                    var hideButton = $('.hide-reservations');
                    $('#details-table').DataTable().clear().draw();
        
                    detailContainer.hide();
                    showButton.show();
                    hideButton.hide();
                });
                    
            });
                    

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

    </script>
@endsection

@section('css')
<style>
    .modal-fullscreen {
        min-width: 100%;
        margin: 0;
    }

    .modal-fullscreen .modal-content {
        min-height: 100vh;
    }
</style>
@endsection