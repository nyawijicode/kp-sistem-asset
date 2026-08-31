<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Daftar Aset</title>
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
    <h2>Laporan Daftar Aset</h2>
    <p class="sub">Dicetak pada {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Aset</th>
                <th>Serial Number</th>
                <th>Kategori</th>
                <th>Qty</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $i => $asset)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $asset->nama_aset }}</td>
                <td>{{ $asset->serial_number }}</td>
                <td>{{ $asset->kategori }}</td>
                <td>{{ $asset->qty }}</td>
                <td>{{ $asset->satuan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>