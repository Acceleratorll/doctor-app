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
        <title>Cetak Laporan Praktik</title>
    </head>
    <body>
        <div class="form-group">
            <p align="center"><b>Laporan Praktik</b></p>
            <table class="static" align="center" rules="all" border="1px" style="width:95%">
                <tr>
                    <th>No.</th>
                    <th>ID Tempat</th>
                    <th>Nama Tempat</th>
                    <th>Total Buka</th>
                    <th>Total Pasien</th>
                </tr>
                @foreach ($cetakData as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->schedules->count() }}</td>
                    <td>{{ $item->schedules->flatMap(function ($schedule) {
                        return $schedule->reservations;
                    })->count() }}</td>
                    
                </tr> 
                @endforeach
            </table>
        </div>
        <script type="text/javascript">
            window.print()
        </script>
    </body>
</html>