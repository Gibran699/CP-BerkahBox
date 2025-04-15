<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengeluaran Donasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
            text-align: center;
        }

        h2,
        p {
            text-align: center;
            margin: 0;
            padding: 5px;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <h2>Laporan Pengeluaran Donasi</h2>
    <h2>Berkah Box Balikpapan</h2>
    <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} -
        {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Minggu ke</th>
                <th>Uraian Kegiatan</th>
                <th>Tanggal</th>
                <th>Masukan (Rp)</th>
                <th>Pengeluaran (Rp)</th>
                <th>Simpanan (Rp)</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php $currentWeek = 1; @endphp
            @foreach ($groupedPengeluaran as $week => $items)
                <tr>
                    <td class="text-center" rowspan="{{ count($items) + 1 }}">{{ $currentWeek }}</td>
                    <td colspan="1"><strong>Terkumpulnya Sedekah</strong></td>
                    <td></td>
                    <td class="text-right">
                        <strong>
                            Rp
                            {{ number_format($totals[$week]['pengeluaran'] + $totals[$week]['simpanan'], 0, ',', '.') }}
                        </strong>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                        <td class="text-right">
                            {{ $item->masukan ? 'Rp ' . number_format($item->masukan, 0, ',', '.') : '-' }}</td>
                        <td class="text-right">
                            {{ $item->pengeluaran ? 'Rp ' . number_format($item->pengeluaran, 0, ',', '.') : '-' }}</td>
                        <td class="text-right">
                            {{ $item->simpanan ? 'Rp ' . number_format($item->simpanan, 0, ',', '.') : '-' }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2"><strong>Total Pengeluaran</strong></td>
                    <td></td>
                    <td></td>
                    <td class="text-right"><strong>Rp
                            {{ number_format($totals[$week]['pengeluaran'], 0, ',', '.') }}</strong></td>
                    <td></td>
                    <td></td>
                </tr>
                @php $currentWeek++; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Total Keseluruhan Penerimaan</th>
                <th class="text-right">Rp {{ number_format($grandTotalMasukan, 0, ',', '.') }}</th>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Total Keseluruhan Pengeluaran</th>
                <td></td>
                <th class="text-right">Rp {{ number_format($grandTotalPengeluaran, 0, ',', '.') }}</th>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th colspan="3" class="text-right">Total Simpanan Bulan
                    {{ \Carbon\Carbon::parse($startDate)->format('F') }}</th>
                <td></td>
                <td></td>
                <th class="text-right">Rp {{ number_format($grandTotalSimpanan, 0, ',', '.') }}</th>
                <td></td>
            </tr>
        </tfoot>

    </table>
</body>

</html>
