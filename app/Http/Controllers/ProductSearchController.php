<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $results = Product::when($query, function ($q) use ($query) {
                return $q->where('name', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->take(5)
            ->get(['id', 'name', 'slug']);

        return response()->json($results);
    }
}
