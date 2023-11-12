@extends('layouts.mainweb')

@section('content')

<header class="header header-layout1">
        <!-- /.header-top -->
        <nav class="navbar navbar-expand-lg sticky-navbar">
            <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/images/logo/2.png') }}" class="logo-light" alt="logo">
                <img src="{{ asset('assets/images/logo/1.png') }}" class="logo-dark" alt="logo">
            </a>
            <button class="navbar-toggler" type="button">
                <span class="menu-lines"><span></span></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavigation">
                <ul class="navbar-nav ml-auto">
                <li class="nav__item">
                    <a href="{{ route('dashboard') }}" class="nav__item-link">Home</a>
                </li>
                <!-- /.nav-item -->
                <li class="nav__item">
                    <a href="{{ route('jadwal.index') }}" class="nav__item-link">Layanan</a>
                </li><!-- /.nav-item -->
                <li class="nav__item">
                    <a href="{{ route('show.queue') }}" class="nav__item-link">Lihat Antrian</a>
                </li>
                <li class="nav__item notif">
                    <a href="{{ route('pengumuman.index') }}" class="nav__item-link active">Pengumuman</a>
                </li><!-- /.nav-item -->
                <li class="nav__item">
                    <a href="{{ route('contact.index') }}" class="nav__item-link">Contacts Us</a>
                </li><!-- /.nav-item -->
                <li class="nav__item notif">
                    <a href="{{ url('/notifikasi') }}" class="nav__item-link">Notifikasi<span>{{session('notification.count', 0)}}</span></a>
                </li><!-- /.nav-item -->
                @if(auth()->user())
                <li class="nav__item dropdown">
                                <a class="nav__item-link dropdown-toggle" href="#" role="button" id="profileDropdown"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                    
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                    <a class="dropdown-item" href="/profile">My Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                </ul><!-- /.navbar-nav -->
                <button class="close-mobile-menu d-block d-lg-none"><i class="fas fa-times"></i></button>
            </div>
            @else
            <div class="d-none d-xl-flex align-items-center position-relative ml-30">
                <a href="{{ route('login') }}" class="btn btn__primary btn__rounded ml-30">
                    <i class="icon-calendar"></i>
                    <span>Login</span>
                </a>
            </div>
            @endif
            </div><!-- /.container -->
    </nav><!-- /.navabr -->
</header><!-- /.Header -->

<section class="announcement">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="announcement-content">
                    <h2 class="announcement-title">Important Announcements</h2>
                    @forelse(auth()->user()->patient->unreadNotifications as $announcement)
                    <div class="announcement-item">
                        <div class="announcement-image">
                                <img src="{{ asset('storage/' . $announcement->image) }}">
                        </div>
                        <div class="announcement-details">
                            <p class="announcement-title"><b>{{ $announcement->data['title'] }}</b></p>
                            <p class="announcement-description">
                                {{ $announcement->data['content'] }} <br>
                                <span class="announcement-date">Posted on: {{ $announcement->data['created_at'] }}</span>
                            </p>
                        </div>
                    </div>
                    @empty
                    <p class="announcement-description">Belum Ada Pengumuman Baru. Stay Tuned ya..</p>
                    @endforelse
                </div>
            </div>
        </div><br>
        <button type="button" class="btn btn-outline-primary" id="toggleHistory">Show/Hide History</button>
        <div class="row" id="historySection" style="display: none;">
            <div class="col-md-8 offset-md-2">
                <div class="announcement-content">
                    <h2 class="announcement-title">History Announcements</h2>
                    @forelse($announcements as $announcement)
                    <div class="announcement-item">
                        <div class="announcement-image">
                                <img src="{{ asset('storage/' . $announcement->image) }}">
                        </div>
                        <div class="announcement-details">
                            <p class="announcement-title"><b>{{ $announcement->title }}</b></p>
                            <p class="announcement-description">
                                {{ $announcement->content }} <br>
                                <span class="announcement-date">Posted on: {{ $announcement->created_at->format('F d, Y') }}</span>
                            </p>
                        </div>
                    </div>
                    @empty
                    <p class="announcement-description">Belum Ada Pengumuman. Stay Tuned ya..</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
{{ auth()->user()->patient->unreadNotifications->markAsRead() }}
<script>
    $(document).ready(function() {
        $('#toggleHistory').on('click', function() {
            $('#historySection').slideToggle();
        });
    });
</script>
@endsection
