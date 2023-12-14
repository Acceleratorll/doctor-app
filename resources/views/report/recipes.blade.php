@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Laporan Resep
    </h1>
@endsection

@section('container')
     <main>
        <section class="filters">
            <label for="date-filter">Date Filter:</label>
            <select id="date-filter">
                <option value="" selected disabled>Pilih Filter</option>
                <option value="">All</option>
                <option value="day">Hari</option>
                <option value="week">Minggu</option>
                <option value="month">Bulan</option>
            </select>
        </section>
        <a href="{{ route('cetakRecipes') }}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
        <section class="schedule">
            <table id="table" class="table table-dark table-striped text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        {{-- <th>Dokter</th> --}}
                        <th>Tanggal</th>
                        <th>Resep</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Pasien</th>
                        {{-- <th>Dokter</th> --}}
                        <th>Tanggal</th>
                        <th>Resep</th>
                    </tr>
                </tfoot>
            </table>
        </section>
    </main>
@endsection

@section('css')
@stop

@section('js')
<script>
    $(document).ready(function() {
        var columns = [
            { data: 'id', name: 'id' },
            { data: 'patientName', name: 'patientName' },
            // { data: 'doctorName', name: 'doctorName' },
            { data: 'date', name: 'date' },
            { data: 'recipe', name: 'recipe' },
        ];

        $('#table tfoot th').each( function (i) {
            var title = $('#table thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" class="tfoot" placeholder="'+title+'" data-index="'+i+'" />' );
        } );

        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            searchable: true,
            ajax: '{{ route('admin.report.table.recipes') }}',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columns: columns,
            dom: 'Bfrtip',
            colReorder: true,
            select: true
        });

        $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
            table
                .column( $(this).data('index') )
                .search( this.value )
                .draw();
        } );

        updateTable(table);
    });
    
    function updateTable(table) {
        var selectElement = document.getElementById('date-filter');
        
        selectElement.addEventListener('change', function() {
            var selectedValue = selectElement.value;
            table.ajax.url("{{ route('admin.report.table.recipes') }}?filter=" + selectedValue).load();
        });
    }
</script>
@stop