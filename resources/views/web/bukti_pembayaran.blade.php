@extends('layouts.mainweb')

@section('content')

<style>
    .image-preview {
        margin-bottom: 20px;
    }

    .image-preview img {
        max-height: 120px;
        max-width: 100px;
    }
</style>

<div class="about-layout4 pb-0 ">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        {{ $message }}
    </div>
    @elseif($message =  Session::get('error'))
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @endif
    <div class="row ">
        <div class="col-md-2">
            <div class="px-5 py-5">
                <ul class=" list-items list-items-layout3 list-unstyled">
                    <li>
                        <h6>Pilih Tempat</h6>
                    </li>
                    <li>
                        <h6>Pilih Dokter</h6>
                    </li>
                    <li>
                        <h6>Alur Jadwal</h6>
                    </li>
                    <li>
                        <h6>Konfirmasi Data</h6>
                    </li>
                </ul>
                <ul class="package__list list-items list-items-layout2 list-unstyled">
                    <li>
                        <h6>Bukti Pembayaran</h6>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row" style="margin-top: 50px; margin-left: 25px;">
            <div class="form-container">
                <form id="default-form" action="{{ route('reservasi.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $request->type }}" name="type">
                    <div class="row">
                        <div class="-col-md-4">
                            <div class="file-input">
                                <label for="bukti_pembayaran">Upload Bukti Pembayaran</label>
                                <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran" accept=".jpg, .jpeg, .png, .pdf" required>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="image-preview">
                                <img id="preview-image" src="">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="schedule_date" value="{{ $request->schedule_date }}">
                    <input type="hidden" name="schedule_time" value="{{ $request->schedule_time }}">
                    <input type="hidden" name="nomor_urut" value="{{ $request->nomor_urut }}">
                    <input type="hidden" name="reservation_code" value="{{ $request->reservation_code }}">
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" id="kembali-btn">Kembali</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <form id="alternative-form" action="{{ route('reservasi.store') }}" method="post" enctype="multipart/form-data" style="display: none;">
                    @csrf
                    <div class="row" style="margin-bottom: 20px">
                        <div class="-col-md-4">
                            <div class="file-input">
                                <label for="ktp">Upload KTP</label>
                                <input type="file" class="form-control" name="ktp" id="ktp" accept=".jpg, .jpeg, .png" required>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="image-preview">
                                <img id="ktp-image" src="">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px">
                        <div class="-col-md-4">
                            <div class="file-input">
                                <label for="surat_rujukan">Upload Surat Rujukan</label>
                                <input type="file" class="form-control" name="surat_rujukan" id="surat_rujukan" accept=".jpg, .jpeg, .png" required>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="image-preview">
                                <img id="surat-image" src="">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px">
                        <div class="-col-md-4">
                            <div class="file-input">
                                <label for="bpjs_card">Upload Kartu BPJS</label>
                                <input type="file" class="form-control" name="bpjs_card" id="bpjs_card" accept=".jpg, .jpeg, .png" required>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                                <div class="image-preview">
                                    <img id="bpjs-image" src="">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="schedule_date" value="{{ $request->schedule_date }}">
                        <input type="hidden" name="schedule_time" value="{{ $request->schedule_time }}">
                        <input type="hidden" name="nomor_urut" value="{{ $request->nomor_urut }}">
                        <input type="hidden" name="reservation_code" value="{{ $request->reservation_code }}">
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary" id="kembali-btn">Kembali</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <!-- Dropdown to select form option -->
            </div>
        </div>
        <div class="row" style="margin-top: 50px; margin-left: 50px">
            <div class="-col-md-12 justify-content-end">
                <select id="bpjs" name="bpjs" class="form-control">
                    <option value="0">Bayar</option>
                    <option value="1">BPJS</option>
                </select>
            </div>
        </div><br><br>
    </div>
</div>

<script>
    var bpjs = document.getElementById('bpjs');
    var defaultForm = document.getElementById('default-form');
    var alternativeForm = document.getElementById('alternative-form');
    
    bpjs.addEventListener('change', function() {
        var selectedOption = this.value;
        if (selectedOption == '1') {
            defaultForm.style.display = 'none';
            alternativeForm.style.display = 'block';
        }else{
            defaultForm.style.display = 'block';
            alternativeForm.style.display = 'none';
        }
    });

    var previewImage = document.getElementById('preview-image');
    var ktpImage = document.getElementById('ktp-image');
    var suratImage = document.getElementById('surat-image');
    var bpjsImage = document.getElementById('bpjs-image');

    document.getElementById('ktp').addEventListener('change', function(e) {
        var uploadedImage = e.target.files[0];
        ktpImage.src = URL.createObjectURL(uploadedImage);
        ktpImage.style.display = 'block';
    })

    document.getElementById('surat_rujukan').addEventListener('change', function(e) {
        var uploadedImage = e.target.files[0];
        suratImage.src = URL.createObjectURL(uploadedImage);
        suratImage.style.display = 'block';
    })

    document.getElementById('bpjs_card').addEventListener('change', function(e) {
        var uploadedImage = e.target.files[0];
        bpjsImage.src = URL.createObjectURL(uploadedImage);
        bpjsImage.style.display = 'block';
    })

    document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
        var uploadedImage = e.target.files[0];
        previewImage.src = URL.createObjectURL(uploadedImage);
        previewImage.style.display = 'block';
    });

    document.getElementById('kembali-btn').addEventListener('click', function() {
        window.window.history.go(-1); return false;;
    });
</script>

@endsection