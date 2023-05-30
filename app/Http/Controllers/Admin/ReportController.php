<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetails;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $start = $request->startdate;
        $end = $request->enddate; 
        // dd($start);
        if($start){
            $data = OrderDetails::where('created_at', $start)->where('status','dibayar')->get();
           
        }elseif($start && $end){
            $data = OrderDetails::whereBetween('created_at', [$start, $end])->where('status','dibayar')->get();
            dd($data);
        }else{
            $data = OrderDetails::where('status','dibayar')->get();
        }
        $total = $data->sum('total');
        return view('admin.report.index',compact('data','total'));
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
        //
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
