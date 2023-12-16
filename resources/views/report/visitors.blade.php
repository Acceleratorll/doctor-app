@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Laporan Kunjungan
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
        <a href="{{ route('cetakVisitors') }}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
        </button>
        <section class="schedule">
            <table border="0" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Minimum date:</td>
                        <td><input type="date" id="min" name="min"></td>
                    </tr>
                    <tr>
                        <td>Maximum date:</td>
                        <td><input type="date" id="max" name="max"></td>
                    </tr>
                </tbody>
            </table>
            <table id="table" class="table table-dark table-striped text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pasien</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Jadwal Kunjungan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Pasien</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Jadwal Kunjungan</th>
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
            { data: 'patient_id', name: 'patient_id' },
            { data: 'name', name: 'name' },
            { data: 'date', name: 'date' },
            { data: 'schedule_date', name: 'schedule_date' },
        ];

        $('#table tfoot th').each( function (i) {
            var title = $('#table thead th').eq( $(this).index() ).text();
            $(this).html('<input type="text" class="tfoot" placeholder="'+title+'" data-index="'+i+'" />' );
        } );

        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            searchable: true,
            ajax: '{{ route('admin.report.table.visitors') }}',
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
        });

        var min = $('min').val();
        var max = $('max').val();

        $('#min, #max').on('change', function() {
            // Get the values of min and max
            var minDate = $('#min').val();
            var maxDate = $('#max').val();
    
            // Construct the URL with the date range parameters
            var url = "{{ route('admin.report.table.visitors') }}";
    
            // Append min and/or max to the URL if they exist
            if (minDate && maxDate) {
                url += "?min=" + minDate + "&max=" + maxDate;
            } else if (minDate) {
                url += "?min=" + minDate;
            } else if (maxDate) {
                url += "?max=" + maxDate;
            }
    
            table.ajax.url(url).load();
        });
            
        var selectElement = document.getElementById('date-filter');
        selectElement.addEventListener('change', function() {
            var selectedValue = selectElement.value;
            table.ajax.url("{{ route('admin.report.table.visitors') }}?filter=" + selectedValue).load();
            $url = "{{ route('admin.report.table.visitors') }}?filter=" + selectedValue;
            console.log($url);
        });
    });
</script>
@stop