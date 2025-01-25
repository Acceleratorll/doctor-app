@extends('layouts.mainweb')

@section('content')

<section class="announcement">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="announcement-content">
                    <h2 class="announcement-title">Pengumuman</h2>
                    @forelse(auth()->user()->patient->unreadNotifications as $announcement)
                    <div class="announcement-item">
                        <div class="announcement-image">
                            <img src="{{ Illuminate\Support\Facades\Storage::url($announcement->data['image'])}}">
                        </div>
                        <div class="announcement-details">
                            <p class="announcement-title"><b>{{ $announcement->data['content'] }}</b></p>
                            <p class="announcement-description">
                                {{ $announcement->data['title'] }} <br>
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
                            <img src="{{ Illuminate\Support\Facades\Storage::url($announcement->image)}}">
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
{{ auth()->user()->patient->unreadNotifications->where('type', 'App\Notifications\Announcement')->markAsRead() }}
<script>
    $(document).ready(function() {
        $('#toggleHistory').on('click', function() {
            $('#historySection').slideToggle();
        });
    });
</script>
@endsection
