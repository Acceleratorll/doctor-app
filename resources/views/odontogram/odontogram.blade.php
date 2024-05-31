<!-- resources/views/odontogram.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odontogram</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            margin-bottom: 10px;
        }
        .odontogram-table {
            width: 100%;
            margin-top: 20px;
        }
        .odontogram-table th, .odontogram-table td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .odontogram-table th {
            font-size: 80%;
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .odontogram-table td {
            font-size: 80%;
        }
        .details-section {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .details-section h3 {
            margin-top: 10px;
            font-size: 1.5rem;
            color: #343a40;
        }
        .details-section p {
            margin-top: 5px;
            font-size: 1rem;
            color: #495057;
        }
        .details-list {
            list-style-type: none;
            padding-left: 0;
        }
        .details-list li {
            margin: 5px 0;
            padding: 10px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Odontogram</h2>
        <table class="odontogram-table table table-bordered">
            <thead>
                <tr>
                    <th>Rahang Atas Gigi Permanent</th>
                    <th>Rahang Atas Gigi Susu</th>
                    <th>Rahang Bawah Gigi Susu</th>
                    <th>Rahang Bawah Gigi Permanent</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        @foreach ($right as $teeth)
                            {{ $teeth->fdi }}: 
                            @foreach ($teethSymbols[$teeth->id] as $symbol)
                                {{ $symbol }}
                            @endforeach
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($mid1 as $teeth)
                            {{ $teeth->fdi }}:
                            @foreach ($teethSymbols[$teeth->id] as $symbol)
                                {{ $symbol }}
                            @endforeach
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($mid2 as $teeth)
                            {{ $teeth->fdi }}: 
                            @foreach ($teethSymbols[$teeth->id] as $symbol)
                                {{ $symbol }}
                            @endforeach
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($left as $teeth)
                            {{ $teeth->fdi }}: 
                            @foreach ($teethSymbols[$teeth->id] as $symbol)
                                {{ $symbol }}
                            @endforeach
                            <br>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="odontogram-table table table-bordered">
            <tr>
                <th>
                    Occlusi
                </th>
                <th>
                    Torus Palatinus
                </th>
                <th>
                    Torus Mandibularis
                </th>
                <th>
                    Palatum
                </th>
            </tr>
            <tr>
                <td>
                        <p>{{ $medicalRecord->occlusi === 'normal' ? 'Normal Bite' : ($medicalRecord->occlusi === 'cross' ? 'Cross Bite' : 'Steep Bite') }}</p>
                </td>
                <td>
                        <p>{{ $medicalRecord->torus_palatinus === 'tidak ada' ? 'Tidak Ada' : ($medicalRecord->torus_palatinus === 'kecil' ? 'Kecil' : ($medicalRecord->torus_palatinus === 'sedang' ? 'Sedang' : ($medicalRecord->torus_palatinus === 'besar' ? 'Besar' : 'Multiple'))) }}</p>
                </td>
                <td>
                        <p>{{ $medicalRecord->torus_mandibularis === 'tidak ada' ? 'Tidak Ada' : ($medicalRecord->torus_mandibularis === 'sisi kiri' ? 'Sisi Kiri' : ($medicalRecord->torus_mandibularis === 'sisi kanan' ? 'Sisi Kanan' : 'Kedua Sisi')) }}</p>
                </td>
                <td>
                        <p>{{ $medicalRecord->palatum === 'dalam' ? 'Dalam' : ($medicalRecord->palatum === 'sedang' ? 'Sedang' : 'Rendah') }}</p>
                </td>
            </tr>
        </table>
        <table class="odontogram-table table table-bordered">
            <tr>
                <th>
                    Diastema
                </th>
                <th>
                    Anomali
                </th>
                <th>
                    Lain-lain
                </th>
            </tr>
            <tr>
                <td>
                        <p>{{ $diastemaValue ? $diastemaValue : '-' }}</p>
                </td>
                <td>
                        <p>{{ $anomaliValue ? $anomaliValue : '-' }}</p>
                </td>
                <td>
                        <p>{{ $othersValue ? $othersValue : '-' }}</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
