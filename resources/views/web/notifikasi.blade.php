@extends('layouts.mainweb')

@section('content')
        <!-- ========================
        Info Terkait 
        =========================== -->
        <section class="shop-grid">
            <div class="bg-img"><img src="assets/images/backgrounds/2.jpg" alt="background"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3" style="margin-top: -70px;">
                        <div class="heading text-center mb-40">
                            <h3 class="heading__title">Notifikasi</h3>
                        </div><!-- /.heading -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
                @if($praktikUmum != null)
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="service-item">
                        <div class="service__content">
                            <h5 class="service__title">Saat Ini Dokter Sedang Melakukan Praktek di {{ $praktikUmum->place->name }}
                                <a href="/notifikasi-remove/1" class="btn btn__secondary btn__rounded" style="float: right;">
                                    <span>Oke</span></i>
                                </a>
                            </h5>
                            <h1 class="heading__subtitle" style="margin-top: -25px;">{{ \Carbon\Carbon::parse($today)->format('l, d-m-Y') }}</h1>
                        </div><!-- /.service__content -->
                    </div><!-- /.service-item -->
                </div>
                @endif
                @if($praktikGigi != null)
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="service-item">
                        <div class="service__content">
                            <h5 class="service__title">Saat Ini Dokter {{ $praktikGigi->schedule_type->name }} Sedang Melakukan Praktek di {{ $praktikGigi->place->name }}
                                <a href="/notifikasi-remove/1" class="btn btn__secondary btn__rounded" style="float: right;">
                                    <span>Reservasi</span></i>
                                </a>
                            </h5>
                            <h1 class="heading__subtitle" style="margin-top: -25px;">{{ \Carbon\Carbon::parse($today)->format('l, d-m-Y') }}</h1>
                        </div><!-- /.service__content -->
                    </div><!-- /.service-item -->
                </div>
                @endif
                @if ($reservation != null)
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="service-item">
                        <div class="service__content">
                            <h5 class="service__title">Cek Antrian
                                <a href="#antrian" class="btn btn__secondary btn__rounded" data-toggle="collapse" aria-expanded="false" style="float: right;">
                                    <span>Lihat Antrian</span></i>
                                </a>
                            </h5>
                            <h1 class="heading__subtitle" style="margin-top: -25px;">{{ \Carbon\Carbon::parse($today)->format('l, d-m-Y') }}</h1>
                            <div class="collapse multi-collapse" id="antrian">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 col-lg-6">
                                        <div class="service-item">
                                            <div class="service__icon">
                                                <i class=""></i>
                                                <i class="icon-head"></i>
                                            </div><!-- /.service__icon -->
                                            <div class="service__content">
                                                <h5 class="service__title">Antrian Saai Ini</h5>
                                                <h1 class="slide__title" style="text-align: center; font-size: 90px;">{{ $queueNow->nomor_urut }}</h1>
                                            </div><!-- /.service__content -->
                                        </div><!-- /.service-item -->
                                    </div><!-- /.col-lg-4 -->
                                    <!-- service item #2 -->
                                    <div class="col-sm-12 col-md-8 col-lg-6">
                                        <div class="service-item">
                                            <div class="service__icon">
                                                <i class=""></i>
                                                <i class="icon-heart"></i>
                                            </div><!-- /.service__icon -->
                                            <div class="service__content">
                                                <h5 class="service__title">Antrian Anda</h5>
                                                <h1 class="slide__title" style="text-align: center; font-size: 90px;">{{ $reservation->nomor_urut }}</h1>
                                            </div><!-- /.service__content -->
                                        </div><!-- /.service-item -->
                                    </div><!-- /.col-lg-4 -->
                                </div>
                            </div>
                        </div><!-- /.service__content -->
                        
                    </div><!-- /.service-item -->
                </div><!-- /.col-lg-4 -->
                <!-- /.col-lg-4 -->

                @endif<!-- /.col-lg-4 -->
            </div><!-- /.container -->
        </section><!-- /.shop -->
{{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\ReservationReminder')->markAsRead() }}
<script>
        var header = document.getElementById("collapse1");
        var btns = header.getElementsByClassName("card");
    for (var i = 0; i <btns.length; i++){
        btns[i].addEventListener("click", function (){
            var current =
            document.getElementsByClassName('active-card');
            current[0].className =
            current[0].className.replace("active-card","");
            this.className += "active-card";
        });
    };
    var cards = document.querySelectorAll(".date");

    cards.forEach(function(card) {
    card.addEventListener("click", function() {
        var currentActiveCard = document.querySelector(".active-card1");
        if (currentActiveCard) {
            currentActiveCard.classList.remove("active-card1");
        }
            this.classList.add("active-card1");
        });
    });

    </script>
@endsection
