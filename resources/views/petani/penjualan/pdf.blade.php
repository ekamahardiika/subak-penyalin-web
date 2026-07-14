<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 11px;
            color: #1f2937;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #059669;
            padding-bottom: 12px;
        }

        .header h1 {
            font-size: 16px;
            margin: 0;
            color: #065f46;
        }

        .header p {
            font-size: 10px;
            color: #6b7280;
            margin: 4px 0 0;
        }

        .meta {
            margin-bottom: 14px;
            font-size: 10px;
            color: #4b5563;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #ecfdf5;
            color: #065f46;
            font-size: 10px;
            text-transform: uppercase;
        }

        td {
            font-size: 10px;
        }

        .text-right {
            text-align: right;
        }

        .total-row td {
            font-weight: bold;
            background-color: #f9fafb;
        }

        .footer {
            margin-top: 20px;
            font-size: 9px;
            color: #9ca3af;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Penjualan Pribadi - {{ $namaPetani }}</h1>
        <p>Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }} WITA</p>
    </div>

    <div class="meta">
        Periode:
        {{ \Illuminate\Support\Carbon::parse($startDate)->translatedFormat('d M Y') }}
        s/d
        {{ \Illuminate\Support\Carbon::parse($endDate)->translatedFormat('d M Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No. Order</th>
                <th>Produk</th>
                <th class="text-right">KG Terjual</th>
                <th class="text-right">Harga Satuan (Rp)</th>
                <th class="text-right">Pendapatan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penjualan as $alloc)
                <tr>
                    <td>{{ $alloc->orderItem->order->no_order ?? '-' }}</td>
                    <td>{{ $alloc->petaniStock->product->nama_produk ?? '-' }}</td>
                    <td class="text-right">{{ number_format($alloc->jumlah_kg, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($alloc->orderItem->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-right">
                        {{ number_format($alloc->jumlah_kg * $alloc->orderItem->harga_satuan, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;">Tidak ada data untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        @if ($penjualan->count() > 0)
            <tfoot>
                <tr class="total-row">
                    <td colspan="2" class="text-right">Total</td>
                    <td class="text-right">{{ number_format($totalKg, 0, ',', '.') }} KG</td>
                    <td></td>
                    <td class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>

    <div class="footer">Dokumen ini dihasilkan otomatis oleh Sistem Gabah.</div>
</body>

</html>
