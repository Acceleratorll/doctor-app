@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Daftar Rekam Medis Gigi
    </h1>
@endsection

@section('container')
<div class="table-responsive">
    <table class="table table-bordered text-center" style="width: 100%; height: 100%">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Dokter</th>
                <th>Pasien</th>
                <th>Tanggal</th>
                <th>Occlusi</th>
                <th>Palatum</th>
                <th>Torus Palatinus</th>
                <th>Torus Mandibularis</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                    <td>{{  $item->id }}</td>
                    <td>{{  $item->reservation->schedule->employee->user->name }}</td>
                    <td>{{  $item->reservation->patient->user->name }}</td>
                    <td>{{  $item->created_at->format('d-m-Y') }}</td>
                    <td>{{  $item->occlusi }}</td>
                    <td>{{  $item->palatum }}</td>
                    <td>{{  $item->torus_palatinus }}</td>
                    <td>{{  $item->torus_mandibularis }}</td>
                    <td class="project-actions text-center">
                        <div class="d-flex justify-content-center">
                            <a href="/admin/rme/gigi/{{ $item->id }}/edit" class="btn btn-warning btn-sm mr-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.rme.gigi.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Odontogram ?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="tfoot-dark">
            <tr>
                <th scope="col" class="text-center">Pasien</th>
                <th scope="col" class="text-center">Tanggal</th>
                <th scope="col" class="text-center">Occlusi</th>
                <th scope="col" class="text-center">Palatum</th>
                <th scope="col" class="text-center">Torus Palatinus</th>
                <th scope="col" class="text-center">Torus Mandibularis</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@section('css')
    <style>
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .table {
            width: auto; /* Let the table take up as much width as needed */
        }

        .table th,
        .table td {
            white-space: nowrap; /* Prevent text wrapping in table cells */
        }
    </style>    
@endsection

@section('js')
    <script>

        function showSweetAlert(type, message) {
            Swal.fire({
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 2000 // Change this value to adjust the display time
            });
        }

        $(document).ready(function() {

            @if ($message = Session::get('success'))
                showSweetAlert('success', '{{ $message }}');
            @elseif ($message = Session::get('error'))
                showSweetAlert('error', '{{ $message }}');
            @endif

            var table = $('.table').DataTable({
                processing: true,
                fixedColumns: true,
                scrollCollapse: true,
                scrollX: true,
                // scrollY: 700,
                initComplete: function () {
                    this.api()
                        .columns()
                        .every(function () {
                            var column = this;
                            var title = column.footer().textContent;
            
                            // Create input element and add event listener
                            $('<input type="text" placeholder="Search ' + title + '" />')
                                .appendTo($(column.footer()).empty())
                                .on('keyup change clear', function () {
                                    if (column.search() !== this.value) {
                                        column.search(this.value).draw();
                                    }
                                });
                        });
                }
            });
        });
    </script>
@endsection