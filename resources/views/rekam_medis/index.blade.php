@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Master Rekam Medis                 
    </h1>
@endsection

@section('container')
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="row" style="height: 10px"></div>
                        <div class="card">
                            <div class="card-body">
                                <div class="button-action" style="margin-bottom: 20px">
                                    <button type="button" class="btn btn-primary" onclick="location.href='/admin/medis/create'">
                                        <span>+ Add Items</span>
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table-dark table-striped" id="table">
                                        @if($medical_records->count() < 1)
                                        Tidak ada Data Rekam Medis
                                        @else
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="text-center">ID</th>
                                            <th scope="col" class="text-center">Dokter</th>
                                            <th scope="col" class="text-center">Nama Pasien</th>
                                            <th scope="col" class="text-center">Gender</th>
                                            <th scope="col" class="text-center">Tindakan</th>
                                            <th scope="col" class="text-center">Keluhan</th>
                                            <th scope="col" class="text-center">Pemeriksaan Fisik</th>
                                            <th scope="col" class="text-center">Diagnosis</th>
                                            <th scope="col" class="text-center">Anjuran</th>
                                            <th scope="col" class="text-center">Resep</th>
                                            <th scope="col" class="text-center">ICD</th>
                                            <th scope="col" class="text-center">Keterangan</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($medical_records as $medical_record)
                                        <tr>
                                            <td>{{ $medical_record->id }}</td>
                                            <td>{{ $medical_record->reservation->schedule->employee->user->name}}</td>
                                            <td>{{ $medical_record->reservation->patient->user->name }}</td>
                                            <td>{{ $medical_record->reservation->patient->user->gender }}</td>
                                            <td>{{ $medical_record->action }}</td>
                                            <td>{{ $medical_record->complaint }}</td>
                                            <td>{{ $medical_record->physical_exam }}</td>
                                            <td>{{ $medical_record->diagnosis }}</td>
                                            <td>{{ $medical_record->recommendation }}</td>
                                            <td>{{ $medical_record->recipe }}</td>
                                            <td>
                                                <button class="btn btn-outline-info icdDetailButton" data-icd-name="{{ $medical_record->icd->name_id ?? 'N/A' }}">
                                                    {{ $medical_record->icd_code ?? 'N/A' }}
                                                </button>
                                            </td>
                                            <td>{{ $medical_record->desc ?? 'N/A' }}</td>
                                            <td class="project-actions text-center">
                                                <form action="{{ route('admin.medis.destroy', $medical_record->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this schedule?')">
                                                        <i class="fas fa-trash"></i>
                                                        Delete
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-warning" onclick="location.href='/admin/medis/{{ $medical_record->id }}/edit'">
                                                        <i class="fa fa-edit"></i>
                                                        Edit
                                                    </button>
                                                    @if($medical_record->files->count() >0)
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="location.href='/download/{{ $medical_record->id }}'">
                                                        <i class="fa fa-edit"></i>
                                                        Download
                                                    </button>
                                                    @endif
                                                </form>
                                            </td>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="tfoot-dark">
                                            <tr>
                                                <th scope="col" class="text-center">ID</th>
                                                <th scope="col" class="text-center">Dokter</th>
                                                <th scope="col" class="text-center">Nama Pasien</th>
                                                <th scope="col" class="text-center">Gender</th>
                                                <th scope="col" class="text-center">Tindakan</th>
                                                <th scope="col" class="text-center">Keluhan</th>
                                                <th scope="col" class="text-center">Pemeriksaan Fisik</th>
                                                <th scope="col" class="text-center">Diagnosis</th>
                                                <th scope="col" class="text-center">Anjuran</th>
                                                <th scope="col" class="text-center">Resep</th>
                                                <th scope="col" class="text-center">ICD</th>
                                                <th scope="col" class="text-center">Keterangan</th>
                                            </tr>
                                        </tfoot>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="icdModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ICD Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="icdName"></p>
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

        function showSweetAlert(type, message) {
        Swal.fire({
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 2000 // Change this value to adjust the display time
        });
    }

    
    
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
        @if ($message = Session::get('success'))
        showSweetAlert('success', '{{ $message }}');
        @elseif ($message = Session::get('error'))
        showSweetAlert('error', '{{ $message }}');
        @endif

        $('#table tfoot th').each( function (i) {
            var title = $('#table thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" class="tfoot" placeholder="'+title+'" data-index="'+i+'" />' );
        } );
            
        var table = $('#table').DataTable({
            scrollY:        "300px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            fixedColumns:   true
        });

        $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
            table
                .column( $(this).data('index') )
                .search( this.value )
                .draw();
        } );
            
        $('.icdDetailButton').on('click', function () {
        // Fetch the ICD name from the data attribute
        var icdName = $(this).data('icd-name');

        // Update modal content
        $('#icdName').text(icdName);

        // Show the modal
        $('#icdModal').modal('show');
    });
    } );
    $(document).ready(
        function(){
            $('#sidebarcollapse').on('click',function(){
                $('#sidebar').toggleClass('active');
            });
        }
    );
</script>
</body>
</html>
@endsection

@section('css')    
<style>
</style>
@endsection