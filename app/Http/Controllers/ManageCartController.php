<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManageCartController extends Controller
{
    public function viewProducts(Request $request): View {

        $products = Product::where( function($query) use ($request) {
            if($request->has('search') && !empty($request->search)) {
            $query->whereLike('name', "%{$request->search}%");
            }
        })->get();
        return view('user.product.index', compact('products'));
    }

    public function cartItems(){
        // $product = Product::find($id);

        return view('user.product.cart');
    }

    public function productDetails(string $id){
        $product = Product::find($id);

        return view('user.product.show', compact('product'));
    }

    public function cart(Request $request){
        return view('user.product.cart');
    }

    public function cartProducts(Request $request){
        $validate = Validator::make($request->all(), [
            'product_ids' => ['required', 'array']
        ]);

        if($validate->fails()){
            return response()->json($validate->errors(), 422);
        }

        $productIDs = $request->product_ids;
        $products = Product::whereIn('id', $productIDs)->get();
        return response()->json($products, 200);
    }


}
