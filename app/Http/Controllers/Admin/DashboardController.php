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
        
        $order = Customer::where('is_active',0)->with('table')->get();
        $orderbayar = Customer::where('is_active',2)->with('table')->get();
        // dd($order);
        return view('admin.home', compact('order','orderbayar'));
    }
}
