@extends('layouts.main')

@section('header')
<h1 class="m-0">
    Tambah Pasien
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
        <form action="/admin/reservation/{{ $reservation->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="code">Reservation Code</label>
                        <input type="number" class="form-control" name="reservation_code" value="{{ $reservation->reservation_code }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="patient_id">Pasien</label>
                        <select class="form-control" name="patient_id" id="namapasien" required>
                            @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group flex-fill">
                        <label for="showBpjs">Edit Image ?</label>&emsp;&emsp;
                        <input class="form-check-input" type="checkbox"  id="showBpjsCheckbox">
                        <input class="form-check-input" type="number" name="hide_button" id="hide_button" value="0" hidden>
                    </div>
                    <div class="form-group" id="file_input" hidden>
                        <label for="bpjs">BPJS</label>
                        <div class="form-check form-switch" id="bpjs-switch">
                            <input class="form-check-input" type="checkbox" id="bpjsCheckbox"">
                            <label class="form-check-label" for="flexSwitchCheckDefault">BPJS</label>
                            <input type="number" id="bpjs" name="bpjs" value="{{ $reservation->bpjs }}" hidden>
                        </div>
                        <div class="form-group" id="con-pembayaran">
                            <label for="queue_number">Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" readonly>
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
                </div>
                    <div class="form-group">
                        <label for="code">Nomor Antrian</label>
                        <input type="number" class="form-control" name="reservation_code" value="{{ $reservation->nomor_urut }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="schedule">Jadwal</label>
                        <select name="schedule_id" id="schedule" class="form-control">
                            <option value="0">- Pilih Jadwal -</option>
                            <option value="{{ $reservation->schedule_id }}" selected>{{ \Carbon\Carbon::parse($reservation->schedule->schedule_date)->format('l, d F Y'). ' / ' . $reservation->schedule->schedule_time }}</option>
                            @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}">{{ \Carbon\Carbon::parse($schedule->schedule_date)->format('l, d F Y') . ' / ' .
                                $schedule->schedule_time }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0"@if($reservation->status == 0) selected @endif>Belum Periksa</option>
                            <option value="1"@if($reservation->status == 1) selected @endif>Sudah Periksa</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary" data-toggle="modal"
                    data-target="#modalconfirm">Simpan</button>
                <a href="window.history.go(-1); return false;" class="btn btn-warning" >Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    $("#namapasien").select2();
    $("#schedule").select2();
    const showBpjsCheckbox = document.getElementById('showBpjsCheckbox');
    const hide_button = document.getElementById('hide_button');
    const fileInputContainer = document.getElementById('file_input');
    const employee = document.getElementById('employee');
    const scheduleSelect = document.getElementById('schedule_id');
    const conPembayaran = document.getElementById('con-pembayaran');
    const bpjsCheckbox = document.getElementById('bpjsCheckbox');
    const bpjsFieldsContainer = document.getElementById('bpjsFieldsContainer');
    const bpjs = document.getElementById('bpjs');
    
    showBpjsCheckbox.addEventListener('change', function () {
        if (showBpjsCheckbox.checked) {
            hide_button.value = 1;
            fileInputContainer.removeAttribute('hidden');
        } else {
            hide_button.value = 0;
            fileInputContainer.setAttribute('hidden', 'true');
        }
    });
    
    if (bpjs.value === "1") {
        bpjs.value = '1';
        bpjsCheckbox.checked = true;
        bpjsFieldsContainer.style.display = 'block';
        conPembayaran.style.display = 'none';
    } else {
        bpjs.value = '0';
        bpjsCheckbox.checked = false;
        bpjsFieldsContainer.style.display = 'none';
        conPembayaran.style.display = 'block';
    }

    bpjsCheckbox.addEventListener('change', function () {
        bpjsFieldsContainer.style.display = this.checked ? 'block' : 'none';
        conPembayaran.style.display = this.checked ? 'none' : 'block';
    });
    
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
