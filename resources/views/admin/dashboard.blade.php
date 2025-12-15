@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-3">Dashboard Admin</h1>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="fw-bold">Welcome back, Admin! 👋</h4>
                        <p class="text-muted mb-0">Kelola menu, kategori, stok, dan pantau keuntungan cafemu di sini.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-3 mb-3">
                <div class="card text-white bg-primary h-100 shadow-sm border-0">
                    <div class="card-header bg-transparent border-0 fw-bold">Gudang & Stok</div>
                    <div class="card-body">
                        <h2 class="card-title"><i class="bi bi-box-seam"></i> Produk</h2>
                        <p class="card-text small opacity-75">Kelola menu makanan, minuman, dan stok.</p>

                        <a href="{{ route('products.index') }}"
                            class="btn btn-light text-primary fw-bold w-100 mt-2 stretched-link">
                            Kelola Menu →
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card text-white bg-success h-100 shadow-sm border-0">
                    <div class="card-header bg-transparent border-0 fw-bold">Master Data</div>
                    <div class="card-body">
                        <h2 class="card-title"><i class="bi bi-tags"></i> Kategori</h2>
                        <p class="card-text small opacity-75">Atur kategori (Makanan, Minuman, Snack).</p>

                        <a href="{{ route('categories.index') }}"
                            class="btn btn-light text-success fw-bold w-100 mt-2 stretched-link">
                            Atur Kategori →
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card text-white bg-info h-100 shadow-sm border-0">
                    <div class="card-header bg-transparent border-0 fw-bold text-dark">Log Aktivitas</div>
                    <div class="card-body text-dark">
                        <h2 class="card-title fw-bold"><i class="bi bi-receipt"></i> Riwayat</h2>
                        <p class="card-text small">Lihat daftar struk transaksi dari kasir.</p>

                        <a href="{{ route('admin.transactions.index') }}"
                            class="btn btn-light text-info fw-bold w-100 mt-2 stretched-link">
                            Lihat Log →
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card text-dark bg-warning h-100 shadow-sm border-0">
                    <div class="card-header bg-transparent border-0 fw-bold">Profit & Loss</div>
                    <div class="card-body">
                        <h2 class="card-title fw-bold"><i class="bi bi-cash-coin"></i> Keuangan</h2>
                        <p class="card-text small">Cek omzet kotor, HPP, dan Laba Bersih.</p>

                        <a href="{{ route('admin.financial') }}"
                            class="btn btn-light text-warning fw-bold w-100 mt-2 stretched-link">
                            Cek Cuan →
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection