<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Book;
use App\Models\CustomerBook;
use App\Models\CustomerCoinLogs;

class Dashboard extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }
    
  public function index()
  {
    $customers = array(); 
    $customer_coin_history = array(); 
    $customer_books = array();

    $countdata['premium_books'] = 0;
    $countdata['free_books'] = 0; 
    $countdata['total_customers'] = 0; 

    $countdata['total_sell_amount'] = 0;

    return view('dashboard', compact('customers','customer_coin_history','customer_books','countdata'));
  }
}