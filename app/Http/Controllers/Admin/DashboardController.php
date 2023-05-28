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
        
        $order = Customer::where('is_active',1)->with('table')->get();
        // dd($order);
        return view('admin.home', compact('order'));
    }
}
