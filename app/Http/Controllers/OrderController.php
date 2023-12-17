<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    private $order_statuses = array("active" => "Active","pending" => "Pending","processing" => "Processing","cancel" => "Cancel","complete" => "Complete");
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
          $orders = Order::orWhereHas('customer', function($q) use ($search) {
                            return $q->where('first_name', 'LIKE', '%' . $search . '%')->orWhere('last_name', 'LIKE', '%' . $search . '%');
                        })->paginate(25);
        }else{
          $orders = Order::with('customer')->paginate(25); 
        }
        return view('developx.order.index', compact('orders','search'));
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
        $order = Order::with(['customer','order_products'])->find($id);
        $order_statuses =  $this->order_statuses;
        return view('developx.order.view', compact('order','order_statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::with(['customer','order_products'])->find($id);
        $order_statuses =  $this->order_statuses;
        return view('developx.order.edit', compact('order','order_statuses'));
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
        $order = Order::find($id);
        $order->order_status = $request->order_status;
        $order->save();

        return redirect()->route('order.index')->with('success','Order has been updated successfully!');
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

    public function exportCSV(Request $request){
      $orders = Order::all();
      $csvFileName = 'today_order.csv';
      $headers = [
          'Content-Type' => 'text/csv',
          'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
      ];

      $handle = fopen('php://output', 'w');
      fputcsv($handle, ['Name', 'Billing Address', 'Shiiping Address', 'Order Products', 'Total Price']); // Add more headers as needed

      foreach ($orders as $order) {
        $billing_address = "";
        $shipping_address = "";
        $fullname = $order->billing_first_name .' '. $order->billing_last_name;
        $billing_address .= $order->billing_company_name .', '. $order->billing_address .', ';
        $billing_address_2 = ($order->billing_address_2) ? $order->billing_address_2.", " : "";
        $billing_address .= $order->billing_province .', '. $order->billing_city .', '. $order->billing_postalcode .', '. $order->billing_country .', '. $order->billing_email .', '. $order->billing_phone .', ';

        if($order->shipping_address){
          $shipping_address .= $order->shipping_company_name .', '. $order->shipping_address .', ';
          $shipping_address_2 = ($order->shipping_address_2) ? $order->shipping_address_2.", " : "";
          $shipping_address .= $order->shipping_province .', '. $order->shipping_city .', '. $order->shipping_postalcode .', '. $order->shipping_country .', '. $order->shipping_email .', '. $order->shipping_phone .', ';
        }else{
          $shipping_address .= $billing_address;
        }

        $products = OrderProduct::where('order_id', $order->id)->get();
        $order_products = "";
        foreach ($products as $oproduct) {
          $order_products .= $oproduct->product->name ." (qty-".$oproduct->quantity." ), ";
        }        

        fputcsv($handle, [$fullname, $billing_address, $shipping_address, $order_products, $order->billing_total]); // Add more fields as needed
      }

      fclose($handle);

      return Response::make('', 200, $headers);
    }
}
