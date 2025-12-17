<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:100|unique:categories,slug',
            'icon' => 'nullable|file|max:2048',
            'description' => 'nullable|string',
            'spec_template' => 'nullable|json',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $extension = strtolower($file->getClientOriginalExtension());

            // Validate extension manually
            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                return back()->withErrors(['icon' => 'File must be an image (jpg, jpeg, png, webp)']);
            }

            $iconPath = $file->store('categories', 'public');
            $validated['icon'] = $iconPath;
        }

        // Decode spec_template if it's JSON string
        if (isset($validated['spec_template'])) {
            $validated['spec_template'] = json_decode($validated['spec_template'], true);
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:100|unique:categories,slug,' . $category->id,
            'icon' => 'nullable|file|max:2048',
            'description' => 'nullable|string',
            'spec_template' => 'nullable|json',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $extension = strtolower($file->getClientOriginalExtension());

            // Validate extension manually
            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                return back()->withErrors(['icon' => 'File must be an image (jpg, jpeg, png, webp)']);
            }

            // Delete old icon if exists
            if ($category->icon && !str_starts_with($category->icon, 'http') && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }

            $iconPath = $file->store('categories', 'public');
            $validated['icon'] = $iconPath;
        }

        // Decode spec_template if it's JSON string
        if (isset($validated['spec_template'])) {
            $validated['spec_template'] = json_decode($validated['spec_template'], true);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category with existing products!');
        }

        // Delete icon if exists
        if ($category->icon && Storage::disk('public')->exists($category->icon)) {
            Storage::disk('public')->delete($category->icon);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
