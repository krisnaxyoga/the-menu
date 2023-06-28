<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\CategoryProduct;
use App\Models\Table;

class MenuController extends Controller
{
    public function index(Request $request,$meja,$cust){

        $category = $request->data;
        
        if ($category) {
            $data = Product::where('category_id', $category['category'])->get();
            // return ($category);
        } else {
            $data = Product::all();
        }
        $category = CategoryProduct::all();
        return view('menu',compact('data','meja','cust','category'));
    }
    public function cart(Request $request,$meja,$cust){

        return view('cart',compact('meja','cust'));
    }

    public function orderlist(Request $request,$meja,$cust){
        $data = Order::where('customer_id',$cust)->get();
        return view('order',compact('meja','cust','data'));
    }

    public function table(){
        $data = Table::all();

        return view('table',compact('data'));
    }

    public function payment(Request $request,$meja,$cust){
        $data = Order::where('customer_id',$cust)->get();

        return view('table',compact('data'));
    }
}
