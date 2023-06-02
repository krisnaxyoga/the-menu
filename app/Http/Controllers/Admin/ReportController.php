<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $start = Carbon::parse($request->startdate)->format('Y-m-d');
        $end = Carbon::parse($request->enddate)->format('Y-m-d'); 
        // dd($start);
        if($start && $end){
            $data = OrderDetails::whereBetween(DB::raw('DATE(created_at)'), [$start, $end])->where('status','dibayar')->get();
            // dd($data);
        }else{
            $data = OrderDetails::where('status','dibayar')->get();
        }
        $data = $data;
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
