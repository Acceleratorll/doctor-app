@extends('layouts.mainweb')

@section('content')
<div class="row" style="margin-bottom: 150px; margin-top: 150px;">
        <div class="container">
        <h1>Current Queue Number</h1>
        <p>Your queue number for the current schedule is: 
        <strong>
            @if(isset($antrian))
            {{ $antrian }}
            @else
            {{ $current_queue->nomor_urut }}
            @endif
        </strong></p>
    </div>
    </div>
@endsection
