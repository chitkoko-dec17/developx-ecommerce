<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mightAlsoLike = Product::mightAlsoLike()->get();
        $top_pick = DB::table('products')->orderBy('id','DESC')->paginate(4);
        $top_pick2 = DB::table('products')->orderBy('id','ASC')->paginate(4);

        return view('frontend.cart')->with([
            'mightAlsoLike' => $mightAlsoLike,
            'top_pick' => $top_pick,
            'top_pick2' => $top_pick2,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {
        $duplicates = Cart::instance('shopping')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
        }

        $qty = isset($request->cart_qty) ? $request->cart_qty : 1 ; 

        Cart::instance('shopping')->add($product->id, $product->name, $qty, $product->price)
            ->associate('App\Models\Product');

        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'cart_qty.*' => 'required|numeric|between:1,99'
        ]);

        if ($validator->fails()) {
            return redirect()->route('cart.index')->with('errors', collect(['Quantity must be between 1 and 99.']));
        }

        foreach($request['cart_item_ids'] as $key => $citemid){
            Cart::instance('shopping')->update($citemid, $request['cart_qty'][$key]);
        }
        
        return redirect()->route('cart.index')->with('success_message', 'Quantity was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('shopping')->remove($id);

        return back()->with('success_message', 'Item has been removed!');
    }

}
