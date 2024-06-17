<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Reservasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        h1 {
            color: #4CAF50;
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
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    @php
        use Carbon\Carbon;
        Carbon::setLocale('id');
    @endphp

    <div class="container">
        <h1>Pengingat Reservasi</h1>
        <p>Yth. {{ $reservation->patient->user->name }},</p>
        <p>Ini adalah pengingat bahwa Anda memiliki reservasi yang dijadwalkan untuk hari ini.</p>
        <p><strong>Detail:</strong></p>
        <ul>
            <li><span class="strong">Tanggal:</span> {{ Carbon::parse($reservation->schedule->schedule_date)->translatedFormat('l, d F Y') }}</li>
            <li><span class="strong">Nomor Antrian:</span> {{ $reservation->nomor_urut }}</li>
            <li><span class="strong">Waktu:</span> {{ Carbon::parse($reservation->schedule->schedule_time)->format('H:i') }}</li>
            <li><span class="strong">Tempat:</span> {{ $reservation->schedule->place->name }}</li>
            <li><span class="strong">Alamat:</span> {{ $reservation->schedule->place->address }}</li>
        </ul>
        <p>Terima kasih.</p>
        <div class="footer">
            <p>Jika Anda memiliki pertanyaan, silakan hubungi kami di 08985665172 atau pada email ini.</p>
            <p>&copy; {{ date('Y') }} Klinik Kami. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>