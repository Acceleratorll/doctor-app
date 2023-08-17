@extends('layouts.main')

@section('container')
<h1>ICD Search</h1>
    <form action="{{ route('icd.search') }}" method="POST">
        @csrf
        <input class="form-control" type="text" name="term" placeholder="Enter search term"> <br>
        <button class="btn btn-primary" type="submit">Search</button>
    </form>

    <br>

    @if (isset($data))
    <h2>Search Results:</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Chapter</th>
                <th>ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['destinationEntities'] as $entity)
                <tr>
                    <td>{!! $entity['title'] !!}</td>
                    <td>{!! $entity['chapter'] !!}</td>
                    <td>{!! $entity['id'] !!}</td>
                    <td>
                        {{-- <form method="POST" action="{{ route('icd.detail',['url' => substr(strrchr($entity['id'], '/'), 1)]) }}"> --}}
                        <form method="POST" action="{{ route('icd.show') }}">
                            @csrf
                            <input type="text" name="id" value="{{ substr(strrchr($entity['id'], '/'), 1) }}" hidden>
                            <button type="submit" class="btn btn-primary">More Details</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    {{-- @if (isset($details))
        @include('icd.detail')
    @endif --}}
@endsection