<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Status Reservasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #4CAF50;
            font-size: 24px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        .strong {
            font-weight: bold;
        }
        .status {
            font-size: 1.2em;
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            color: white;
            display: inline-block;
            width: 100%;
        }
        .status.approved {
            background-color: #4CAF50;
        }
        .status.waiting {
            background-color: #FFC107;
        }
        .status.rejected {
            background-color: #F44336;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
            text-align: center;
        }
        .footer p {
            margin: 5px 0;
        }
        @media (max-width: 600px) {
            .container {
                width: 95%;
            }
        }
    </style>
</head>
<body>
    @php
        use Carbon\Carbon;
        Carbon::setLocale('id');
    @endphp

    <div class="container">
        <h1>Reservasi Anda Telah 
            {{ $reservation->status == 1 ? 'Di Setujui' : ($reservation->status == 0 ? 'Menunggu Dikonfirmasi' : 'Di Tolak') }}
        </h1>
        <p>Yth. {{ $reservation->patient->user->name }},</p>
        <p>Berikut adalah status terkini dari reservasi Anda:</p>
        <div class="status {{ $reservation->status == 1 ? 'approved' : ($reservation->status == 0 ? 'waiting' : 'rejected') }}">
            {{ $reservation->status == 1 ? 'Di Setujui' : ($reservation->status == 0 ? 'Menunggu Dikonfirmasi' : 'Di Tolak') }}
        </div>
        <p><strong>Detail Reservasi:</strong></p>
        <ul>
            <li><span class="strong">Tanggal:</span> {{ Carbon::parse($reservation->schedule->schedule_date)->translatedFormat('l, d F Y') }}</li>
            @if ($reservation->status == 1)
            <li><span class="strong">Nomor Antrian:</span> {{ $reservation->nomor_urut }}</li>
            @endif
            <li><span class="strong">Waktu:</span> {{ Carbon::parse($reservation->schedule->schedule_time)->format('H:i') }}</li>
            <li><span class="strong">Tempat:</span> {{ $reservation->schedule->place->name }}</li>
            <li><span class="strong">Alamat:</span> {{ $reservation->schedule->place->address }}</li>
            @if ($reservation->status == 3)
            <li><span class="strong">Alasan:</span> {{ $reservation->reject_reason }}</li>
            @endif
        </ul>
        <p>Terima kasih telah menggunakan layanan kami.</p>
        <div class="footer">
            <p>Jika Anda memiliki pertanyaan, silakan hubungi kami di 08985665172 atau pada email ini.</p>
            <p>&copy; {{ date('Y') }} {{ $reservation->schedule->place->name }}. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>