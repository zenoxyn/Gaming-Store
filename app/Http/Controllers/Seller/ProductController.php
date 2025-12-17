<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seller = Auth::user()->seller;
        $products = Product::where('id_seller', $seller->id)
            ->with(['category'])
            ->latest()
            ->paginate(10);

        return view('seller.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('seller.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_category' => 'required|exists:categories,id',
            'name_product' => 'required|string|max:100',
            'type_product' => 'required|in:account,topup,ingame_item',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'product_details' => 'nullable|json',
        ]);

        $seller = Auth::user()->seller;
        $validated['id_seller'] = $seller->id;

        // Handle multiple images upload
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagePaths[] = $path;
            }
        }
        $validated['images'] = $imagePaths;

        // Decode product_details
        if (isset($validated['product_details'])) {
            $validated['product_details'] = json_decode($validated['product_details'], true);
        }

        // Set status
        $validated['status'] = $validated['stock'] > 0 ? 'available' : 'out_of_stock';

        Product::create($validated);

        return redirect()->route('seller.products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $seller = Auth::user()->seller;
        
        // Check if seller exists and product belongs to this seller
        if (!$seller || $product->id_seller != $seller->id) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::orderBy('name')->get();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $seller = Auth::user()->seller;
        
        // Check if seller exists and product belongs to this seller
        if (!$seller || $product->id_seller != $seller->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'id_category' => 'required|exists:categories,id',
            'name_product' => 'required|string|max:100',
            'type_product' => 'required|in:account,topup,ingame_item',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'product_details' => 'nullable|json',
            'delete_images' => 'nullable|array',
        ]);

        // Handle image deletion
        if ($request->has('delete_images')) {
            $existingImages = is_array($product->images) ? $product->images : [];
            foreach ($request->delete_images as $imageToDelete) {
                if (Storage::disk('public')->exists($imageToDelete)) {
                    Storage::disk('public')->delete($imageToDelete);
                }
                $existingImages = array_filter($existingImages, fn($img) => $img !== $imageToDelete);
            }
            $validated['images'] = array_values($existingImages);
        } else {
            $validated['images'] = is_array($product->images) ? $product->images : [];
        }

        // Handle new images upload
        if ($request->hasFile('images')) {
            // Ensure $validated['images'] is an array before appending
            if (!isset($validated['images']) || !is_array($validated['images'])) {
                $validated['images'] = [];
            }

            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $validated['images'][] = $path;
            }
        }

        // Decode product_details
        if (isset($validated['product_details'])) {
            $validated['product_details'] = json_decode($validated['product_details'], true);
        }

        // Update status based on stock
        $validated['status'] = $validated['stock'] > 0 ? 'available' : 'out_of_stock';

        $product->update($validated);

        return redirect()->route('seller.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $seller = Auth::user()->seller;
        
        // Check if seller exists and product belongs to this seller
        if (!$seller || $product->id_seller != $seller->id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete all product images
        if ($product->images) {
            foreach ($product->images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
