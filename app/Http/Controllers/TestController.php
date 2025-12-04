<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Wallet;

class TestController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => Category::all(),
            'users' => User::with('wallet', 'seller')->get(),
            'products' => Product::with('category', 'seller.user')->get(),
            'wallets' => Wallet::with('user')->get(),
        ];

        return view('test', $data);
    }

    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return response()->json($categories);
    }

    public function products()
    {
        $products = Product::with(['category', 'seller.user'])->get();
        return response()->json($products);
    }

    public function users()
    {
        $users = User::with(['wallet', 'seller'])->get();
        return response()->json($users);
    }
}
