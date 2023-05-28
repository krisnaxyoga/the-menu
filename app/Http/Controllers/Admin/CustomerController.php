<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Table;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($table)
    {
        // dd($table);
        return view('welcome',compact('table'));
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
            $data->table_id = $table[0]->id;
            $data->phone = $request->phone;
            $data->is_active = 1;
            $data->save();

            return redirect()
                ->route('menu.food',['table' => $request->table_number, 'cust' => $data->id])
                ->with('message', 'Reservation Success.');
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
