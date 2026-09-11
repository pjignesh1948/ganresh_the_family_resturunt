<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vegetable;
use Illuminate\View\View;

class VegetableFlyerController extends Controller
{
    public function show(): View
    {
        $vegetables = Vegetable::query()
            ->where('is_active', 1)
            ->where('type', 'vegetable')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $fruits = Vegetable::query()
            ->where('is_active', 1)
            ->where('type', 'fruit')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.vegetables.flyer', compact('vegetables', 'fruits'));
    }
}
