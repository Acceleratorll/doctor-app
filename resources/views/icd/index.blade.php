@extends('layouts.main')

@section('container')
<h1>ICD Search</h1>
    @include('icd.search')

    <form action="{{ route('icd.detail') }}" method="get">
        <input type="text" name="id" value="http://id.who.int/icd/entity/661232217" hidden>
        {{-- <a href="{{ route('icd.detail',[urlencode('http://id.who.int/icd/entity/661232217')]) }}">coba</a> --}}
        <button type="submit">submit</button>
    </form>
    <br>

    @if (isset($data))
        @include('icd.result')
    @endif

    @if (isset($details))
        @include('icd.detail')
    @endif
@endsection