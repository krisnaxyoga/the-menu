<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Validator;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table = Table::all();

        return view('admin.table.index',compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Table;
        
        return view('admin.table.form', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'table_number' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = new Table();
            $data->user_id = auth()->user()->id;
            $data->table_number = $request->table_number;
            $data->save();

            return redirect()
                ->route('table.index')
                ->with('message', 'Data berhasil disimpan.');
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
        $model = Table::find($id);

        return view('admin.table.form',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'table_number' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = Table::find($id);
            $data->user_id = auth()->user()->id;
            $data->table_number = $request->table_number;
            $data->save();

            return redirect()
                ->route('table.index')
                ->with('message', 'Data berhasil disimpan.');
        }

    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Table::find($id);
       
        $post->delete();
        return redirect()->back()->with('message', 'Data berhasil dihapus');
    }

    public function createmenu(Request $request,$table)
    {
        $post = Table::where('id',$table)->get();
        $url = url('/menu/'.$post[0]->table_number); 
        return view('admin.table.qrmenu',compact('url'));
        // $qrCode = QrCode::format('png')->size(200)->generate($url);
        // return response($qrCode)->header('Content-Type', 'image/png');
    }
}
