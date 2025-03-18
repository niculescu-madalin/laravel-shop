<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductSearchController extends Controller
{
    public function search(Request $request)
    {
        $validated = $request->validate([
            'q' => 'required|string|max:255'
        ]);
    
        $query = $validated['q'];
    
        $results = Product::query()
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->take(5)
            ->get(['id', 'name', 'slug']);
    
        return response()->json($results);
    }

    public function showResults(Request $request){
        $validated = $request->validate([
            'q' => 'required|string|max:255'
        ]);

        $query = $validated['q'];
        $perPage = 12;

        $products = Product::query()
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->paginate($perPage);

        return view('search.results', [
            'products' => $products,
            'searchTerm' => $query
        ]);
    }
}
