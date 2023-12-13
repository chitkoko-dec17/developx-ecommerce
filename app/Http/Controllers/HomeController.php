<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['new_arrival'] = Product::latest()->take(9)->get();;
        return view('frontend.index',compact('data'));
    }

    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        // $mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();
        // $products_sa = DB::table('products')->orderBy('id','DESC')->paginate(4);

        // $stockLevel = getStockLevel($product->quantity);

        return view('frontend.detail')->with([
            'product' => $product,
            // 'stockLevel' => $stockLevel,
            // 'mightAlsoLike' => $mightAlsoLike,
            // 'products_sa' => $products_sa,
        ]);
    }

    public function cart(Request $request)
    {
        
        return view('frontend.cart');
    }

    public function wishlist(Request $request)
    {
        
        return view('frontend.wishlist');
    }

    public function checkout(Request $request)
    {
        
        return view('frontend.checkout');
    }

    public function contact(Request $request)
    {
        
        return view('frontend.contact');
    }

    public function product_list(Request $request)
    {
        
        return view('frontend.product');
    }

    public function login(Request $request)
    {
        
        return view('frontend.login');
    }

}
