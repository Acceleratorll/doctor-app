<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -15px;
        }

        .col {
            flex: 1;
            padding: 15px;
        }

        .p-3 {
            padding: 1rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .border {
            border: 3px solid #000;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .fw-semibold {
            font-weight: 600;
        }

        h1, h4, p {
            margin: 0 0 10px 0;
        }

        .label-colon {
            display: flex;
        }

        .label-colon pre {
            margin: 0;
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .label-colon strong {
            flex-grow: 1;
            text-align: left;
            margin-left: 10px;
        }

        .examination {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .examination div {
            flex: 0 0 38%;
        }

        .examination div p {
            margin: 0;
        }
        .page-break {
            page-break-before: always;
        }
        .signature-section {
            text-align: right;
            font-size: 90%;
            margin-top: 10px;
            padding-right: 20px;
        }

        .signature-space {
            display: inline-block;
            width: 170px;
            height: 50px;
            margin-top: 30px;
            border-bottom: 1px solid #000;
            text-align: center;
        }
        .judul {
            font-size: small;
            font-weight: bold;
        }
        .divider {
            border-bottom: 1px solid #808080;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Rekam Medis {{ $record->reservation->patient->user->name }}</title>
</head>
<body>
    <div class="section">
        @include('web.pasien.rekamMedis', ['record' => $record])
    </div>
    @if ($record->reservation->schedule->schedule_type->name == 'Gigi')
    <div class="page-break"></div>
    <div class="section">
    @include('odontogram.odontogram', [
            'medicalRecord' => $record,
            'symbols' => $symbols, 
            'teethSymbols' => $teethSymbols, 
            'right' => $right, 
            'mid1' => $mid1, 
            'mid2' => $mid2, 
            'left' => $left, 
            'diastemaValue' => $diastemaValue, 
            'anomaliValue' => $anomaliValue, 
            'othersValue' => $othersValue
    ])
    </div>
    @endif
    <div class="signature-section">
        <p>Tanda Tangan Dokter:</p>
        <div class="signature-space"></div>
        <p style="font-size: 90%">{{ $record->reservation->schedule->employee->user->name }}</p>
    </div>
</body>
</html>
