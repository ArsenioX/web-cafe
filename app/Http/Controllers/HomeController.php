<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Middleware 'auth' memastikan hanya orang yang SUDAH LOGIN
     * yang bisa mengakses controller ini.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * Di sini logika pemisahan Admin vs User terjadi.
     */
    public function index()
    {
        // 1. Ambil data role user yang sedang login
        $role = Auth::user()->role;

        // 2. Cek Role dan arahkan ke rute yang sesuai
        if ($role == 'admin') {
            // Jika Admin, lempar ke dashboard admin
            return redirect()->route('admin.dashboard');
        } else {
            // Jika User/Kasir, lempar ke dashboard user
            return redirect()->route('user.dashboard');
        }
    }
}
