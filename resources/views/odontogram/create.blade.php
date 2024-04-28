@extends('layouts.main')

@section('header')
<h1 class="m-0">
    ODONTOGRAM
</h1>
@endsection

@section('container')
    <div class="container">
        <div id="rcorners1">
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
            <form action="{{ route('admin.rme.gigi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="reservation_id" id="reservation_id" value="1" hidden>
                <div class="marker">Kode : {{ $reservation->reservation_code }}</i></div>
                <div class="row">
                    <div class="col-md-3">
                        @foreach ($right as $teeth)
                        <div class="select2-custom">
                            <label class="select2-label">{{ $teeth->fdi }}</label>
                            <select name="teeth[{{ $teeth->id }}][]" class="select-custom" multiple="multiple">
                                @foreach ($groups as $group)
                                <optgroup label="{{ $group->name }}">
                                    @foreach ($group->symbols as $symbol)
                                    <option value="{{ $symbol->id }}">{{ $symbol->short }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-3">
                        @foreach ($mid1 as $teeth)
                        <div class="select2-custom">
                            <label class="select2-label">{{ $teeth->fdi }}</label>
                            <select name="teeth[{{ $teeth->id }}][]" class="select-custom" multiple="multiple">
                                @foreach ($groups as $group)
                                <optgroup label="{{ $group->name }}">
                                    @foreach ($group->symbols as $symbol)
                                    <option value="{{ $symbol->id }}">{{ $symbol->short }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-3">
                        @foreach ($mid2 as $teeth)
                        <div class="select2-custom">
                            <label class="select2-label">{{ $teeth->fdi }}</label>
                            <select name="teeth[{{ $teeth->id }}][]" class="select-custom" multiple="multiple">
                                @foreach ($groups as $group)
                                <optgroup label="{{ $group->name }}">
                                    @foreach ($group->symbols as $symbol)
                                    <option value="{{ $symbol->id }}">{{ $symbol->short }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-3">
                        @foreach ($left as $teeth)
                        <div class="select2-custom">
                            <label class="select2-label">{{ $teeth->fdi }}</label>
                            <select name="teeth[{{ $teeth->id }}][]" class="select-custom" multiple="multiple">
                                @foreach ($groups as $group)
                                <optgroup label="{{ $group->name }}">
                                    @foreach ($group->symbols as $symbol)
                                    <option value="{{ $symbol->id }}">{{ $symbol->short }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>
                    <small class="form-text text-muted">*Default value 'sou'</small>
                    <br>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="occlusi">Occlusi</label>
                        <select class="form-control" name="occlusi" id="occlusi">
                            <option value="normal" selected>Normal Bite</option>
                            <option value="cross">Cross Bite</option>
                            <option value="steep">Steep Bite</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="torus_palatinus">Torus Palatinus</label>
                        <select class="form-control" name="torus_palatinus" id="torus_palatinus" required>
                            <option value="tidak ada" selected>Tidak Ada</option>
                            <option value="kecil">Kecil</option>
                            <option value="sedang">Sedang</option>
                            <option value="besar">Besar</option>
                            <option value="multiple">Multiple</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="torus_mandibularis">Torus Mandibularis</label>
                        <select class="form-control" name="torus_mandibularis" id="torus_mandibularis" required>
                            <option value="tidak ada" selected>Tidak Ada</option>
                            <option value="sisi kiri">Sisi Kiri</option>
                            <option value="sisi kanan">Sisi Kanan</option>
                            <option value="kedua sisi">Kedua Sisi</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="palatum">Palatum</label>
                        <select class="form-control" name="palatum" id="palatum" required>
                            <option value="dalam" selected>Dalam</option>
                            <option value="sedang">Sedang</option>
                            <option value="rendah">Rendah</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="diastema" class="optional-label">Diastema</label>
                        <input type="text" class="form-control" name="diastema" id="diastema" placeholder="Jelaskan gigi yang mana dan bentuknya">
                    </div>
                    <div class="col">
                        <label for="anomali" class="optional-label">Gigi Anomali</label>
                        <input type="text" class="form-control" name="anomali" id="anomali" placeholder="Jelaskan gigi yang mana dan bentuknya">
                    </div>
                    <div class="col">
                        <label for="others" class="optional-label">Lain-lain</label>
                        <input type="text" class="form-control" name="others" id="others" placeholder="Hal-hal yang tidak tercakup di atas">
                    </div>
                    <small class="form-text text-muted">Format Penulisan: nomor gigi deskripsi, nomor gigi deskripsi
                        <br>Contoh: 21 peg shape, 22 peg shape</small>
                </div>
                <div class="row justify-content-end">
                    <div class="col text-right">
                        <button type="button" class="btn btn-danger" style="width: 100px; border: 1px solid #6c757d;" onclick="window.history.back();">Batal</button>
                        <button type="submit" class="btn btn-primary" style="width: 100px; border: 1px solid #6c757d;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')    
    <style>
        .row{
            margin-bottom: 10px;
        }
        .select2-custom{
            display: flex;
        }
        /* Style for Select2 label */
        .select2-label {
            display: inline-block;
            padding: 6px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            background-color: #343a40;
            color: white;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        .select2-label:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0,123,255,.25);
        }
        .optional-label::before {
            content: "*";
            color: #999;
            margin-right: 5px;
        }
        .marker {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 16px;
            opacity: 0.8;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#sidebarcollapse').on('click',function(){
                $('#sidebar').toggleClass('active');
            });
            $('.select-custom').select2({
                closeOnSelect: false,
                placeholder: "sou",
                allowClear: true
            });
            
            // Tambahkan event listener untuk setiap select
            $('.select-custom').on('change', function() {
                // Cek apakah ada option yang dipilih dengan value 'dia'
                var isDiastemaSelected = $(this).find('option:selected').filter(function() {
                    return this.text === 'dia'; // Sesuaikan jika value untuk 'dia' berbeda
                }).length > 0;
                
                if(isDiastemaSelected) {
                    $('#diastemaInput').show();
                } else {
                    $('#diastemaInput').hide();
                }
            });
        });

        var dropdown = document.getElementsByClassName("dropdown-btn");
        for (var i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
                } else {
                dropdownContent.style.display = "block";
                }
            });
        }
    </script>
@endsection