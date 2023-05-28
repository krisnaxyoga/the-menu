<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        
        $order = Customer::all();
        // dd($order);
        return view('admin.home', compact('order'));
    }
}
