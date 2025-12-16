@extends('layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- KOLOM KIRI: DAFTAR MENU --}}
            <div class="col-md-8">
                <div class="card h-100 shadow-sm">

                    <div class="card-header bg-primary text-white p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold"><i class="bi bi-grid-fill me-2"></i>Daftar Menu</span>
                        </div>

                        <form action="{{ route('user.dashboard') }}" method="GET">
                            <div class="input-group">

                                <select name="category" class="form-select" style="max-width: 150px; cursor: pointer;" onchange="this.form.submit()">
                                    <option value="">Semua</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <input type="text" name="search" class="form-control" placeholder="Cari menu apa..." value="{{ request('search') }}">

                                <button class="btn btn-warning fw-bold text-dark" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card-body" style="background-color: #f8f9fa;">

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            {{-- Pindah Pagination ke luar loop agar tidak terulang --}}
                            @if ($products->count() == 0)
                                <div class="col-12 text-center py-5 text-muted">
                                    <i class="bi bi-x-circle display-4 d-block mb-3"></i>
                                    Menu tidak ditemukan.
                                </div>
                            @else
                                @foreach ($products as $product)
                                    <div class="col-md-4 col-sm-6 mb-4">
                                        <div class="card h-100 shadow-sm border-0 hover-card">

                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 150px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary text-white d-flex justify-content-center align-items-center" style="height: 150px;">
                                                    <span>No Image</span>
                                                </div>
                                            @endif

                                            <div class="card-body text-center">
                                                <h6 class="card-title fw-bold text-dark">{{ $product->name }}</h6>
                                                <p class="card-text text-primary fw-bold fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                                <small class="text-muted">Stok Tersedia: {{ $product->stock }}</small>
                                            </div>

                                            <div class="card-footer bg-white border-top-0 pb-3">
                                                @if($product->stock > 0)
                                                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-outline-primary w-100 fw-bold">
                                                        + Tambah
                                                    </a>
                                                @else
                                                    <button class="btn btn-secondary w-100" disabled>Stok Habis</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                <div class="col-12 d-flex justify-content-center mb-4">
                                    {{ $products->links() }}
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: KERANJANG (DIPERBARUI) --}}
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-success text-white fw-bold d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-cart-fill me-2"></i>Keranjang</span>
                        <a href="{{ route('cart.clear') }}" class="btn btn-sm btn-danger text-white" 
                           onclick="return confirm('Kosongkan keranjang?')">Reset</a>
                    </div>

                    <div class="card-body d-flex flex-column">

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Berhasil!</strong> Transaksi tersimpan.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive mb-3 border rounded bg-light" style="flex-grow: 1; max-height: 350px; overflow-y: auto;">
                            <table class="table table-sm table-striped mb-0">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th>Menu</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total_price = 0; @endphp
                                    @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                            @php $total_price += $details['price'] * $details['quantity']; @endphp
                                            <tr>
                                                <td class="align-middle">
                                                    <span class="fw-bold d-block">{{ $details['name'] }}</span>
                                                    <a href="{{ route('cart.remove', $id) }}" class="badge text-bg-danger text-decoration-none"
                                                        onclick="return confirm('Hapus menu {{ $details['name'] }} dari keranjang?')">
                                                        <i class="bi bi-trash-fill me-1"></i> Hapus
                                                    </a>
                                                </td>

                                                <td class="text-center align-middle">
                                                    <div class="input-group input-group-sm justify-content-center" style="width: 110px; margin: 0 auto;">
                                                        <a href="{{ route('cart.update', ['id' => $id, 'action' => 'decrease']) }}"
                                                            class="btn btn-outline-secondary">
                                                            <i class="bi bi-dash-lg"></i>
                                                        </a>

                                                        <input type="text" class="form-control text-center bg-white fw-bold" value="{{ $details['quantity'] }}"
                                                            readonly style="max-width: 40px;">

                                                        <a href="{{ route('cart.update', ['id' => $id, 'action' => 'increase']) }}"
                                                            class="btn btn-outline-secondary">
                                                            <i class="bi bi-plus-lg text-dark"></i>
                                                        </a>
                                                    </div>
                                                </td>

                                                <td class="text-end align-middle fw-bold text-dark">
                                                    Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">
                                                <i>Keranjang masih kosong</i>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="border-top pt-3 mt-auto">
                            <form action="{{ route('transaction.process') }}" method="POST" id="checkoutForm">
                                @csrf
                                
                                {{-- 1. TOTAL TAGIHAN --}}
                                <div class="d-flex justify-content-between align-items-end mb-3">
                                    <h5 class="fw-bold mb-0 text-secondary">Total Tagihan:</h5>
                                    <h3 class="fw-bold text-success mb-0" id="label-total">Rp {{ number_format($total_price ?? 0, 0, ',', '.') }}</h3>
                                    <input type="hidden" id="grand_total" value="{{ $total_price ?? 0 }}">
                                </div>

                                {{-- 2. METODE PEMBAYARAN (CASH ONLY) --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-muted">METODE PEMBAYARAN</label>
                                    <input type="text" class="form-control bg-light" value="TUNAI (CASH)" readonly>
                                    <input type="hidden" name="payment_method" value="CASH">
                                </div>

                                {{-- 3. INPUT UANG DITERIMA --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-muted">UANG DITERIMA (Rp)</label>
                                    <input type="number" id="bayar" name="paid_amount" class="form-control form-control-lg border-primary" 
                                           placeholder="{{ $total_price > 0 ? $total_price : '0' }}" required min="{{ $total_price ?? 0 }}">
                                    <div class="invalid-feedback">
                                        Uang pembayaran kurang!
                                    </div>
                                </div>

                                {{-- 4. TAMPILAN KEMBALIAN (OTOMATIS) --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-muted">KEMBALIAN</label>
                                    <input type="text" id="kembalian" class="form-control form-control-lg bg-light text-success fw-bold" 
                                           value="Rp 0" readonly>
                                </div>

                                {{-- 5. TOMBOL BAYAR (DIKONTROL JS) --}}
                                <button type="submit" class="btn btn-success w-100 py-3 fw-bold fs-5 shadow-sm" 
                                        id="btn-bayar" {{ ($total_price ?? 0) == 0 ? 'disabled' : 'disabled' }}>
                                    <i class="bi bi-cash-coin me-2"></i> PROSES PEMBAYARAN
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL STRUK (KODE ASLI ANDA) --}}
    @if(session('last_transaction'))
    <div class="modal fade show" id="strukModal" tabindex="-1" aria-modal="true" role="dialog" style="display: block; background: rgba(0,0,0,0.6);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center shadow-lg border-0 rounded-4 overflow-hidden">

                <div class="modal-header bg-success text-white justify-content-center py-3">
                    <h4 class="modal-title fw-bold">✅ Transaksi Berhasil!</h4>
                </div>

                <div class="modal-body p-4">
                    <h3 class="fw-bold mb-1">CAFE SEMBADA</h3>
                    <p class="text-muted small mb-4">Pembayaran Berhasil</p>

                    <p class="text-muted text-uppercase fw-bold mb-1" style="letter-spacing: 2px;">Nomor Antrian</p>

                    <h1 class="display-1 fw-bold text-dark mb-3" style="font-size: 5rem;">
                        {{ session('nomor_antrian') }}
                    </h1>

                    <div class="border-top border-bottom border-dark border-2 py-3 mb-3 border-dashed">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">No Invoice</span>
                            <span class="fw-bold text-dark small">{{ session('last_transaction')->invoice_code }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">Waktu</span>
                            <span class="fw-bold text-dark small">{{ date('d/m/Y H:i') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">Metode</span>
                            <span class="fw-bold text-dark small">{{ session('last_transaction')->payment_method }}</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="fw-bold fs-5">TOTAL BAYAR</span>
                        <span class="fw-bold text-dark fs-4">Rp {{ number_format(session('last_transaction')->total_price, 0, ',', '.') }}</span>
                    </div>
                    
                    {{-- TAMBAHAN KEMBALIAN DI STRUK --}}
                    @if(session('last_transaction')->paid_amount > session('last_transaction')->total_price)
                    <div class="d-flex justify-content-between align-items-center border-top pt-2 mt-2">
                        <span class="fw-bold text-success">KEMBALIAN</span>
                        <span class="fw-bold text-success fs-5">
                            Rp {{ number_format(session('last_transaction')->paid_amount - session('last_transaction')->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                    @endif
                </div>

                <div class="modal-footer justify-content-center bg-white">

                    <a href="{{ route('transaction.print', session('last_transaction')->id) }}" class="btn btn-secondary fw-bold rounded-pill px-4 me-2">
                        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Download PDF
                    </a>

                    <button type="button" class="btn btn-primary fw-bold rounded-pill px-4" onclick="tutupModal()">
                        Selesai 🚀
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tutupModal() {
            document.getElementById('strukModal').style.display = 'none';
        }
    </script>
    @endif

    {{-- SCRIPT JAVASCRIPT BARU UNTUK PERHITUNGAN KEMBALIAN --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen-elemen
            const grandTotalInput = document.getElementById('grand_total');
            const inputBayar = document.getElementById('bayar');
            const inputKembalian = document.getElementById('kembalian');
            const btnBayar = document.getElementById('btn-bayar');

            // Parse total tagihan ke integer
            const grandTotal = parseInt(grandTotalInput.value) || 0;

            // Fungsi format Rupiah
            const formatRupiah = (number) => {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(number);
            };

            // Event listener saat user mengetik nominal bayar
            inputBayar.addEventListener('input', function() {
                const bayar = parseInt(this.value) || 0;
                const kembalian = bayar - grandTotal;

                // Update tampilan kembalian
                if (kembalian >= 0) {
                    // Uang Cukup
                    inputKembalian.value = formatRupiah(kembalian);
                    inputKembalian.classList.remove('text-danger');
                    inputKembalian.classList.add('text-success');
                    
                    // Aktifkan tombol bayar
                    if(grandTotal > 0) {
                        btnBayar.removeAttribute('disabled');
                    }
                } else {
                    // Uang Kurang
                    inputKembalian.value = "Uang Kurang " + formatRupiah(Math.abs(kembalian));
                    inputKembalian.classList.remove('text-success');
                    inputKembalian.classList.add('text-danger');
                    
                    // Matikan tombol bayar
                    btnBayar.setAttribute('disabled', true);
                }

                // Atur class is-invalid/is-valid pada input bayar
                if (bayar < grandTotal) {
                    inputBayar.classList.add('is-invalid');
                } else {
                    inputBayar.classList.remove('is-invalid');
                }
            });

            // Cek kondisi awal saat halaman dimuat (jika ada nilai di input bayar)
            if (inputBayar.value) {
                inputBayar.dispatchEvent(new Event('input'));
            }

            // Pastikan tombol bayar disable jika keranjang kosong
            if (grandTotal === 0) {
                btnBayar.setAttribute('disabled', true);
            }
        });
    </script>

@endsection