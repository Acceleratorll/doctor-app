<!DOCTYPE html>
<html lang="id">
@php
use App\Models\User;
$doctor = User::with('employee')->where('role_id', 1)->first();
@endphp
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="doctor-web">
    <link href="{{ asset('assets/images/favicon/favicon.png') }}" rel="icon">
    <title>{{ $doctor->name }}</title>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/libraries.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('css')
    </head>

    <body>
    {{-- <div class="wrapper">
        <div class="preloader">
        <div class="loading"><span></span><span></span><span></span><span></span></div>
        </div> --}}
        <!-- /.preloader -->

        @yield('content')
        <!-- ========================
        Footer
        ========================== -->
        <footer class="footer">
        <div class="footer-primary">
            <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3">
                <div class="footer-widget-about">
                    <img src="{{ asset('assets/images/logo/2.png') }}" alt="logo" class="mb-30">
                    <p class="color-gray" style="text-align: justify;">Tujuan kami adalah untuk memberikan perawatan berkualitas dengan cara yang sopan, hormat, dan penuh kasih sayang. Kami
                    berharap Anda mengizinkan kami untuk merawat Anda dan berusaha untuk menjadi pilihan pertama dan terbaik untuk perawatan
                    kesehatan keluarga Anda.
                    </p>
                </div><!-- /.footer-widget__content -->
                </div><!-- /.col-xl-2 -->
                <div class="col-sm-6 col-md-6 col-lg-2 offset-lg-1">
                <div class="footer-widget-nav">
                    <h6 class="footer-widget__title">Kantor Pusat</h6>
                    <nav>
                    <p class="color-gray" style="text-align: justify;">{{ $doctor->address }}</p>
                    </nav>
                </div><!-- /.footer-widget__content -->
                </div><!-- /.col-lg-2 -->
                <div class="col-sm-6 col-md-6 col-lg-2">
                <div class="footer-widget-nav">
                    <h6 class="footer-widget__title">Android Apps</h6>
                    <nav>
                    <p class="color-gray" style="text-align: justify;">@ dralexapps</p>
                    </nav>
                </div><!-- /.footer-widget__content -->
                </div><!-- /.col-lg-2 -->
                <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="footer-widget-contact">
                    <h6 class="footer-widget__title color-heading">Contacts</h6>
                    <ul class="contact-list list-unstyled">
                    <li>Jika Anda memiliki pertanyaan atau butuh bantuan, jangan ragu untuk menghubungi tim kami.</li>
                    <li>
                        <a href="https://wa.me/{{ $doctor->phone }}" class="phone__number">
                        <i class="icon-phone"></i> <span>{{ $doctor->phone }}</span>
                        </a>
                    </li>
                    </ul>
                    <div class="d-flex align-items-center">
                    <a href="{{ route('contact.index') }}" class="btn btn__primary btn__link mr-30">
                        <i class="icon-arrow-right"></i> <span>Get Directions</span>
                    </a>
                    <ul class="social-icons list-unstyled mb-0">
                        <li><a href="#"><i class="fa fa-envelope" style="color: #21cdc0;"></i></a></li> 
                        <li><a href="#"><i class="fab fa-instagram" style="color: #21cdc0;"></i></a></li>
                    </ul><!-- /.social-icons -->
                    </div>
                </div><!-- /.footer-widget__content -->
                </div><!-- /.col-lg-2 -->
            </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.footer-primary -->
        </footer><!-- /.Footer -->
        <button id="scrollTopBtn"><i class="fas fa-long-arrow-alt-up"></i></button>
    </div><!-- /.wrapper -->

    <script src=" {{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src=" {{ asset('assets/js/plugins.js') }}"></script>
    <script src=" {{ asset('assets/js/main.js') }}"></script>
    <script src=" {{ asset('assets/js/app.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    @stack('js')
</body>
</html>