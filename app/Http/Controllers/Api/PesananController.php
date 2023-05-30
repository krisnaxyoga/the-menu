<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class PesananController extends Controller
{
    public function index(){
        $data = Customer::where('is_active',1)->with('table')->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
