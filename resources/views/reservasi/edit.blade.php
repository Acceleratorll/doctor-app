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
        <form action="/reservation/{{ $reservation->id }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="col">

                    <div class="form-group">
                        <label for="patient_id">Pasien</label>
                        <input type="text" class="form-control" value="{{ $reservation->patient->name }}" readonly>
                        <input type="hidden" name="patient_id" value="{{ $reservation->patient_id }}">
                    </div>

                    <div class="form-group">
                        <label for="employee">Dokter</label>
                        <select name="employee" id="employee" class="form-control">
                            <option value="0" selected>- Pilih Dokter -</option>

                            @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ $employee->id == $reservation->schedule->employee_id
                                ? 'selected' : '' }}>{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="schedule">Jadwal</label>
                        <select name="schedule_id" id="schedule_id" class="form-control">
                            <option value="0">- Pilih Jadwal -</option>
                            @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}" {{ $schedule->id == $reservation->schedule_id
                                ? 'selected' : '' }}>{{ $schedule->schedule_date . ' / ' .
                                $schedule->schedule_time }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary" data-toggle="modal"
                    data-target="#modalconfirm">Simpan</button>
                <button type="reset" class="btn btn-warning" data-toggle="modal" data-target="#modalconfirm"> Batal
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    const employee = document.getElementById('employee');
    const scheduleSelect = document.getElementById('schedule_id');
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
