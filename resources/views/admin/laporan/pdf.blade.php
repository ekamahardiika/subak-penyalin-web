<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #1f2937; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #059669; padding-bottom: 12px; }
        .header h1 { font-size: 16px; margin: 0; color: #065f46; }
        .header p { font-size: 10px; color: #6b7280; margin: 4px 0 0; }
        .meta { margin-bottom: 14px; font-size: 10px; color: #4b5563; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #d1d5db; padding: 6px 8px; text-align: left; }
        th { background-color: #ecfdf5; color: #065f46; font-size: 10px; text-transform: uppercase; }
        td { font-size: 10px; }
        .text-right { text-align: right; }
        .total-row td { font-weight: bold; background-color: #f9fafb; }
        .footer { margin-top: 20px; font-size: 9px; color: #9ca3af; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Penjualan - Sistem Gabah</h1>
        <p>Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }} WITA</p>
    </div>

    <div class="meta">
        Periode:
        {{ $periode['start'] ? \Illuminate\Support\Carbon::parse($periode['start'])->translatedFormat('d M Y') : 'Semua tanggal' }}
        s/d
        {{ $periode['end'] ? \Illuminate\Support\Carbon::parse($periode['end'])->translatedFormat('d M Y') : 'sekarang' }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No. Order</th>
                <th>Konsumen</th>
                <th>Tanggal</th>
                <th class="text-right">Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->no_order }}</td>
                    <td>{{ $order->user->name ?? '-' }}</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($order->tanggal_pesan)->translatedFormat('d M Y') }}</td>
                    <td class="text-right">{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada data untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        @if ($orders->count() > 0)
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="text-right">Total Penjualan</td>
                    <td class="text-right">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>

    <div class="footer">Dokumen ini dihasilkan otomatis oleh Sistem Gabah.</div>
</body>
</html>