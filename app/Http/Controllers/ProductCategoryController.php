<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request  ): View
    {
        $categories = ProductCategory::with("users")->where(function($query) use($request){
            if($request->has('search') && !empty($request->search)) {
                $query->whereLike('name', "%{$request->search}%");
                $query->orWhereHas('users', fn($q) => $q->whereLike('name', "%{$request->search}%"));
            }
        })->paginate(4);
        return view('admin.product_category.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.product_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request): RedirectResponse    
    {
        // $path = $request->image->store('image', 'public');
        if($request->hasFile('image')){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images/product_categories/', $request->image, $imageName);
        }
        // dd($request->all());
        $product_category = new ProductCategory($request->except('image'));
        $product_category->image = $imageName;
        $product_category->created_by = Auth::id();
        $product_category->save();
        
        return redirect()->route('product-category.index')->with('category_success','Category successfully added');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $product_category = ProductCategory::find($id);
        return view('admin.product_category.edit', compact('product_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' =>'required',
        ]);

        $product_category = ProductCategory::find($id);
        $product_details = $request->except('image');

        if($request->hasFile('image')){

            $image_path = storage_path('app/public/images/product_categories/' . $product_category->image);
            if(file_exists($image_path)){
                @unlink($image_path);
            }
    
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('images/product_categories/', $request->image, $imageName);

            $product_details['image'] = $imageName;

        }
            $product_details['updated_by'] = Auth::id();
            $product_category->update($product_details);

        return redirect()->route('product-category.index')->with('update_category', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $product_category = ProductCategory::find($id);
        $product_category->delete();

        $image_path = storage_path('app/public/images/product_categories/' . $product_category->image);
        // dd($image_path);
        if(file_exists($image_path)){
            @unlink($image_path);
        }

        return redirect()->back()->with('delete_category', 'Product category deleted');
    }
}
