@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Master Dokter                 
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
    <table class="table-dark table-striped text-center" id="table">
        <caption>List of Superadmins</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">ID Dokter</th>
                <th scope="col" class="text-center">Nama Dokter</th>
                <th scope="col" class="text-center">Spesialisasi</th>
                <th scope="col" class="text-center">Tanggal Lahir</th>
                <th scope="col" class="text-center">Gender</th>
                <th scope="col" class="text-center">Address</th>
                <th scope="col" class="text-center">Username</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Nomor HP</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($superadmins as $superadmin)
            <tr onclick="window.location.href='/admin/dokter/{{ $superadmin->id }}';" style="cursor: pointer;">
                <td>{{ $superadmin->id }}</td>
                <td>{{ $superadmin->name }}</td>
                <td>{{ $superadmin->employee->qualification }}</td>
                <td>{{ $superadmin->birth_date->format('Y-m-d') }}</td>
                <td>{{ $superadmin->gender }}</td>
                <td>{{ $superadmin->address }}</td>
                <td>{{ $superadmin->username }}</td>
                <td><a href="mailto:{{ $superadmin->email }}">{{ $superadmin->email }}</a></td>
                <td>{{ $superadmin->phone }}</td>
                <td class="project-actions text-center">
                    <a href="/admin/dokter/{{ $superadmin->id }}/edit" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit"></i>
                        Edit
                    </a>
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