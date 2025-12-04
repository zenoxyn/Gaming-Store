<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Home page
    public function index()
    {
        $categories = Category::withCount('products')->take(6)->get();
        $featuredProducts = Product::with(['seller.user', 'category'])
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('categories', 'featuredProducts'));
    }

    // Product listing by category (account, topup, in-game items)
    public function listByType($type)
    {
        $query = Product::with(['seller.user', 'category'])
            ->where('stock', '>', 0);

        // Filter by product type
        if ($type === 'account') {
            $query->where('type_product', 'account');
            $viewTitle = 'Game Accounts';
        } elseif ($type === 'top-up') {
            $query->where('type_product', 'topup');
            $viewTitle = 'Top Up';
        } elseif ($type === 'in-game-items') {
            $query->where('type_product', 'ingame_item');
            $viewTitle = 'In-Game Items';
        } else {
            abort(404);
        }

        $products = $query->latest()->paginate(20);
        $categories = Category::withCount('products')->get();

        return view('products', compact('products', 'categories', 'viewTitle', 'type'));
    }

    // Product listing by category slug
    public function listByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = Product::with(['seller.user', 'category'])
            ->where('id_category', $category->id)
            ->where('stock', '>', 0)
            ->latest()
            ->paginate(20);

        $categories = Category::withCount('products')->get();

        return view('products', compact('products', 'categories', 'category'));
    }

    // Product detail page
    public function show($id)
    {
        $product = Product::with(['seller.user', 'category'])
            ->findOrFail($id);

        // Get seller reviews
        $sellerReviews = $product->seller->user->sellerReviews()
            ->with(['buyer', 'product'])
            ->latest()
            ->take(10)
            ->get();

        // Get related products (same category)
        $relatedProducts = Product::with(['seller.user', 'category'])
            ->where('id_category', $product->id_category)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->take(6)
            ->get();

        return view('product-detail', compact('product', 'sellerReviews', 'relatedProducts'));
    }

    // Search products
    public function search(Request $request)
    {
        $query = $request->input('q');

        $products = Product::with(['seller.user', 'category'])
            ->where('stock', '>', 0)
            ->where(function($q) use ($query) {
                $q->where('name_product', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->paginate(20);

        $categories = Category::withCount('products')->get();

        return view('products', compact('products', 'categories', 'query'));
    }
}
