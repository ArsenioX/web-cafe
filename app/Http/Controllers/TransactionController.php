<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Untuk transaksi database aman

class TransactionController extends Controller
{
    // 1. TAMPILKAN HALAMAN KASIR
    public function index(Request $request)
    {
        // 1. Mulai Query: Ambil produk yang stoknya ada
        $query = Product::query();

        // 2. Logika SEARCH (Berdasarkan Nama)
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 3. Logika FILTER KATEGORI (Berdasarkan Nama Kategori)
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // 4. Eksekusi Query
        $products = $query->paginate(6);
        // 5. Ambil semua data kategori untuk isi dropdown filter
        $categories = Category::all();

        $cart = session()->get('cart', []);
        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }

        // 6. Kirim ke View (produk hasil filter + daftar kategori)
        return view('user.dashboard', compact('products', 'categories', 'total_price'));
    }

    // 2. TAMBAH KE KERANJANG
    public function addToCart(Request $request, $id)
    {
        // 1. Ambil Data Produk dan Stok
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Cek apakah produk sudah ada di keranjang
        if (isset($cart[$id])) {
            // Jika sudah ada, hitung total kuantitas yang akan diminta
            $current_qty = $cart[$id]['quantity'];
            $new_qty = $current_qty + 1;

            // 2. ⚠️ VALIDASI STOK ⚠️
            if ($new_qty > $product->stock) {
                // Jika permintaan melebihi stok
                return redirect()->back()->with('error', 'Stok ' . $product->name . ' yang tersedia hanya ' . $product->stock . ' dan sudah ditambahkan ke keranjang!');
            }

            // Jika stok aman, tambahkan kuantitas
            $cart[$id]['quantity'] = $new_qty;
            session()->flash('success_add', 'Berhasil menambahkan 1x ' . $product->name . ' ke keranjang.');
        } else {
            // Jika produk belum ada di keranjang, masukkan item baru
            // 2. VALIDASI STOK untuk item baru (harusnya selalu 1, jadi pasti aman, tapi tetap baik untuk divalidasi)
            if (1 > $product->stock) {
                return redirect()->back()->with('error', 'Stok ' . $product->name . ' habis.');
            }

            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "photo" => $product->photo,
                "stock" => $product->stock // Menyimpan stok terkini
            ];
            session()->flash('success_add', 'Berhasil menambahkan ' . $product->name . ' ke keranjang.');
        }

        session()->put('cart', $cart);
        return redirect()->back();
    }
    // 3. HAPUS DARI KERANJANG (Reset)
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back();
    }


    public function updateCart($id, $action)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $product = Product::find($id);

            if ($action === 'increase') {
                // Pastikan tidak melebihi stok yang tersedia
                if ($cart[$id]['quantity'] < $product->stock) {
                    $cart[$id]['quantity']++;
                } else {
                    return redirect()->back()->with('error', 'Stok ' . $product->name . ' habis atau sudah maksimal.');
                }
            } elseif ($action === 'decrease') {
                $cart[$id]['quantity']--;
                if ($cart[$id]['quantity'] <= 0) {
                    // Jika quantity 0, hapus item dari keranjang
                    unset($cart[$id]);
                }
            }

            session()->put('cart', $cart);
            session()->flash('success_update', $product->name . ' diperbarui di keranjang!');
        }

        return redirect()->back();
    }

    /**
     * Hapus item dari keranjang.
     */
    public function removeCart($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $product_name = $cart[$id]['name'];
            unset($cart[$id]);
            session()->put('cart', $cart);
            session()->flash('success_remove', $product_name . ' berhasil dihapus dari keranjang.');
        }

        return redirect()->back();
    }


    // 4. PROSES BAYAR (FINAL)
    // 4. PROSES BAYAR (FINAL)
    public function checkout(Request $request)
    {
        // 1. Validasi Input (terutama paid_amount)
        $request->validate([
            'paid_amount' => 'required|numeric', // Paid amount harus ada dan berupa angka
            // payment_method sudah pasti CASH dari form
        ]);

        $cart = session()->get('cart');
        $total_price = 0;

        if (!$cart) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        foreach ($cart as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }

        // 🚨 Cek Pembayaran Minimum 🚨
        $paidAmount = (int)$request->paid_amount;

        if ($paidAmount < $total_price) {
            // Ini seharusnya dicegah oleh JS di frontend, tapi ini adalah fail-safe di backend
            return redirect()->back()->with('error', 'Uang yang dibayarkan (' . number_format($paidAmount) . ') kurang dari total tagihan (' . number_format($total_price) . ')!');
        }

        DB::beginTransaction();
        try {
            // 2. Simpan Transaksi
            $transaction = Transaction::create([
                'invoice_code' => 'INV-' . time(),
                'user_id' => Auth::id(),
                'total_price' => $total_price,
                'paid_amount' => $paidAmount, // ⬅️ PENAMBAHAN INPUT UANG DITERIMA
                'payment_method' => $request->payment_method, // Tetap gunakan value dari form (yang kita set CASH)
                'status' => 'PAID'
            ]);

            // 3. Simpan Detail & Kurangi Stok
            $product_ids = array_keys($cart);
            $products = Product::whereIn('id', $product_ids)->get()->keyBy('id');

            foreach ($cart as $id => $details) {
                $product = $products[$id];

                // Simpan perubahan stok
                $product->stock -= $details['quantity'];
                $product->save();

                // Simpan Detail Transaksi
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $id,
                    'qty' => $details['quantity'],
                    'price_at_transaction' => $details['price']
                ]);
            }

            DB::commit();
            session()->forget('cart');

            // --- ⬇️ LOGIKA NOMOR ANTRIAN ⬇️ ---
            // Nomor antrian dihitung dari jumlah transaksi hari ini
            $nomor_antrian = Transaction::whereDate('created_at', date('Y-m-d'))->count();

            // 4. Kirim data transaksi lengkap (termasuk paid_amount) ke sesi untuk Modal Struk
            return redirect()->route('user.dashboard')->with([
                'success' => 'Transaksi Berhasil!',
                'last_transaction' => $transaction,
                'nomor_antrian' => $nomor_antrian
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memproses transaksi. Silakan coba lagi. Pesan Error: ' . $e->getMessage());
        }
    }



    public function printStruk($id)
    {
        $transaction = Transaction::with('details.product')->findOrFail($id);

        // Load view struk yang sudah kita buat
        $pdf = Pdf::loadView('user.struk', compact('transaction'));

        // ATUR UKURAN KERTAS (PENTING!)
        // Format: [0, 0, Lebar, Tinggi] dalam satuan point
        // 80mm = sktr 227 point. Tinggi kita buat panjang (misal 600) biar muat banyak.
        $customPaper = [0, 0, 227, 600];
        $pdf->setPaper($customPaper, 'portrait');

        // Langsung Download PDF
        return $pdf->download('struk-transaksi-' . $transaction->invoice_code . '.pdf');

        // Kalau mau dilihat dulu (Preview) baru download, ganti ->download jadi ->stream
        // return $pdf->stream(); 
    }

    public function history()
    {
        // Ambil transaksi HANYA milik user yang sedang login (Kasir ini saja)
        // Diurutkan dari yang terbaru
        $transactions = Transaction::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.history', compact('transactions'));
    }
}
