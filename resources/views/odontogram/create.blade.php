@extends('layouts.main')

@section('header')
<h1 class="m-0">
    ODONTOGRAM
</h1>
@endsection

@section('container')
    <div class="container">
        <div id="rcorners1">
            <form action="{{ route('admin.rme.gigi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="reservation_id" id="reservation_id" value="1" hidden>
                <div class="row">
                    <div class="col-auto align-self-start text-left">
                        <div class="mb-2">
                            <div class="text-muted small">Kode Reservasi</div>
                            <h4 class="m-0">{{ $reservation->reservation_code }}</h4>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="mb-2">
                            <div class="text-muted small">Nama Pasien</div>
                            <h4 class="m-0">{{ $reservation->patient->user->name }}</h4>
                        </div>
                    </div>
                    <div class="col-auto align-self-end text-right">
                        <div class="mb-2">
                            <small class="text-muted d-block mb-1">Riwayat RME</small>
                            <button type="button" class="btn btn-link p-0" data-toggle="modal" data-patient-id="{{ $reservation->patient_id }}" data-target="#odontogramModal">
                                Lihat RME Terakhir
                            </button>
                        </div>
                    </div>
                </div>
                </div>
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
                        <small class="form-text text-muted">Pastikan telah memilih diastema, anomali atau other sesuai dengan gigi</small>
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
    
    <!-- Modal -->
    <div class="modal fade" id="odontogramModal" tabindex="-1" role="dialog" aria-labelledby="odontogramModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="odontogramModalLabel">ODONTOGRAM TERAKHIR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div id="odontogramData"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-primary" id="more-info-link" target="_blank">More Information</a>
                </div>
            </div>
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
        function showSweetAlert(type, message) {
            Swal.fire({
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 2000 // Change this value to adjust the display time
            });
        }

        function loadOdontogramData(patientId) {
            $.ajax({
                url: '/admin/rme/gigi/fetch/'  + patientId,
                method: 'GET',
                data: { patient_id: patientId },
                success: function(response) {
                    var htmlContent = '<ul>';
                    htmlContent += '<div class="row">';
                    response.odontograms.forEach(function(item, index) {
                        htmlContent += '<div class="col-4">';
                        htmlContent += '<li><strong>(' + item.tooth_number + ')</strong> : ' + item.description + '</li>';
                        htmlContent += '</div>';
                    });
                    htmlContent += '</div>';
                    htmlContent += '</ul>';

                    htmlContent += '<hr>';

                    htmlContent += '<ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap;">';
                    htmlContent += '<li style="width: 25%;" class="text-center"><strong>Occlusi:</strong><br>' + (response.additional_data.occlusi == 'cross' ? 'Cross Bite' : response.additional_data.occlusi == 'steep' ? 'Steep Bite' : 'Normal') + '</li>';
                    htmlContent += '<li style="width: 25%;" class="text-center"><strong>Torus Palatinus:</strong><br>' + response.additional_data.torus_palatinus + '</li>';
                    htmlContent += '<li style="width: 25%;" class="text-center"><strong>Torus Mandibularis:</strong><br>' + response.additional_data.torus_mandibularis + '</li>';
                    htmlContent += '<li style="width: 25%;" class="text-center"><strong>Palatum:</strong><br>' + response.additional_data.palatum + '</li>';
                    htmlContent += '</ul>';

                    $('#odontogramData').html(htmlContent);
                    $('#more-info-link').attr('href', '/admin/rme/gigi/' + response.medical_record_id + '/edit');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching odontogram data:', error);
                }
            });
        }
            
        $(document).ready(function() {
            @if ($message = Session::get('success'))
                showSweetAlert('success', '{{ $message }}');
            @elseif ($message = Session::get('error'))
                showSweetAlert('error', '{{ $message }}');
            @endif

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

            $('#odontogramModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var patientId = button.data('patient-id'); // Extract info from data-* attributes
                
                loadOdontogramData(patientId);
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