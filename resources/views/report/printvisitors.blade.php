<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            table.static {
                position: relative;
                border: 1px solid black;
            }
        </style>
        <title>Cetak Laporan Pengunjung</title>
    </head>
    <body>
        <div class="form-group">
            <p align="center"><b>Laporan Pengunjung</b></p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%">
                <tr>
                    <th>No.</th>
                    <th>ID Pasien</th>
                    <th>Nama Pasien</th>
                    <th>ID Reservasi</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Tanggal Kunjungan</th>
                </tr>
                @foreach ($cetakData as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->patient_id }}</td>
                    <td>{{ $item->patient->user->name }}</td>
                    <td>{{ $item->reservation_code }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>{{ $item->schedule->schedule_date }}</td>
                </tr> 
                @endforeach
            </table>
        </div>
        <script type="text/javascript">
            window.print()
        </script>
    </body>
</html>