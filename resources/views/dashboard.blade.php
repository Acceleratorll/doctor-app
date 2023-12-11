@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Dashboard
    </h1>
@endsection

@section('container')
    <main>
        <section>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box" style="background:#2c3034">
                        <div class="inner">
                            <h3 id="totalPatientsCount">{{ $total_patients }}</h3>
                            <p>Total Pasien</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users" style="color: #1a1d20;font-size:60px"></i>
                        </div>
                        <a href="{{ route('admin.pasien.index') }}" class="small-box-footer" style="background: #1a1d20">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box" style="background:#2c3034">
                        <div class="inner">
                            <h3 id="waitingListCount">{{ $waiting_list }}</h3>
                            <p>Menunggu Approval</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars" style="color: #1a1d20"></i>
                        </div>
                        <a href="{{ route('admin.waiting-list') }}" class="small-box-footer" style="background: #1a1d20">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box" style="background:#2c3034">
                        <div class="inner">
                            <h3 id="patientsTodayCount">{{ $patients_today }}</h3>
                            <p>Pasien hari ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph" style="color: #1a1d20"></i>
                        </div>
                        <a href="{{ route('admin.reservation.index') }}" class="small-box-footer" style="background: #1a1d20">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="filters">
            <h2>Jadwal Dokter</h2>
            <label for="date-filter">Date Filter:</label>
            <select id="date-filter">
                <option value="" selected disabled>Pilih Filter</option>
                <option value="day">Hari</option>
                <option value="week">Minggu</option>
                <option value="month">Bulan</option>
            </select>
        </section>
        <section class="schedule">
            <table id="table" class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Dokter</th>
                        <th>Spesialisasi</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Tempat</th>
                        <th>Kuota</th>
                        <th>Sisa Kuota</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </section><br>
        <section class="practice-frequency">
            <h2>Frekuensi Praktik</h2>
            <label for="practice-frequency-filter">Frekuensi Praktik Filter:</label>
            <select id="practice-frequency-filter">
                <option value="">Pilih Filter</option>
                <option value="day">Hari</option>
                <option value="week">Minggu</option>
                <option value="month">Bulan</option>
                <option value="all">Total Semua</option>
            </select>
        </section>
        <section class="patient-count">
            <table id="table-total" class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Filter</th>
                        <th>Total Pasien</th>
                    </tr>
                </thead>
            </table>
        </section>
    </main>
@endsection

@section('css')
@stop

@section('js')
<script>
    // $(document).ready(function() {
    //     $.ajax({
    //         type:'GET',
    //         data : {"_token":"{{ csrf_token() }}"},
    //         url: '/admin/get-counts',
    //         dataType: "json",
    //         success:function(data) {
    //             console.log("success");
    //             $('#waitingListCount').text(data.waiting_list);
    //             $('#patientsTodayCount').text(data.patients_today);
    //             $('#totalPatientsCount').text(data.total_patients);
    //         },
    //         error: function(data){
    //             console.log("error");
    //             console.log(data);
    //         }
    //     });
    // });

    $(document).ready(function() {
        var columns = [
            { data: 'doctor', name: 'doctor' },
            { data: 'qualification', name: 'qualification' },
            { data: 'date', name: 'date' },
            { data: 'time', name: 'time' },
            { data: 'place', name: 'place' },
            { data: 'qty', name: 'qty' },
            { data: 'qty_left', name: 'qty_left' },
            { data: 'action', name: 'action' },
        ];

        var columns2 = [
            { data: 'filter', name: 'filter' },
            { data: 'total', name: 'total' },
        ];

        var table = $('#table').DataTable({
            pageLength:5,
            processing: true,
            serverSide: true,
            searchable: true,
            ajax: '{{ route('admin.table.schedules') }}',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columns: columns,
            dom: 'Bfrtip',
            colReorder: true,
            select: true
        });
        
        var tableTotal = $('#table-total').DataTable({
            processing: true,
            serverSide: true,
            searchable: true,
            ajax: '{{ route('admin.table.doctors') }}',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columns: columns2,
            dom: 'Bfrtip',
            colReorder: true,
            select: true
        });

        updateTable(table);
        updateTable2(tableTotal);
    });
    
    function updateTable(table) {
        var selectElement2 = document.getElementById('date-filter');
        
        selectElement2.addEventListener('change', function() {
            var selectedValue2 = selectElement2.value;
    
            if (selectedValue2 === 'day') {
                console.log(selectedValue2);
                table.ajax.url("{{ route('admin.schedules.day') }}").load();
            } else if (selectedValue2 === 'week') {
                console.log(selectedValue2);
                table.ajax.url("{{ route('admin.schedules.week') }}").load();
            } else if(selectedValue2 === 'month'){
                console.log(selectedValue2);
                table.ajax.url("{{ route('admin.schedules.month') }}").load();
            }
        });
    }

    function updateTable2(table) {
        var selectElement = document.getElementById('practice-frequency-filter');
        
        selectElement.addEventListener('change', function() {
            var selectedValue = selectElement.value;
    
            if (selectedValue === 'day') {
                console.log(selectedValue);
                table.ajax.url("{{ route('admin.table.doctors.day') }}").load();
            } else if (selectedValue === 'week') {
                console.log(selectedValue);
                table.ajax.url("{{ route('admin.table.doctors.week') }}").load();
            } else if(selectedValue === 'month'){
                console.log(selectedValue);
                table.ajax.url("{{ route('admin.table.doctors.month') }}").load();
            }else if(selectedValue === 'all'){
                console.log(selectedValue);
                table.ajax.url("{{ route('admin.schedules.all') }}").load();
            }
        });
    }
</script>
@stop