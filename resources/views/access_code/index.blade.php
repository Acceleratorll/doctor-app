@extends('layouts.mainweb')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Input Your Pin</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="get" action="{{ route('verifyCode') }}">
                        @csrf
                        <div class="form-group">
                            <label for="pin">Enter your 4-digit Pin:</label>
                            <input type="password" class="form-control @error('pin') is-invalid @enderror" name="access_code" style="font-size: 24px; maxlength="4" pattern="[0-9]*" inputmode="numeric" required>
                            @error('pin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection