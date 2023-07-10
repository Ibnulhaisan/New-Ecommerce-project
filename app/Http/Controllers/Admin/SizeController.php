<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function size()
    {
        $sizes = Size::all();
        return view('admin.product.addsize')->with('sizes',$sizes);
    }

    public function insertSize(Request $request)
    {
        $product_size = new Size();
        $product_size->size = $request->input('size');
        $product_size->save();
    }

    public function sizeList()
    {
        $product_size = Size::all();
        return view('admin.product.sizelist')->with('product_size',$product_size);
    }

    public function editSize($id)
    {
        $product_size = Size::find($id);
        return view('admin.category.editsize',compact('product_size'));
    }

    public function updateSize(Request $request,$id)
    {
        $product_size = Size::find($id);
        $product_size->size = $request->input('size');
        $product_size->update();
    }

    public function deleteSize($id)
    {
        $product_size = Size::find($id);
        $product_size->delete();
        return redirect('show-size-list')->with('status',"Size deleted Successfully");

    }

}
