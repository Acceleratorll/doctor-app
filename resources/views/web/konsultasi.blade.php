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
                <h3 class="heading__title">Layanan Konsultasi Online</h3>
                <h2 class="heading__subtitle" style="margin-top: -10px;">Untuk memastikan kebutuhan Anda dan keluarga akan kesehatan medis, kami menyediakan cara baru untuk berkonsultasi di
                mana pun.</h2>
                </div><!-- /.heading -->
            </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <div class="row">
            <!-- service item #1 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i class="icon-head"></i>
                    <i class="icon-head"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Lebih mudah bagi yang tinggal sendiri atau jauh dari keluarga</h5>
                    <br><br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            <!-- service item #2 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i class="icon-heart"></i>
                    <i class="icon-heart"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Mencegah penyebaran virus atau bakteri</h5>
                    <br><br><br>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            <!-- service item #3 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="service-item">
                <div class="service__icon">
                    <i class="icon-microscope"></i>
                    <i class="icon-microscope"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                    <h5 class="service__title">Data medis Anda dan keluarga akan disimpan secara online dan lebih mudah dipantau</h5>
                </div><!-- /.service__content -->
                </div><!-- /.service-item -->
            </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
        </section><!-- /.Services Layout 1 -->

    <section class="services-layout1 pt-30" style="margin-top: -40px;">
    <div class="container">
        <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-10 offset-lg-1">
            <div class="heading text-center mb-60">
            <h3 class="heading__title">Cara Menggunakan Layanan Konsultasi Online</h3>
            <h2 class="heading__subtitle" style="margin-top: -10px;">Buat janji secara online dengan dokter spesialis dan dokter umum melalui aplikasi.</h2>
            </div><!-- /.heading -->
        </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
        <div class="col-12" style="margin-top: -150px;">
            <div class="carousel-container mt-150">
            <div class="slick-carousel"
                data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "infinite":false, "arrows": false, "dots": false, "responsive": [{"breakpoint": 1200, "settings": {"slidesToShow": 3}}, {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                <!-- process item #1 -->
                <div class="process-item">
                <span class="process__number">01</span>
                <div class="process__icon">
                    <i class="icon-health-report"></i>
                </div><!-- /.process__icon -->
                <h4 class="process__title">Unduh aplikasi melalui App Store atau Play Store</h4>
                </div><!-- /.process-item -->
                <!-- process-item #2 -->
                <div class="process-item">
                <span class="process__number">02</span>
                <div class="process__icon">
                    <i class="icon-widget"></i>
                </div><!-- /.process__icon -->
                <h4 class="process__title">Login atau Sign Up menggunakan akun Anda</h4>
                </div><!-- /.process-item -->
                <!-- process-item #3 -->
                <div class="process-item">
                <span class="process__number">03</span>
                <div class="process__icon">
                    <i class="icon-doctor"></i>
                </div><!-- /.process__icon -->
                <h4 class="process__title">Pilih Dokter</h4>
                </div><!-- /.process-item -->
                <!-- process-item #4 -->
                <div class="process-item">
                <span class="process__number">04</span>
                <div class="process__icon">
                    <i class="icon-heart "></i>
                </div><!-- /.process__icon -->
                <h4 class="process__title">Lakukan Pembayaran</h4>
                </div><!-- /.process-item -->
                <!-- process-item #5 -->
                <div class="process-item">
                <span class="process__number">05</span>
                <div class="process__icon">
                    <i class="icon-stethoscope"></i>
                </div><!-- /.process__icon -->
                <h4 class="process__title">Konsultasi</h4>
                </div><!-- /.process-item -->
            </div><!-- /.carousel -->
            </div>
        </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Services Layout 1 -->

@endsection