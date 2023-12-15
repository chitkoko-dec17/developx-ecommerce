<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Customer;
use Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
  
class CustomerAuthController extends Controller
{	
	public function register(Request $request)
    {  
        $request->validate([
        	'first_name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|confirmed|min:6',
        ]);
          
        $data = $request->all();
        $check = $this->create($data);
        if($check){
        	Auth::guard('customer')->login($check);
        	return back()->with('success_message', 'Great! You have Successfully loggedin');
        }
         
        return back()->withErrors('Registration failed');
        
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {
        	if(Cart::count() > 0){
        		return redirect("cart");
        	}else{
        		return back()->with('success_message', 'Great! You have Successfully loggedin');
        	}
            
        }
  
        return back()->withErrors('Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return Customer::create([
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'status' => 'active'
      ]);
    }

    public function logout(){
        Session::flush();
        Auth::guard('customer')->logout();
        return back()->with('success_message', 'Successfully Logout');
    }
}