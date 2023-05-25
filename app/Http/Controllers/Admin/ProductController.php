<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        return view('admin.product.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Product;
        $category = CategoryProduct::all();

        return view('admin.product.form',compact('model','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // maksimal 5MB
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $filename);
    
                // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
            }
            $iduser = auth()->user()->id;
            $image = "/images/".$filename;

            $data = new Product();
            $data->user_id = $iduser;
            $data->category_id = $request->category_id;
            $data->name = $request->name;
            $data->image_name = $filename;
            $data->image_url = $image;
            $data->price = $request->price;
            $data->description = $request->description;

            $data->save();

            return redirect()
                ->route('product.index')
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
        $model = Product::query()->findOrFail($id);
        $category = CategoryProduct::all();

        return view('admin.product.form',compact('model','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);
        $post = Product::findorfail($id);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            if($request->file('image') != null){
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
        
                    if (File::exists(public_path($post->image_url))) 
                    {
                        File::delete(public_path($post->image_url));
                    }
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $filename);
        
                    // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
                }
                $image = "/images/".$filename;
            }else{
                $image = $post->image_url;
                $filename = $post->image_name;
            }
            }
            $iduser = auth()->user()->id;
            
            $data = Product::find($id);
            $data->user_id = $iduser;
            $data->category_id = $request->category_id;
            $data->name = $request->name;
            $data->image_name = $filename;
            $data->image_url = $image;
            $data->price = $request->price;
            $data->description = $request->description;
            $data->save();

            return redirect()
                ->route('product.index')
                ->with('message', 'Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $post = Product::find($id);
        if (File::exists(public_path($post->image_url))) 
            {
                File::delete(public_path($post->image_url));
            }
        $post->delete();
        return redirect()->back()->with('message', 'berita berhasil dihapus');
    }
}
