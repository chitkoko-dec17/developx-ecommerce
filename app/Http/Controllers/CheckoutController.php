<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
// use Cartalyst\Stripe\Laravel\Facades\Stripe;
// use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::instance('shopping')->count() == 0) {
            return redirect()->route('cart.index');
        }

        if (auth()->user() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }

        $customer = array();
        $last_order = array();
        if( auth()->guard('customer')->check() ){
            $customer = Customer::where('id', Auth::guard('customer')->id())->first();
            $last_order = Order::where('customer_id', Auth::guard('customer')->id())->orderBy('id','DESC')->limit(1)->first();
        }

        return view('frontend.checkout', compact('customer','last_order'));
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
            'billing_email' => 'required|email',
            'billing_first_name' => 'required',
            'billing_last_name' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_province' => 'required',
            'billing_postalcode' => 'required',
        ]);

        // Check race condition when there are less items available to purchase
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Sorry! One of the items in your cart is no longer avialble.');
        }

        try {
            $order = $this->addToOrdersTables($request, '');
            // Mail::send(new OrderPlaced($order)); //order mail send

            // decrease the quantities of all the products in the cart
            $this->decreaseQuantities();

            Cart::instance('shopping')->destroy(); //cart clear

            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } catch (\Illuminate\Database\QueryException $exception) {
            return back()->withErrors('Error! ' . $exception);
        }
    }

    protected function addToOrdersTables($request, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'customer_id' => Auth::guard('customer') ? Auth::guard('customer')->id() : '',
            'billing_email' => $request->billing_email,
            'billing_first_name' => $request->billing_first_name,
            'billing_last_name' => $request->billing_last_name,
            'billing_company_name' => $request->billing_company_name,
            'billing_address' => $request->billing_address,
            'billing_address_2' => $request->billing_address_2,
            'billing_city' => $request->billing_city,
            'billing_province' => $request->billing_province,
            'billing_postalcode' => $request->billing_postalcode,
            'billing_country' => $request->billing_country,
            'billing_phone' => $request->billing_phone,
            'billing_name_on_card' => $request->billing_name_on_card,
            'billing_subtotal' => Cart::instance('shopping')->total(),
            'billing_total' => Cart::instance('shopping')->total(),
            'shipping_email' => $request->shipping_email,
            'shipping_first_name' => $request->shipping_first_name,
            'shipping_last_name' => $request->shipping_last_name,
            'shipping_company_name' => $request->shipping_company_name,
            'shipping_address' => $request->shipping_address,
            'shipping_address_2' => $request->shipping_address_2,
            'shipping_city' => $request->shipping_city,
            'shipping_province' => $request->shipping_province,
            'shipping_postalcode' => $request->shipping_postalcode,
            'shipping_country' => $request->shipping_country,
            'shipping_phone' => $request->shipping_phone,
            'payment_gateway' => "stripe",
            'shipped' => 0,
            'order_status' => "active",
            'order_note' => $request->order_note
        ]);

        // Insert into order_product table
        foreach (Cart::instance('shopping')->content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }

    protected function decreaseQuantities()
    {
        foreach (Cart::instance('shopping')->content() as $item) {
            Product::where('id', $item->model->id)->decrement('quantity', $item->qty);
        }
    }

    protected function productsAreNoLongerAvailable()
    {
        foreach (Cart::instance('shopping')->content() as $item) {
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty) {
                return true;
            }
        }

        return false;
    }

    public function thankyou(){
        return view('frontend.thankyou');
    }
}
