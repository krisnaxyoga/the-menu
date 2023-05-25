<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MenuController extends Controller
{
    public function index(Request $request,$meja){

        $data = Product::all();
        return view('menu',compact('data'));
    }
}
