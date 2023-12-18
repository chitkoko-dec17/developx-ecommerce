<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
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
        return view('developx.product.index', compact('products','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('developx.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'   =>  'required',
            'name'          =>  'required',
            'sku'           =>  'required',
            'details'       =>  'required',
            'description'   =>  'required',
            'price'         =>  'required|integer',
            'image'         =>  'required|image|mimes:jpg,png,jpeg|max:3072'
        ]); 

        //create file name and move file to the staroge path
        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images/products'), $file_name);
        $image_path = 'images/products/';

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->slug = Str::slug($request->name,'-');
        $product->details = $request->details;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->featured = $request->featured;
        $product->image = $image_path.$file_name;
        $product->quantity = $request->quantity;
        $product->min_quantity = 5;
        $product->status = 'active';
        $product->save();

        return redirect()->route('product.index')->with('success', 'New Product Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('developx.product.view', compact('product'));
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
        $categories = Category::get();
        return view('developx.product.edit', compact('product','categories'));
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
            'category_id'   =>  'required',
            'name'          =>  'required',
            'sku'           =>  'required',
            'details'       =>  'required',
            'description'   =>  'required',
            'price'         =>  'required|integer',
            'cover_image'   =>  'image|mimes:jpg,png,jpeg|max:3072'
        ]); 

        $image_path = 'images/products/';

        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->slug = Str::slug($request->name,'-');
        $product->details = $request->details;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;

        if($request->hasfile('image')) {
            $old_product_image = $product->image;

            //delete old image in the product image directory
            if($old_product_image){
              if(file_exists(public_path($old_product_image))){
                  unlink(public_path($old_product_image));
              }
            }

            //create file name
            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path($image_path), $file_name);
            $product->image = $image_path.$file_name;
        }
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product Edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product has been deleted successfully!');
    }
}
