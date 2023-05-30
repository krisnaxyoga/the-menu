<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::all();

        return view('admin.order.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'total' => 'required',
            'cust' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $ordet = new OrderDetails;
            $ordet->cust_id = $request->cust;
            $ordet->total = $request->total;
            $ordet->status = 'selesai';
            $ordet->save();

            $customer = Customer::find($request->cust);
            $customer->is_active = 0;
            $customer->save();

            $order = Order::where('customer_id',$request->cust)->get();

            foreach($order as $item){
               $or = Order::find($item->id);
               $or->is_active = 0;
               $or->save();
            }

            return redirect()
            ->route('home')
            ->with('message', 'Reservation Success.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::where('customer_id',$id)->with('customer')->with('table')->with('product')->where('is_active',1)->get();
        $total = Order::where('customer_id',$id)->sum('subtotal');
        $cust_id = $id;
        return view('admin.order.detail',compact('order','total','cust_id'));
    }
    public function paid(string $id)
    {
        $od = OrderDetails::where('cust_id',$id)->get();
        $ordet = OrderDetails::find($od[0]->id);
        $ordet->status = 'dibayar';
        $ordet->save();

        $customer = Customer::find($id);
        $customer->is_active = 2;
        $customer->save();

        $order = Order::where('customer_id',$id)->get();

        foreach($order as $item){
        $or = Order::find($item->id);
        $or->is_active = 2;
        $or->save();
        }

        return redirect()
        ->route('home')
        ->with('message', 'Reservation Success.');
    }
    public function showselesai(string $id)
    {
        $order = Order::where('customer_id',$id)->with('customer')->with('table')->with('product')->where('is_active',0)->get();
        $total = Order::where('customer_id',$id)->sum('subtotal');
        $cust_id = $id;
        return view('admin.order.selesai',compact('order','total','cust_id'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
