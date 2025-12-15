@extends('layouts.admin')

@section('content')

    {{-- --- Bagian Filter Tanggal --- --}}
    <form action="{{ route('admin.reports.financial') }}" method="GET" class="mb-5">
        <div class="card shadow p-4">
            <h5 class="mb-3 fw-bold">Filter Periode Laporan</h5>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label for="start_date" class="form-label">Dari Tanggal</label>
                    {{-- Nilai diambil dari request('start_date') atau default awal bulan --}}
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ request('start_date', date('Y-m-01')) }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="end_date" class="form-label">Sampai Tanggal</label>
                    {{-- Nilai diambil dari request('end_date') atau default hari ini --}}
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ request('end_date', date('Y-m-d')) }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-filter"></i> Tampilkan Laporan
                    </button>
                </div>
            </div>
        </div>
    </form>


    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">
                Laporan Keuangan (Profit & Loss)
                {{-- Tampilkan periode laporan yang sedang dilihat --}}
                <br><small class="text-secondary fs-6">Periode:
                    {{ date('d M Y', strtotime(request('start_date', date('Y-m-01')))) }} s/d
                    {{ date('d M Y', strtotime(request('end_date', date('Y-m-d')))) }}</small>
            </h2>
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm print-hide">Cetak Laporan</button>
        </div>

        {{-- --- Ringkasan Keuangan (Cards) --- --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <small class="text-muted fw-bold">TOTAL OMZET (PENDAPATAN KOTOR)</small>
                        <h3 class="fw-bold text-primary mt-2">Rp {{ number_format($total_omzet, 0, ',', '.') }}</h3>
                        <small class="text-secondary">Uang tunai yang diterima dari pelanggan.</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0 mb-3">
                    <div class="card-body">
                        <small class="text-muted fw-bold">TOTAL HPP (MODAL KELUAR)</small>
                        <h3 class="fw-bold text-danger mt-2">Rp {{ number_format($total_hpp, 0, ',', '.') }}</h3>
                        <small class="text-secondary">Modal untuk membeli bahan baku.</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow border-0 mb-3 bg-success text-white">
                    <div class="card-body">
                        <small class="text-white-50 fw-bold">LABA BERSIH (KEUNTUNGAN)</small>
                        <h3 class="fw-bold mt-2">Rp {{ number_format($total_laba, 0, ',', '.') }}</h3>
                        <small class="text-white-50">Omzet dikurangi Modal (Uang Dingin).</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- --- Produk Terlaris --- --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">
                        🏆 5 Produk Terlaris (Berdasarkan Kuantitas Terjual)
                    </div>
                    <div class="card-body">
                        @if ($top_products->isEmpty())
                            <p class="text-center text-muted">Tidak ada data penjualan pada periode ini.</p>
                        @else
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Terjual</th>
                                        <th>Harga Jual</th>
                                        <th>Modal (HPP)</th>
                                        <th>Estimasi Keuntungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($top_products as $index => $item)
                                        @php
                                            // Ambil HPP dan Harga Jual dari data produk yang di-eager load
                                            $modal = $item->product->purchase_price ?? 0; // Asumsi purchase_price adalah HPP
                                            $jual = $item->product->price ?? 0;
                                            $cuan = ($jual - $modal) * $item->total_qty;
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="fw-bold">{{ $item->product->name ?? 'Produk Dihapus' }}</td>
                                            <td><span class="badge bg-primary">{{ $item->total_qty }} Porsi</span></td>
                                            <td>Rp {{ number_format($jual, 0, ',', '.') }}</td>
                                            <td class="text-danger">Rp {{ number_format($modal, 0, ',', '.') }}</td>
                                            <td class="text-success fw-bold">+ Rp {{ number_format($cuan, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- --- CSS Khusus Print --- --}}
    <style>
        @media print {

            /* Sembunyikan elemen filter (form) dan tombol cetak saat mencetak */
            .print-hide,
            form {
                display: none !important;
            }

            /* Hapus background dan box shadow untuk hasil cetak yang bersih */
            body {
                background-color: #fff !important;
                color: #000 !important;
            }

            .card,
            .shadow {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }

            .card-body,
            .container {
                padding: 0 !important;
            }

            /* Sesuaikan lebar kolom untuk cetak */
            .row.mb-4>div {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }

            /* Tambahkan judul laporan di atas cetakan */
            h2 {
                text-align: center;
                margin-bottom: 20px;
                margin-top: 0;
            }
        }
    </style>

@endsection