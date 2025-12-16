@extends('layouts.user') {{-- Pastikan ini sesuai dengan layout user Anda --}}

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">
                <i class="bi bi-clock-history me-2"></i> Riwayat Pesanan Saya
            </h2>
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                <i class="bi bi-cart-plus me-1"></i> Kembali ke Kasir
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No Invoice</th>
                                <th class="text-end">Total Bayar</th>

                                {{-- ➡️ KOLOM BARU UNTUK BAYAR DAN KEMBALIAN --}}
                                <th class="text-end">Bayar</th>
                                <th class="text-end">Kembalian</th>
                                {{-- ⬅️ AKHIR KOLOM BARU --}}

                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $index => $trx)
                                @php
                                    // Hitung kembalian. Jika paid_amount null/0, kembalian dianggap 0.
                                    $paid_amount = $trx->paid_amount ?? 0;
                                    $kembalian = $paid_amount - $trx->total_price;
                                @endphp

                                <tr>
                                    <td>{{ $transactions->firstItem() + $index }}</td>
                                    <td>{{ $trx->created_at->format('d M Y H:i') }}</td>
                                    <td class="fw-bold text-primary">{{ $trx->invoice_code }}</td>
                                    <td class="fw-bold text-end">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>

                                    {{-- ➡️ DATA BAYAR --}}
                                    <td class="text-end text-success fw-bold">
                                        Rp {{ number_format($paid_amount, 0, ',', '.') }}
                                    </td>

                                    {{-- ➡️ DATA KEMBALIAN --}}
                                    <td class="text-end fw-bold 
                                                @if ($kembalian < 0)
                                                    text-danger
                                                @elseif ($kembalian > 0)
                                                    text-primary
                                                @else
                                                    text-dark
                                                @endif
                                            ">
                                        Rp {{ number_format($kembalian, 0, ',', '.') }}
                                    </td>
                                    {{-- ⬅️ AKHIR DATA BARU --}}

                                    <td>
                                        <span class="badge bg-success">LUNAS ({{ $trx->payment_method }})</span>
                                    </td>
                                    <td>
                                        {{-- Tombol Cetak Struk --}}
                                        <a href="{{ route('transaction.print', $trx->id) }}" target="_blank"
                                            class="btn btn-sm btn-outline-secondary" title="Cetak Struk">
                                            <i class="bi bi-printer"></i> Cetak
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5">
                                        <i class="bi bi-receipt display-1 d-block mb-3 opacity-25"></i>
                                        Anda belum memiliki riwayat transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection