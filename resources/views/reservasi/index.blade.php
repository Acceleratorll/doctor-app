@extends('layouts.main')

@section('header')
<h1 class="m-0">
    Master Reservasi
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
            @elseif($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @endif
            <div class="row" style="height: 10px"></div>
            <div class="card">
                <div class="card-body">
                    <div class="button-action" style="margin-bottom: 20px">
                        <button type="button" class="btn btn-primary" onclick="location.href='/admin/pasien/create'">
                            <span>+ Add Items</span>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            @if($reservations->count() < 1) Tidak ada Data Pasien @else <thead>
                                <tr>
                                    <th scope="col" class="text-center">Reservasi Code</th>
                                    <th scope="col" class="text-center">Nama Pasien</th>
                                    <th scope="col" class="text-center">Doktor</th>
                                    <th scope="col" class="text-center">Jadwal</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">No Urut</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)
                                    <tr>
                                        <td class="text-center">{{ $reservation->reservation_code }}</td>
                                        <td class="text-center">{{ $reservation->patient->user->name }}</td>
                                        <td class="text-center">{{ $reservation->schedule->employee->user->name }}</td>
                                        <td class="text-center">{{ $reservation->schedule->schedule_date . ' / ' .
                                            $reservation->schedule->schedule_time }}</td>
                                          <td class="text-center">
                                            @if($reservation->status == 0)
                                            Menunggu
                                            @endif

                                            @if($reservation->status == 1)
                                            Diproses
                                            @endif

                                            @if($reservation->status == 2)
                                            Reservasi Selesai
                                            @endif
                                        </td>
                                        <td>{{ $reservation->getQueueAttribute() }}</td>

                                        <td class="project-actions text-center">

                                            <a href="/reservation/{{ $reservation->id }}/edit"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                        </td>
                                        @endforeach
                                </tbody>
                                @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


</body>

</html>
@endsection
