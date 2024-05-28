<div class="container">
    <div class="row p-3 border mb-3">
        <div class="col">
            <h1 class="text-uppercase fw-semibold">Rekam Medik Poli GIGI</h1>
        </div>
        <div class="col">
            <div class="label-colon">
                <pre>Nomor          <strong>: {{ $record->reservation->reservation_code }}</strong></pre>
            </div>
            <div class="label-colon">
                <pre>Nama           <strong>: {{ $record->reservation->patient->user->name }}</strong></pre>
            </div>
            <div class="label-colon">
                <pre>Umur/JK        <strong>: {{ date('Y') - date('Y', strtotime($record->reservation->patient->user->birth_date)) }} / {{ $record->reservation->patient->user->gender }}</strong></pre>
            </div>
            <div class="label-colon">
                <pre>Alamat         <strong>: {{ $record->reservation->patient->user->address }}</strong></pre>
            </div>
            <div class="label-colon">
                <pre>Jenis          <strong>: {{ $record->reservation->bpjs ? 'BPJS' : 'UMUM' }}</strong></pre>
            </div>
        </div>
    </div>
    <div class="row border p-3 mb-3">
        <p class="judul text-uppercase">Keluhan</p>
        <p style="font-size: 10px">ANAMNESA (dari penderita/orang lain)</p>
        <div style="margin-top: 150px">
            <p>
                {{ $record->complaint }}
            </p>
        </div>
    </div>
    <div class="row border p-3 text-uppercase mb-3">
        <p class="judul text-uppercase">Pemeriksaan Fisik</p>
        <p>{{ $record->physical_exam }}</p>
    </div>
    <div class="row border p-3 mb-3">
        <p class="judul text-uppercase">Diagnosa</p>
        <p>
            {{ $record->diagnosis }}
        </p>
    </div>
    <div class="row border p-3 mb-3">
        <p class="judul text-uppercase">Tindakan</p>
        <p>
            {{ $record->action }}
        </p>
    </div>
    <div class="row border p-3 mb-3">
        <p class="judul text-uppercase">Anjuran</p>
        <p>
            {{ $record->recommendation }}
        </p>
    </div>
    @if ($record->desc)
    <div class="row border p-3 mb-3">
        <p class="judul text-uppercase">Catatan</p>
        <p>
            {{ $record->desc }}
        </p>
    </div>
    @endif
</div>