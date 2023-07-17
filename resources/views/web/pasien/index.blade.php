@extends('layouts.mainweb')

@section('content')

<section class="profile-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="profile-card">
                        <div class="profile-header">
                            <div class="profile-avatar">
                                <img src="" alt="Profile Avatar">
                            </div>
                            <h2 class="profile-name"></h2>
                            <p class="profile-email"></p>
                        </div>
                        <div class="profile-body">
                            <div class="profile-info">
                                <div class="info-item">
                                    <span class="info-label">Tanggal Lahir:</span>
                                    <span class="info-value"></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Jenis Kelamin:</span>
                                    <span class="info-value"></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Alamat:</span>
                                    <span class="info-value"></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Nomor Telepon:</span>
                                    <span class="info-value"></span>
                                </div>
                            </div>
                            <div class="profile-actions">
                                <a href="" class="btn btn-primary">Edit Profil</a>
                                <a href="" class="btn btn-secondary">Ubah Kata Sandi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection