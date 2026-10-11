<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StockMovementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');

        $movements = StockMovement::with(['product', 'supplier'])
            ->when($search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->whereHas('product', function ($productQuery) use ($search) {
                        $productQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('sku', 'like', '%' . $search . '%');
                    })->orWhereHas('supplier', function ($supplierQuery) use ($search) {
                        $supplierQuery->where('name', 'like', '%' . $search . '%');
                    });
                });
            })
            ->when(in_array($type, ['in', 'out'], true), function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->orderByDesc('movement_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('stock_movements.index', compact(
            'movements',
            'search',
            'type'
        ));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('stock_movements.create', compact(
            'products',
            'suppliers'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],
            'supplier_id' => [
                'nullable',
                'integer',
                'exists:suppliers,id',
            ],
            'type' => [
                'required',
                Rule::in(['in', 'out']),
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:2147483647',
            ],
            'movement_date' => [
                'required',
                'date',
            ],
            'note' => [
                'nullable',
                'string',
            ],
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::whereKey($validated['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $validated['type'] === 'out'
                && $product->stock < $validated['quantity']
            ) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stok tidak mencukupi untuk barang keluar. Stok tersedia: '
                        . $product->stock . '.',
                ]);
            }

            if ($validated['type'] === 'in') {
                $product->stock += $validated['quantity'];
            } else {
                $product->stock -= $validated['quantity'];
            }

            $product->save();

            StockMovement::create($validated);
        });

        return redirect()
            ->route('stock-movements.index')
            ->with('success', 'Pergerakan stok berhasil dicatat dan stok produk telah diperbarui.');
    }

    public function show(StockMovement $stockMovement)
    {
        $stockMovement->load(['product', 'supplier']);

        return view('stock_movements.show', compact('stockMovement'));
    }

    public function edit(StockMovement $stockMovement)
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('stock_movements.edit', compact(
            'stockMovement',
            'products',
            'suppliers'
        ));
    }

    public function update(Request $request, StockMovement $stockMovement)
    {
        $validated = $request->validate([
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],
            'supplier_id' => [
                'nullable',
                'integer',
                'exists:suppliers,id',
            ],
            'type' => [
                'required',
                Rule::in(['in', 'out']),
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:2147483647',
            ],
            'movement_date' => [
                'required',
                'date',
            ],
            'note' => [
                'nullable',
                'string',
            ],
        ]);

        DB::transaction(function () use ($validated, $stockMovement) {
            $oldMovement = StockMovement::whereKey($stockMovement->id)
                ->lockForUpdate()
                ->firstOrFail();

            $oldProduct = Product::whereKey($oldMovement->product_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Batalkan pengaruh transaksi lama terhadap stok.
            if ($oldMovement->type === 'in') {
                $oldProduct->stock -= $oldMovement->quantity;
            } else {
                $oldProduct->stock += $oldMovement->quantity;
            }

            if ($oldProduct->stock < 0) {
                throw ValidationException::withMessages([
                    'quantity' => 'Transaksi lama tidak dapat dikoreksi karena hasil pembatalan stok menjadi negatif. Periksa riwayat perubahan stok terlebih dahulu.',
                ]);
            }

            $oldProduct->save();

            $newProduct = Product::whereKey($validated['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $validated['type'] === 'out'
                && $newProduct->stock < $validated['quantity']
            ) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stok tidak mencukupi untuk transaksi barang keluar. Stok tersedia: '
                        . $newProduct->stock . '.',
                ]);
            }

            // Terapkan transaksi baru.
            if ($validated['type'] === 'in') {
                $newProduct->stock += $validated['quantity'];
            } else {
                $newProduct->stock -= $validated['quantity'];
            }

            $newProduct->save();

            $oldMovement->update($validated);
        });

        return redirect()
            ->route('stock-movements.index')
            ->with('success', 'Pergerakan stok berhasil diperbarui dan stok produk disesuaikan.');
    }

    public function destroy(StockMovement $stockMovement)
    {
        DB::transaction(function () use ($stockMovement) {
            $movement = StockMovement::whereKey($stockMovement->id)
                ->lockForUpdate()
                ->firstOrFail();

            $product = Product::whereKey($movement->product_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Batalkan pengaruh transaksi yang dihapus.
            if ($movement->type === 'in') {
                $product->stock -= $movement->quantity;
            } else {
                $product->stock += $movement->quantity;
            }

            if ($product->stock < 0) {
                throw ValidationException::withMessages([
                    'movement' => 'Transaksi barang masuk tidak dapat dihapus karena akan membuat stok menjadi negatif. Periksa riwayat stok terlebih dahulu.',
                ]);
            }

            $product->save();
            $movement->delete();
        });

        return redirect()
            ->route('stock-movements.index')
            ->with('success', 'Pergerakan stok berhasil dihapus dan stok produk disesuaikan.');
    }
}
