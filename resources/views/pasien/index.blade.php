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
                                    <table class="table table-bordered table-hover">
        @if($patients->count() < 1)
        <p class="text-center">Tidak ada Data Pasien</p>
        @else
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">ID Pasien</th>
                <th scope="col" class="text-center">Foto Pasien</th>
                <th scope="col" class="text-center">Nama Pasien</th>
                <th scope="col" class="text-center">Tanggal Lahir</th>
                <th scope="col" class="text-center">Gender</th>
                <th scope="col" class="text-center">Alamat</th>
                <th scope="col" class="text-center">Height</th>
                <th scope="col" class="text-center">Weight</th>
                <th scope="col" class="text-center">Nomor HP</th>
                <th scope="col" class="text-center">Username</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->id }}</td>
                <td><img src="{{ asset('storage/'.$patient->user->image) }}" alt="Foto Pasien" width="100px"></td>
                <td>{{ $patient->user->name }}</td>
                <td>{{ $patient->user->birth_date }}</td>
                <td>{{ $patient->user->gender }}</td>
                <td>{{ $patient->user->address }}</td>
                <td>{{ $patient->height }}</td>
                <td>{{ $patient->weight }}</td>
                <td>{{ $patient->user->phone }}</td>
                <td>{{ $patient->user->username }}</td>
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