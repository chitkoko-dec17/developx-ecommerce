<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class CustomerController extends Controller
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
          $customers = Customer::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->latest()
                ->paginate(25);

        }else{
          $customers = Customer::paginate(25);
        }
        return view('developx.customer.index', compact('customers','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('developx.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'address' => 'required',
        // ]);
        
        // Company::create($request->post());

        // return redirect()->route('developx.customer.index')->with('success','Customer has been created successfully.');

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
        $customer = Customer::where('id', $id)->first();
        return view('developx.customer.edit',compact('customer'));
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
        // $request->validate([
        //     'total_coin' => 'integer'
        // ]);
        
        // $customer = Customer::find($id);
        // $customer->total_coin = $request->total_coin;
        // $customer->status = $request->status;
        // $customer->save();

        // return redirect()->route('customer.index')->with('success','Customer has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Customer has been deleted successfully!');
    }

    public function updatePassword(Request $request,$id)
    {
        //Validation
        $request->validate([
            'new_password' => 'required|confirmed',
        ]);

        //Update the new Password
        Customer::whereId($id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('customer.index')->with('success', "Customer Password changed successfully!");
    }
}
