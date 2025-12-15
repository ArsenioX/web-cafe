<?php

namespace App\Http\Controllers;

use App\Models\Product; // Panggil Model Produk
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    // 1. TAMPILKAN SEMUA MENU (Read)
    public function index()
    {
        $products = Product::all(); // Ambil semua data dari database
        return view('admin.products.index', compact('products'));
    }

    // 2. TAMPILKAN FORM TAMBAH (Create)
    public function create()
    {
        // Ambil semua kategori dari database
        $categories = Category::all();

        // Kirim data kategori ke view
        return view('admin.products.create', compact('categories'));
    }

    // 3. PROSES SIMPAN DATA BARU (Store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5048', // Validasi file gambar
        ]);

        $data = $request->all();

        // Cek apakah user upload gambar?
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'storage/app/public/products'
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Menu berhasil ditambahkan!');
    }
    // 4. TAMPILKAN FORM EDIT (Edit)
    public function edit(Product $product)
    {
        // Ambil semua kategori juga untuk form edit
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // 5. PROSES UPDATE DATA (Update)
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada (Opsional, biar hemat storage)
            // if ($product->image) {
            //     \Storage::disk('public')->delete($product->image);
            // }

            // Upload gambar baru
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Menu berhasil diupdate!');
    }

    // 6. HAPUS DATA (Destroy)
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Menu dihapus!');
    }
}
