@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Master Pegawai                 
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
                                    <button type="button" class="btn btn-primary" onclick="location.href='/admin/pegawai/create'">
                                        <span>+ Add Items</span>
                                    </button>
                                </div>
                                <div class="table-responsive">
    <table class="table table-bordered" id="table">
        <caption>List of Employees</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">ID Pegawai</th>
                <th scope="col" class="text-center">Nama Pegawai</th>
                <th scope="col" class="text-center">Tanggal Lahir</th>
                <th scope="col" class="text-center">Gender</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Nomor HP</th>
                <th scope="col" class="text-center">Kualifikasi</th>
                <th scope="col" class="text-center">Username</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr onclick="window.location.href='/admin/pegawai/{{ $employee->id }}';" style="cursor: pointer;">
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->user->name }}</td>
                <td>{{ $employee->user->birth_date }}</td>
                <td>{{ $employee->user->gender }}</td>
                <td><a href="mailto:{{ $employee->user->email }}">{{ $employee->user->email }}</a></td>
                <td>{{ $employee->user->phone }}</td>
                <td>{{ $employee->qualification }}</td>
                <td>{{ $employee->user->username }}</td>
                <td class="project-actions text-center">
                    <form action="{{ route('admin.pegawai.destroy', $employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?')">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                        <a href="/admin/pegawai/{{ $employee->id }}/edit" class="btn btn-sm btn-warning">
                            <i class="fa fa-edit"></i>
                            Edit
                        </a>
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