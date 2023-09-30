<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function color()
    {
        $colors = Color::all();
        return view('admin.category.addcolor')->with('colors', $colors);
    }

    public function insertColor(Request $request)
    {

        $color = new Color();
        $color->name = $request->input('name');
        $color->code = $request->input('code');
        $color->save();
//        return redirect('add-color')->with('status',"Color Added Successfully");
//        return view('admin.category.list');
    }

    public function showList()
    {
        $colors = Color::all();
        return view('admin.category.list')->with('colors', $colors);

    }

    public function editColor($id)
    {

        $colors = Color::find($id);
        return view('admin.category.editcolor',compact('colors'));
    }

    public function updateColor(Request $request,$id)
    {

        $colors = Color::find($id);
        $colors->name = $request->input('name');
        $colors->code = $request->input('code');
        $colors->update();
    }

    public function deleteColor($id)
    {
        $colors = Color::find($id);
        $colors->delete();
       return redirect('show-list')->with('status',"Color deleted Successfully");

    }

}
