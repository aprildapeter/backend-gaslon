<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kategori = ProductCategory::all()->count();
        $produk = Product::all()->count();
        $transaksi = Transaction::all()->count();
        $user = User::where('roles', 'pelanggan')->count();
        return view('home', compact('kategori','produk','transaksi','user'));
    }
}
