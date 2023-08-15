@extends('layouts.main')

@section('header')
    <h1 class="m-0">
        Login ICD                  
    </h1>
@endsection

@section('container')
    <h1>Login to ICD API</h1>
    <a href="{{ route('icd.login') }}" class="btn btn-primary">Login with ICD</a>
@endsection