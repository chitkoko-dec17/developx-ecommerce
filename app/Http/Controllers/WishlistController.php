<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // var_dump(Cart::instance('wishlist')->count());
        // foreach (Cart::instance('wishlist')->content() as $item) {
        //     var_dump($item);
        // }
        return view('frontend.wishlist');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product)
    {
        $duplicates = Cart::instance('shopping')->search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('wishlist.index')->with('success_message', 'Item is already added in wishlist!');
        }

        Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->price)
            ->associate('App\Models\Product');

        return redirect()->route('wishlist.index')->with('success_message', 'Item has been added in wishlist!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('wishlist')->remove($id);

        return back()->with('success_message', 'Item has been removed!');
    }


}
