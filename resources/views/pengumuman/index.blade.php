@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Daftar Pengumuman                 
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
                                    <button type="button" class="btn btn-primary" onclick="location.href='{{ url('/admin/pengumuman/create') }}'">
                                        <span>+ Add Items</span>
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table-dark table-striped" id="table">
                                        @if($announcements != null)
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="text-center">Judul</th>
                                            <th scope="col" class="text-center">Konten</th>
                                            <th scope="col" class="text-center">Image</th>
                                            <th scope="col" class="text-center">Pegawai</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($announcements as $announcement)
                                        <tr>
                                            <td>{{ $announcement->title }}</td>
                                            <td>{{ $announcement->content }}</td>
                                            <td>
                                                <img src="{{ asset('storage/'.$announcement->image)}}" class="toZoom" style="max-height: 150px; max-width: 150px;" data-zoom-image>
                                            </td>
                                            <td>{{ $announcement->employee->user->name }}</td>
                                            <td class="project-actions text-center">
                                                <form action="{{ route('admin.pengumuman.destroy', $announcement->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this announcement?')">
                                                        <i class="fas fa-trash"></i>
                                                        Delete
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-warning" onclick="location.href='/admin/pengumuman/{{ $announcement->id }}/edit'">
                                                        <i class="fa fa-edit"></i>
                                                        Edit
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="idMyModal modal">
                                              <span class="close">&times;</span>
                                              <img class="modal-content">
                                            </div>
                                            @endforeach
                                        @else
                                        <strong>Tidak ada Data Pengumuman</strong>
                                        @endif
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

        function showSweetAlert(type, message) {
            Swal.fire({
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 2000 // Change this value to adjust the display time
            });
        }
            
    
    $(document).ready( function () {
        @if ($message = Session::get('success'))
        showSweetAlert('success', '{{ $message }}');
        @elseif ($message = Session::get('error'))
        showSweetAlert('error', '{{ $message }}');
        @endif

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