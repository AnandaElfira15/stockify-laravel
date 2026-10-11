<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ringkasan data utama
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();

        // Total seluruh unit stok dari semua produk
        $totalStock = Product::sum('stock');

        // Produk dengan stok sama dengan atau di bawah batas minimum
        $lowStockProducts = Product::query()
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock')
            ->orderBy('name')
            ->limit(10)
            ->get();

        // Jumlah transaksi barang masuk dan barang keluar
        $totalStockIn = StockMovement::where('type', 'in')->sum('quantity');
        $totalStockOut = StockMovement::where('type', 'out')->sum('quantity');

        // Riwayat transaksi stok terbaru
        $recentMovements = StockMovement::with(['product', 'supplier'])
            ->orderByDesc('movement_date')
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        // Ringkasan jumlah transaksi per jenis
        $movementSummary = StockMovement::query()
            ->select('type', DB::raw('COUNT(*) as total_transactions'))
            ->groupBy('type')
            ->pluck('total_transactions', 'type');

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'totalStock',
            'lowStockProducts',
            'totalStockIn',
            'totalStockOut',
            'recentMovements',
            'movementSummary'
        ));
    }
}
