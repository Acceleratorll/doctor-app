<!-- resources/views/admin/pasien/change-password.blade.php -->
@extends('layouts.main')

@section('header')
<h1 class="m-0">
    Change Password for {{ $user->name }}
</h1>
@endsection

@section('container')
<div class="container">
    <form action="{{ route('admin.user.update-password', $user->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password Baru" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary float-end">Change Password</button>
    </form>
</div>
@endsection
@section('js')
<script>
    function showSweetAlert(type, message) {
            Swal.fire({
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 2000
            });
        }

    $(document).ready(function() {
        @if ($message = Session::get('success'))
            showSweetAlert('success', '{{ $message }}');
            @elseif ($message = Session::get('error'))
            showSweetAlert('error', '{{ $message }}');
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    showSweetAlert('error', '{{ $error }}');
                @endforeach
            @endif
    });
</script>
@endsection