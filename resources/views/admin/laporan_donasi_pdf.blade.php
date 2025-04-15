<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemasukan Donasi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Pemasukan Donasi</h2>
    <h2 style="text-align: center;">Berkah Box Balikpapan</h2>
    <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}
        - {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>

    <table>
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Donatur</th>
                <th>No HP</th>
                <th>Program Donasi</th>
                <th>Jumlah Donasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donasi as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>{{ $item->nama_donatur }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>{{ $item->program_donasi ? $item->program_donasi->nama_program : '-' }}</td>
                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
