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
        <div>
            <p style="font-size: xx-small">
                {{ $record->complaint ? $record->complaint : '-' }}
            </p>
        </div>
        <div class="divider"></div>
        <small style="font-size: 10px">ANAMNESA (dari penderita/orang lain)</small>
    </div>
    <div class="row border p-3 text-uppercase mb-3">
        <p class="judul text-uppercase">Pemeriksaan Fisik</p>
        <p style="font-size: xx-small">{{ $record->physical_exam ? $record->physical_exam : '-' }}</p>
    </div>
    <div class="row border p-3 mb-3">
        <p class="judul text-uppercase">Diagnosa</p>
        <p style="font-size: xx-small">
            {{ $record->diagnosis ? $record->diagnosis : '-' }}
        </p>
    </div>
    <div class="row border p-3 mb-3">
        <p class="judul text-uppercase">Tindakan</p>
        <p style="font-size: xx-small">
            {{ $record->action ? $record->action : '-' }}
        </p>
    </div>
    <div class="row border p-3 mb-3">
        <p class="judul text-uppercase">Anjuran</p>
        <p style="font-size: xx-small">
            {{ $record->recommendation ? $record->recommendation : '-' }}
        </p>
    </div>
    @if ($record->desc)
    <div class="row border p-3 mb-3">
        <p class="judul text-uppercase">Catatan</p>
        <p style="font-size: xx-small">
            {{ $record->desc ? $record->desc : '-' }}
        </p>
    </div>
    @endif
</div>