<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-info {
            margin-top: 10px;
            font-size: 9pt;
            line-height: 1.7;
            color: #555;
        }

        .header-info p {
            margin: 0;
        }

        h2 {
            text-align: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 9pt;
            border-radius: 4px;
        }

        .status-verifikasi-peminjaman {
            background-color: #ffc107;
            color: #fff;
        }

        .status-sedang-pinjam {
            background-color: #28a745;
            color: #fff;
        }

        .status-verifikasi-pengembalian {
            background-color: #17a2b8;
            color: #fff;
        }

        .status-selesai-pinjam {
            background-color: #6c757d;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Peminjaman</h2>
        <div class="header-info text-left">
            <p>Tanggal: {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
            <p>Oleh: {{ Auth::user()->username }} ({{ Auth::user()->role }})</p>
            @if($tanggalAwal && $tanggalAkhir)
                <p>Periode: {{ \Carbon\Carbon::parse($tanggalAwal)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d M Y') }}</p>
            @endif
            @if($statusPeminjaman)
                <p>Status: {{ ucfirst(str_replace('_', ' ', $statusPeminjaman)) }}</p>
            @endif
        </div>               
    </div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjaman as $key => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ $item->buku->judul_buku }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_peminjaman)->format('d M Y') }}</td>
                    <td>{{ $item->tgl_pengembalian ? \Carbon\Carbon::parse($item->tgl_pengembalian)->format('d M Y') : '-' }}</td>
                    <td>
                        @if ($item->status_peminjaman === 'verifikasi_peminjaman')
                            <span class="status-badge status-verifikasi-peminjaman">Verifikasi Peminjaman</span>
                        @elseif ($item->status_peminjaman === 'sedang_pinjam')
                            <span class="status-badge status-sedang-pinjam">Sedang Pinjam</span>
                        @elseif ($item->status_peminjaman === 'verifikasi_pengembalian')
                            <span class="status-badge status-verifikasi-pengembalian">Verifikasi Pengembalian</span>
                        @elseif ($item->status_peminjaman === 'selesai_pinjam')
                            <span class="status-badge status-selesai-pinjam">Selesai Pinjam</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>