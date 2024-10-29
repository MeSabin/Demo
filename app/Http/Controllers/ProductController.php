<?php

namespace App\Http\Controllers;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
      
        $products = Product::with('productCategory')->where(function($query) use ($request){
            if($request->has('search') && !empty($request->search)){
                    $query->whereLike('name', "%{$request->search}%");

                    $query->orWhereHas('productCategory', fn($q) =>  $q->whereLike('name', "%{$request->search}%"));
            }
        })->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $product_categories = ProductCategory::all();
        return view('admin.product.create', compact('product_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request): RedirectResponse
    {
        $imageName = null;  
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images/products', $request->image, $imageName);
        }

        $data = $request->except('image');
        $data['image'] = $imageName;
        $data['created_by'] = Auth::id();

        Product::create($data);

        return redirect()->route('products.index')->with('addProducts', 'Product added successfully'); // dd($product->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $products = Product::with('productcategory')->find($product->id);
        $product_categories = ProductCategory::all();
        return view('admin.product.edit', compact('products', 'product_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = storage_path('app/public/images/products/' . $product->image);

            if (file_exists($path)) {
                unlink($path);
            }
            $image = time() . '.' . $request->image->extension();
            Storage::disk('public')->putFileAs('/images/products/', $request->image, $image);

            $data['image'] = $image;
        }
        $data['updated_by'] = Auth::id();

        $product->update($data);

        return redirect()->route('products.index')->with('updateProduct', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $product = Product::find($id);
        $product->delete();

        $path = storage_path('app/public/images/products/' . $product->image);
        if (file_exists($path)) {
            @unlink($path);
        }

        return redirect()->route('products.index')->with('productDelete', 'Product deleted successfully');
    }
}
