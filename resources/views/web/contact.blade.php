@extends('layouts.mainweb')

@section('content')
        
        <!-- ========================= 
                Google Map
        =========================  -->
        <section class="google-map py-0">
        <iframe width="1290" height="383" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=1290&amp;height=383&amp;hl=en&amp;q=Jl.%20Soekarno%20Hatta%20No.9%20Malang+(Polinema)&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://maps-iframe.net/'>auf www.maps-iframe.net</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=56cd06a96d6f0f66c039b65327dd40d70e6d95b2'></script>
        </section><!-- /.GoogleMap -->

        <!-- ==========================
            contact layout 1
        =========================== -->
        <section class="contact-layout1 pt-0 mt--100">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <div class="contact-panel d-flex flex-wrap">
                <form class="contact-panel__form" method="post" action="assets/php/contact.php" id="contactForm">
                    <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                        <div class="heading-layout2">
                            <h3 class="heading__title">Hi, Salam Sehat!</h3>
                        </div>
                        <div class="testimonial-item">
                            <h5 class="testimonial__title">“Dokter di Poliklinik termasuk praktisi berkualifikasi tinggi yang berasal dari berbagai latar belakang dan membawa keragaman
                            keterampilan, minat khusus dan juga memiliki perawat yang bersedia untuk melakukan triase
                            setiap masalah mendesak, serta staf administrasi dan pendukung lainnya. Semuanya memiliki keterampilan yang luar biasa”
                            </h5>
                        </div>
                        </div>
                    </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                </form>
                <div
                    class="contact-panel__info d-flex flex-column justify-content-between bg-overlay bg-overlay-primary-gradient">
                    <div class="bg-img"><img src="assets/images/banners/1.jpg" alt="banner"></div>
                    <div>
                    <h4 class="contact-panel__title color-white">Contacts</h4>
                    <p class="contact-panel__desc font-weight-bold color-white mb-30">Jangan ragu untuk menghubungi staf kami yang ramah dengan pertanyaan medis apa pun.
                    </p>
                    </div>
                    <div>
                    <ul class="contact__list list-unstyled mb-30">
                        <li>
                        <i class="icon-phone"></i><a href="tel:+5565454117">Emergency Tlpn: {{ $doctor->phone }}</a>
                        </li>
                        <li>
                        <i class="icon-location"></i><a href="#">Location: {{ $doctor->address }}</a>
                        </li>
                        <li>
                        <i class="icon-clock"></i><a href="#">Senin - Sabtu: 8:00 - 18:00</a>
                        </li>
                    </ul>
                    <a href="https://wa.me/{{ $doctor->phone }}" class="btn btn__white btn__rounded btn__outlined">Contact Us</a>
                    </div>
                </div>
                </div>
            </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.contact layout 1 -->

@endsection
@section('container')
    
@endsection