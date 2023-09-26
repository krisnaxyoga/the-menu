<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {

        $order = Customer::where('is_active',1)->with('table')->get();

        $orderpaid = Customer::where('is_active',2)->with('table')->get();
        $orderbayar = Customer::where('is_active',3)->with('table')->get();
        // dd($order);
        $table = Table::all();
        return view('admin.home', compact('order','orderbayar','table','orderpaid'));
    }

    public function kosongkanmeja($id){
        $table = Table::find($id);
        $table->is_active = 0;
        $table->save();

        return redirect()->back()->with('message', 'meja kosong');
    }
}
