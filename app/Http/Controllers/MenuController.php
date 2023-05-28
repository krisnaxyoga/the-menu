<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MenuController extends Controller
{
    public function index(Request $request,$meja,$cust){
        // dd($cust);
        $data = Product::all();
        return view('menu',compact('data','meja','cust'));
    }
    public function cart(Request $request,$meja,$cust){

        return view('cart',compact('meja','cust'));
    }
}
