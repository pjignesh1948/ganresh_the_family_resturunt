<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VegetableSale;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VegetableSaleController extends Controller
{
    public function index(Request $request): View
    {
        $sales = VegetableSale::with('vegetable')
            ->when($request->filled('date'), fn ($q) => $q->whereDate('sold_date', $request->date))
            ->latest('sold_date')
            ->latest()
            ->get();

        $dayTotal = VegetableSale::when($request->filled('date'), fn ($q) => $q->whereDate('sold_date', $request->date))
            ->when(! $request->filled('date'), fn ($q) => $q->whereDate('sold_date', today()))
            ->sum('total_price');

        return view('admin.vegetable-sales.index', compact('sales', 'dayTotal'));
    }
}
