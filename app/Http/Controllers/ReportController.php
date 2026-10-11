<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $products = Product::with('category')
            ->orderBy('name')
            ->get();

        $movements = StockMovement::with(['product', 'supplier'])
            ->when($startDate, function ($query, $date) {
                $query->whereDate('movement_date', '>=', $date);
            })
            ->when($endDate, function ($query, $date) {
                $query->whereDate('movement_date', '<=', $date);
            })
            ->orderByDesc('movement_date')
            ->orderByDesc('id')
            ->get();

        $totalIn = (clone $movements->toQuery())
            ->where('type', 'in')
            ->sum('quantity');

        $totalOut = (clone $movements->toQuery())
            ->where('type', 'out')
            ->sum('quantity');

        return view('reports.index', compact(
            'products',
            'movements',
            'totalIn',
            'totalOut',
            'startDate',
            'endDate'
        ));
    }
}