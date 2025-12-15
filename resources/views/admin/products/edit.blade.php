@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header fw-bold">Edit Menu: {{ $product->name }}</div>

                    <div class="card-body">
                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Nama Menu</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="category" class="form-select" required>
                                        <option value="" disabled>-- Pilih Kategori --</option>

                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->name }}" {{ $product->category == $cat->name ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Ganti Foto (Opsional)</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">

                                    @if($product->image)
                                        <div class="mt-2">
                                            <small>Gambar Saat Ini:</small><br>
                                            <img src="{{ asset('storage/' . $product->image) }}" width="80"
                                                class="img-thumbnail">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Harga Jual</label>
                                    <input type="number" name="price" value="{{ $product->price }}" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Modal / HPP</label>
                                    <input type="number" name="purchase_price" value="{{ $product->purchase_price }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="number" name="stock" value="{{ $product->stock }}" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea name="description" class="form-control"
                                    rows="3">{{ $product->description }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-success">Update Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection