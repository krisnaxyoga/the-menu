<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($table,$cust)
    {
        // dd($table);
        $cust = Customer::where('id',$cust)->get();
        return view('welcome',compact('table','cust'));
    }

    public function cust()
    {
        // dd($table);
        $data = Customer::all();
        return view('admin.customer.index',compact('data'));
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

        $table = Table::where('table_number',$request->table_number)->get();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // dd($table[0]->id);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = new Customer();
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->is_active = 0;
            $data->kota = "-";
            $data->save();

            // $meja = Table::find($table[0]->id);
            // $meja->is_active = 1;
            // $meja->save();

            return redirect()
                // ->route('menu.food',['table' => $request->table_number, 'cust' => $data->id])
                ->route('home.login')
                ->with('message', 'Register Success.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $table = Table::where('table_number',$request->table_number)->get();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        // dd($table[0]->id);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = Customer::find($id);
            $data->name = $request->name;
            $data->table_id = $table[0]->id;
            $data->waktu_reservasi = $request->waktu_reservasi;
            $data->tgl_reservasi = $request->tgl_reservasi;
            $data->is_active = 1;
            $data->kota = "-";
            $data->save();

            $meja = Table::find($table[0]->id);
            $meja->is_active = 1;
            $meja->save();

            $rev = new Reservation();
            $rev->cust_id = $id;
            $rev->table_id = $table[0]->id;
            $rev->save();

            return redirect()
                ->route('menu.food',['table' => $request->table_number, 'cust' => $data->id])
                // ->route('home.login')
                ->with('message', 'Reservation Success.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
