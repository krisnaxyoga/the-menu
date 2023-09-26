<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\CategoryProduct;
use App\Models\Table;
use App\Models\Customer;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Reservation;

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

    public function table($cust){
        $data = Table::all();
        $revq = Reservation::where('cust_id',$cust)->get();
        if($revq->isEmpty()){
            $rev = 0;
        }else{
            $rev= $revq[0]->table_id;
        }
        return view('table',compact('data','cust','rev'));
    }

    public function payment(Request $request,$meja,$cust){
        $data = Order::where('customer_id',$cust)->where('is_active',1)->get();
        $total = $data->sum('subtotal');
        return view('payment',compact('meja','cust','data','total'));
    }

    public function paymentprocess(Request $request,$meja,$cust){

        // dd($request->all());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);

            // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database

        }

        $image = "/images/".$filename;

        $payment = new Payment();
        $payment->price = $request->price;
        $payment->customer_id = $cust;
        $payment->image = $image;
        $payment->status = 1;
        $payment->save();

        $ordet = new OrderDetails;
        $ordet->cust_id = $cust;
        $ordet->total = $request->price;
        $ordet->status = 'selesai';
        $ordet->save();

        $customer = Customer::find($cust);
        $customer->is_active = 2;
        $customer->save();

        $order = Order::where('customer_id',$cust)->where('is_active',1)->get();

        foreach($order as $item){
           $or = Order::find($item->id);
           $or->is_active = 0;
           $or->save();
        }

        // $pesan = "bukti transfer berhasil di unggal!!";

        // $data = Order::where('customer_id',$cust)->where('is_active',1)->get();
        // $total = $data->sum('subtotal');
        return redirect()->back()->with('message', 'bukti transfer berhasil di unggal!!');
    }

    public function register(){
        return view('registrasi');
    }
    public function login(){
        $table = Table::all();
        return view('login',compact('table'));
    }

    public function loginproses(Request $request){
        // dd($request->all());
        $cust = Customer::where('email',$request->email)
        ->where('phone',$request->phone)
        ->get();

        if(!$cust){
            return back()->withErrors(['email' => 'Email and phone wrong!!!.']);
        }else{
            return redirect()->route('home.table',$cust[0]->id);
        }
    }
}
