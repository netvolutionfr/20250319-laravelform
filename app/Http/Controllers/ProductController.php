<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'pdf' => 'nullable|mimes:pdf|max:4096'
        ]);

        $image = $validated['image'];
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $validated['image'] = $imageName;

        $pdf = $validated['pdf'];
        if ($pdf) {
            $pdfName = time() . '-' . $pdf->getClientOriginalName();
            $pdf->move(public_path('pdfs'), $pdfName);
            $validated['pdf'] = $pdfName;
        }

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, int $id) {
        $product = Product::find($id)->first();
        // log the product to see if it is being fetched
        Log::info($product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0'
        ]);

        $product->fill($validated)->save();
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
