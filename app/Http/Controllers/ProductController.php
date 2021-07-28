<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
// use Illuminate\Http\File;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::latest()->paginate(15);
        return view('product.product', compact('products'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_name' => 'required',
            'product_c_name' => 'required',
            'product_price' => 'required',
        ]);

        $input = $request->all();

        if($image = $request->file('product_img')){
            $path = $request->file('product_img')->store('public/image');
            $input['product_img'] = substr($path, 7);
        }

        Products::create($input);

        return redirect()->route('product_index')
        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return Products::find($request->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->hidden;
        $product = Products::find($id);
        // image work
        $req = Arr::except($request->all(),['image']);

        // image
        if($request->product_img){
            Storage::disk('images')->delete($product->product_img);
            $image = $request->product_img;
            $imageName = Str::random(5).'.png';
            // dd($imageName);
            Storage::disk('images')->put($imageName, File::get($image));
            $req['product_img'] = $imageName;
        }

        // update product
        $product->update($req);
        // dd($product);
        return redirect()->route('product_index')->with('success','Product updated  successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd('destroy');
        $id = $request->hidden_id;
        $id = Products::find($id);
        dd($id);
        $id ->delete();
        return redirect()->route('product_index')->with('success','Product deleted  successfully.');
    }
}
