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
        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="reservationsModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Patient Reservations</h5>
                          <button type="button" class="close" style="z-index:999999;" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <ul id="reservations-list"></ul>
                      </div>
                  </div>
              </div>
          </div>
            
        <script>
            $(document).ready( function () {
                var table = $('#table').DataTable();

                $('#sidebarcollapse').on('click',function(){
                    $('#sidebar').toggleClass('active');
                });

                $('.show-reservations').click(function (e) {
                    e.preventDefault();
                    var patientId = $(this).data('patient-id');
                    var url = '{{ route("reservations.json.get.by.patient", ["patient" => ":patient"]) }}'.replace(':patient', patientId);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (data) {
                            var incomingProducts = data.incoming_products;
                            var modal = $('#reservationsModal');
                            var modalList = modal.find('#reservations-list');
                            modalList.empty();
                            
                            $.each(data, function(index, reservation) {
                                console.log(reservation.schedule.employee.user.name);
                                modalList.append('<li>' + reservation.schedule.schedule_date + ' <p>Code : <strong>' + reservation.reservation_code +
                                    ('</strong><br>Dokter : ' + reservation.schedule.employee.user.name ?? 'N/A') +'</p></li>');
                            });
                            
                            $('#reservationsModal').modal('show');
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
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
</body>
</html>
@endsection