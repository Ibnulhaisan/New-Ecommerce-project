<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function size()
    {
        $product_sizes = Size::all();
        return view('admin.product.addsize')->with('product_sizes',$product_sizes);
    }

    public function insertSize(Request $request)
    {
        $product_size = new Size();
        $product_size->size = $request->input('size');
        $product_size->save();
    }

    public function sizeList()
    {
        $product_sizes = Size::all();
        return view('admin.product.sizelist')->with('product_sizes',$product_sizes);
    }

    public function editSize($id)
    {

        $product_sizes = Size::find($id);
        return view('admin.category.editsize',compact('product_sizes'));
    }

    public function updateSize(Request $request,$id)
    {
//        dd($request->all());
        $product_sizes = Size::find($id);
        $product_sizes->size = $request->input('size');
        $product_sizes->update();
    }

    public function deleteSize($id)
    {
        $product_sizes = Size::find($id);
        $product_sizes->delete();
        return redirect('show-size-list')->with('status',"Size deleted Successfully");

    }

}
