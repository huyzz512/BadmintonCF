<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'primaryImage', 'variants'])->get();

        return view('home', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'primaryImage'])->where('slug', $slug)->firstOrFail();
        $specs = json_decode($product->specifications, true);

        return view('detail', compact('product', 'specs'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();
        return view('home', compact('products', 'category'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');

        $products = Product::where('product_name', 'LIKE', "%{$keyword}%")
            ->orWhere('description', 'LIKE', "%{$keyword}%")
            ->get();

        return view('home', [
            'products' => $products,
            'search_title' => "Kết quả tìm kiếm cho: '$keyword'"
        ]);
    }
}