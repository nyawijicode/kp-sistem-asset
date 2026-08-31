<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Aset Keluar</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 0;
        }

        p.sub {
            text-align: center;
            margin-top: 4px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>
    <h2>Laporan Aset Keluar</h2>
    <p class="sub">Dicetak pada {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Aset</th>
                <th>Serial Number</th>
                <th>Qty</th>
                <th>Penerima</th>
                <th>Dicatat Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                <td>{{ $item->asset->nama_aset }}</td>
                <td>{{ $item->asset->serial_number }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->penerima }}</td>
                <td>{{ $item->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>