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
        $data['new_arrival'] = Product::take(8)->inRandomOrder()->get();
        $data['best_seller'] = Product::orderBy('id','DESC')->paginate(8);
        $data['featured'] = Product::orderBy('id','ASC')->paginate(8);
        return view('frontend.index',compact('data'));
    }

    public function detail($slug)
    {
        $data['product'] = Product::where('slug', $slug)->firstOrFail();
        $data['mightAlsoLike'] = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();

        // $stockLevel = getStockLevel($product->quantity);

        return view('frontend.detail',compact('data'));
    }


    public function contact(Request $request)
    {
        
        return view('frontend.contact');
    }

    public function product_list(Request $request)
    {
        // Check for search input
        // Get the search value from the request
        $search = $request->input('q');
        if($search){
          $products = Product::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('sku', 'LIKE', "%{$search}%")
                ->latest()
                ->paginate(20);

        }else{
          $products = Product::paginate(20); 
        }
        return view('frontend.product',compact('products','search'));
    }

    public function login()
    {
        if( auth()->guard('customer')->check() ){
            return redirect('/');
        }
        return view('frontend.login');
    }

}
