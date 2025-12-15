@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="bi bi-receipt me-2"></i> Riwayat Transaksi Penjualan
            <br><small class="text-secondary fs-6">Daftar lengkap seluruh transaksi penjualan.</small>
        </h2>

        <a href="{{ route('admin.reports.financial') }}" class="btn btn-outline-success">
            <i class="bi bi-bar-chart-fill me-1"></i> Lihat Laporan Keuangan
        </a>
    </div>

    {{-- --- Tabel Riwayat Transaksi --- --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold">
            Data Transaksi (Halaman {{ $transactions->currentPage() }})
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal & Waktu</th>
                            <th>No. Invoice</th>
                            <th>Kasir</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                            <tr>
                                {{-- ✅ NOMOR URUT BENAR UNTUK PAGINATION --}}
                                <td>{{ $transactions->firstItem() + $loop->index }}</td>
                                <td>{{ $trx->created_at->format('d M Y H:i') }}</td>
                                <td class="fw-bold text-primary">{{ $trx->invoice_code }}</td>
                                <td>{{ $trx->user->name ?? 'N/A' }}</td>
                                <td class="fw-bold text-success">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-success">LUNAS ({{ $trx->payment_method }})</span>
                                </td>
                                <td>
                                    {{-- ✅ TOMBOL CETAK STRUK DENGAN IKON PRINTER --}}
                                    <a href="{{ route('admin.transaction.print', $trx->id) }}" target="_blank"
                                        class="btn btn-sm btn-info text-white" title="Cetak Ulang Struk">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada transaksi dalam riwayat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ✅ PAGINATION LINKS (DITEMPATKAN SATU KALI DI LUAR LOOP) --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>

@endsection