<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $list = Product::query()
            ->when(
                $request->filled('keywords'),
                function ($query) use ($request) {
                    $query->where('product_name', 'like', '%' . $request->keywords . '%')
                        ->orWhere('description', 'like', '%' . $request->keywords . '%');
                }
            )
            ->get();

        return view('products.index', compact('list'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:100|unique:products',
            'price' => 'required|numeric|gte:0',
            'stock' => 'required|integer|gte:0',
            'description' => 'nullable',
        ]);

        try {
            if ($request->hasFile('product_image')) {
                $validated['product_image'] = $request->file('product_image')->store('products', 'public');
            }

            Product::create($validated);

            return back()->with('success', 'Product created successfully!');
        } catch (\Exception $exception) {
            return back()
                ->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['needle' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:100|unique:products,product_name,' . $product->id,
            'price' => 'required|numeric|gte:0',
            'stock' => 'required|integer|gte:0',
            'description' => 'nullable',
        ]);

        try {
            if ($request->hasFile('product_image')) {
                $validated['product_image'] = $request->file('product_image')->store('products', 'public');
            }

            $product->update($validated);

            return back()->with('success', 'Product updated successfully!');
        } catch (\Exception $exception) {
            return back()
                ->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return back()->with('success', 'Product deleted successfully!');
        } catch (\Exception $exception) {
            return back()
                ->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
