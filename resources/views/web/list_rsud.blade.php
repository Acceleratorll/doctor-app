@extends('layouts.mainweb')

@section('content')
    <!-- ========================
        Services Layout 1
    =========================== -->
    <section class="services-layout1 pt-130">
        <div class="bg-img"><img src="assets/images/backgrounds/2.jpg" alt="background"></div>
        <div class="container">
            <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-60">
                <h3 class="heading__title">List Jadwal {{ $place->name }}</h3>
                <h2 class="heading__subtitle" style="margin-top: -10px;">Kunjungi kami di {{ $place->address }}</h2>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <div class="row">
            <!-- service item #1 -->
            @foreach($schedules as $date => $schedules)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i ></i>
                    <i class="icon-head"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">{{ \Carbon\Carbon::parse($date)->format('l, d-m-Y') }}</h5>
                @foreach($schedules as $schedule)
                    <h5 class="service__title">{{ \Carbon\Carbon::parse($schedule->schedule_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->schedule_time_end)->format('H:i') }}</h5>
                @endforeach
                    <br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            @endforeach
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.Services Layout 1 -->

@endsection

@section('container')
    
@endsection