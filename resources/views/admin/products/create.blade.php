@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">Tambah Menu Baru</div>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Gagal Disimpan!</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama Menu</label>
                                <input type="text" name="name" class="form-control" required
                                    placeholder="Contoh: Kopi Susu Gula Aren" value="{{ old('name') }}">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="category" class="form-select" required>
                                    <option value="" disabled selected>-- Pilih Kategori --</option>

                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Foto Produk</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <small class="text-muted">Format: JPG/PNG (Max 2MB)</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Harga Jual (Rp)</label>
                                    <input type="number" name="price" class="form-control" required placeholder="15000"
                                        value="{{ old('price') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Modal / HPP (Rp)</label>
                                    <input type="number" name="purchase_price" class="form-control" placeholder="8000"
                                        value="{{ old('purchase_price') }}">
                                    <small class="text-muted text-danger">*Rahasia dapur</small>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Stok Awal</label>
                                    <input type="number" name="stock" class="form-control" required placeholder="50"
                                        value="{{ old('stock') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keterangan Singkat</label>
                                <textarea name="description" class="form-control" rows="3"
                                    placeholder="Contoh: Kopi robusta dengan gula aren asli">{{ old('description') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Menu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection