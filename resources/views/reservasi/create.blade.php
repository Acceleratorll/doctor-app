@extends('layouts.main')

@section('header')
<h1 class="m-0">
    Tambah Reservasi
</h1>
@endsection

@section('container')
<div class="container">
    <div id="rcorners1">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @elseif($message =  Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @endif
        <form action="{{ route('admin.reservation.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="code">Reservasi Code</label>
                        <input type="number" class="form-control" name="reservation_code" id="code" value="{{ $code }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="patient_id">Pasien</label>
                        <select class="form-control" name="patient_id" id="namapasien" required>
                            @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="schedule">Jadwal</label>
                        <select name="schedule_id" id="jadwal" class="form-control" required>
                            @if($schedules->count() < 1)
                            <option value="">Tidak Ada Jadwal</option>
                            @else
                            <option value="" selected>--- Pilih Jadwal ---</option>
                            @foreach($schedules as $schedule)
                            <option value="{{ $schedule->id }}">{{\Carbon\Carbon::parse($schedule->schedule_date)->format('l, d F Y') . ' / ' .
                            $schedule->schedule_time}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                {{-- <select class="form-control" name="bpjs" id="bpjsSelect">
                                    <option value="1">Memakai BPJS</option>
                                    <option value="0" selected>Tidak Memakai BPJS</option>
                                </select> --}}
                                <div class="form-check form-switch" id="bpjs-switch">
                                    <input class="form-check-input" type="checkbox" id="bpjsCheckbox"">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Memakai BPJS</label>
                                    <input type="number" id="bpjs" name="bpjs" value="0" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="con-pembayaran">
                        <label for="queue_number">Bukti Pembayaran</label>
                        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control">
                    </div>
                    <div id="bpjsFieldsContainer" style="display: none;">
                        <div class="form-group">
                            <label for="ktp">KTP</label>
                            <input type="file" name="ktp" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="bpjs_card">Kartu BPJS</label>
                            <input type="file" name="bpjs_card" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="surat_rujukan">Surat Rujukan</label>
                            <input type="file" name="surat_rujukan" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="queue_number">Nomor Antrian</label>
                        <input type="text" name="nomor_urut" id="queue_number" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="approve">Approve</label>
                        <select name="approve" id="approve" class="form-control" required>
                            <option value="0">Not Approved Yet</option>
                            <option value="1">Approved</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="0">Belum Periksa</option>
                            <option value="1">Sudah Periksa</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary" data-toggle="modal"
                    data-target="#modalconfirm">Simpan</button>
                <a href="window.history.go(-1); return false;" class="btn btn-warning" data-toggle="modal" data-target="#modalconfirm"> Batal
                </a>
            </div>

        </form>
    </div>
</div>

<script>
    $("#namapasien").select2();
    $("#schedule").select2();

    const bpjsCheckbox = document.getElementById('bpjsCheckbox');
    const bpjsFieldsContainer = document.getElementById('bpjsFieldsContainer');
    const conPembayaran = document.getElementById('con-pembayaran');
    const bpjs = document.getElementById('bpjs');
    const surat_rujukan = document.getElementById('surat_rujukan');
    const ktp = document.getElementById('ktp');
    const bpjs_card = document.getElementById('bpjs_card');
    
    bpjsCheckbox.addEventListener('change', function () {
        bpjsFieldsContainer.style.display = this.checked ? 'block' : 'none';
        conPembayaran.style.display = this.checked ? 'none' : 'block';
        conPembayaran.setAttribute = this.checked ? '' : 'required';
        ktp.setAttribute = this.checked ? 'required' : '';
        surat_rujukan.setAttribute = this.checked ? 'required' : '';
        bpjs_card.setAttribute = this.checked ? 'required' : '';
        bpjs.value = this.checked ? '1' : '0';
        console.log(bpjs.value);
    });

    
    // bpjs.addEventListener('change', function () {
    //     if (bpjs.value === '1') {
    //         ktp.setAttribute('required', 'required');
    //         surat_rujukan.setAttribute('required', 'required');
    //         bpjs_card.setAttribute('required', 'required');
    //         conPembayaran.removeAttribute('required');
    //     } else {
    //         conPembayaran.setAttribute('required', 'required');
    //         ktp.removeAttribute('required');
    //         surat_rujukan.removeAttribute('required');
    //         bpjs_card.removeAttribute('required');
    //     }
    // });

$(document).ready(function() {
        $('#jadwal').on('change', function() {
            var selectedScheduleId = $(this).val();
            if(selectedScheduleId){
            $.ajax({
                type:'GET',
                data : {"_token":"{{ csrf_token() }}"},
                url: '/antrian/' + selectedScheduleId,
                dataType: "json",
            success:function(data) {
                console.log("success");
                document.getElementById('queue_number').value = data;
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }
    });
});
    

    const employee = document.getElementById('employee');
    const scheduleSelect = document.getElementById('schedule');

    employee.addEventListener('change', async function(e){
        const employeeId = +this.value;
        if(employeeId !== 0){
            const fetchSchedule = async () => {
                const data = await fetch(`${location.origin}/schedule/${employeeId}`);

                if(!data.ok){
                    throw new Error('Error fetch data')
                }
                const schedules = await data.json();
                scheduleSelect.innerHTML = "";
                scheduleSelect.innerHTML = `<option value="0">- Pilih Jadwal -</option>`;
                schedules.schedules.forEach(schedule => {
                    const option = `<option value="${schedule.id}">${schedule.schedule_date} / ${schedule.schedule_time}</option>`;
                    scheduleSelect.innerHTML += option;
                })
            }
            fetchSchedule().catch(error => {
                alert('Server error!');
            });
        }else{
            scheduleSelect.innerHTML = "";
            scheduleSelect.innerHTML = `<option value="0">- Pilih Jadwal -</option>`;
        }
    })
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
        $(document).ready(
            function(){
                $('#sidebarcollapse').on('click',function(){
                    $('#sidebar').toggleClass('active');
                });
            }
        )
</script>
@endsection
