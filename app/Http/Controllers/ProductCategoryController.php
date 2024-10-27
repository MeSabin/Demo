<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::with("users")->get();
        
        // $created_by = ProductCategory::pluck('created_by');

        // $added_by  = ProductCategory::with('user')->find($created_by);
        // $added_by = ProductCategory::find(21)->user;
        // $name = $added_by->name;
        // dd($added_by);
      
        return view('product-category' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('add-category');
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
    public function edit(string $id)
    {
        $product_category = ProductCategory::find($id);
        return view('update-category', compact('product_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' =>'required',
        ]);

        $product_category = ProductCategory::find($id);

        if($request->hasFile(   'image')){

            $image_path = storage_path('app/public/images/product_categories'. $product_category->image);
            // dd($image_path);
            if(file_exists($image_path)){
                @unlink($image_path);
            }
    

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            // $request->image->move(storage_path('app/public/images'),$imageName);
            Storage::disk('public')->putFileAs('images/product_categories', $request->image, $imageName);

            $product_category->image = $imageName;
            $product_category->name = $request->name;
            $product_category->updated_by = Auth::id();
            $product_category->save();
        }
        else{
            $originalImage = $product_category->image;
            $product_category->name = $request->name;
            $product_category->updated_by = Auth::id();
            $product_category->image = $originalImage;
            $product_category->save();
        }
        return redirect()->route('product-category.index')->with('update_category', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_category = ProductCategory::find($id);
        $product_category->delete();

        $image_path = storage_path('app/public/images/product_categories'. $product_category->image);
        // dd($image_path);
        if(file_exists($image_path)){
            @unlink($image_path);
        }

        return redirect()->back()->with('delete_category', 'Product category deleted');
    }
}
