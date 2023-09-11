@extends('layouts.mainweb')

@section('content')
<header class="bg-light py-5">
    <div class="container px-5">
        @if(isset($schedule))
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h1 class="display-5 fw-bolder text-black mb-3">Jadwal Saat Ini</h1>
                    <p class="lead fw-bolder text-black mb-2">{{ \Carbon\Carbon::parse($schedule->schedule_date)->format('l, d F Y') }}</p>
                    <p class="lead fw-bolder text-black mb-1">
                        {{ \Carbon\Carbon::parse($schedule->schedule_time)->format('H:i') }}
                        -
                        {{ \Carbon\Carbon::parse($schedule->schedule_time_end)->format('H:i') }}
                    </p>
                    {{-- <p class="lead fw-bolder text-black mb-1">Hingga</p>
                    <p class="lead fw-bolder text-black mb-1">{{ \Carbon\Carbon::parse($schedule->schedule_time_end)->format('H:i') }}</p> --}}
                </div>
            </div>
            <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                <h1 class="display-5 fw-bolder text-black mb-2">Nomor Antrian</h1>
                <h1 class="display-5 fw-bolder text-black-50 mb-2">{{ $current_queue }}</h1>
            </div>
        </div>
        @else
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h1 class="display-5 fw-bolder text-black mb-2">Belum ada Jadwal untuk Saat Ini</h1>
                </div>
            </div>
        </div>
        @endif

    </div>
</header>
@endsection
