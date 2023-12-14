<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    /**
     * Check authentication in the constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check for search input
        // Get the search value from the request
        $search = $request->input('q');
        if($search){
          $products = Product::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('sku', 'LIKE', "%{$search}%")
                ->latest()
                ->paginate(25);

        }else{
          $products = Product::paginate(25); 
        }
        return view('developx.inventory.index', compact('products','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('developx.inventory.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity'         =>  'required|integer',
        ]); 

        //inventory saved success
        $inventory = new Inventory;
        $inventory->product_id = $id;
        $inventory->quantity = $request->quantity;
        $inventory->description = $request->description;
        $inventory->save();

        //update product quantity when inventory saved success
        if($inventory){
            $product = Product::find($id);
            $product->quantity = $product->quantity + $request->quantity;
            $product->save();
        }
        return redirect()->route('product-inventory.index')->with('success', 'Add Product Inventory successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
