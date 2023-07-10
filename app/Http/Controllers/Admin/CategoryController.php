<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    public function index(){

        $category = Category::all();
      return view('admin.category.start',compact('category'));
//        return "hello";
    }

    public function add(){
        return view('admin.category.add');
    }
    public function insert(Request $request){

       $category = new Category();
       if ($request->hasFile('image'))
       {
           $file = $request->file('image');
           $ext = $file->getClientOriginalExtension();
           $filename = time().'.'.$ext;
           $file->move('assets/uploads/category',$filename);
           $category->image = $filename;
       }
       $category->name = $request->input('name');
       $category->slug = $request->input('slug');
       $category->description = $request->input('description');
       $category->status = $request->input('status') == True ? '1':'0';
       $category->popular = $request->input('popular') == True ? '1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');
        $category->save();
        return redirect('/dashboard')->with('status',"Category Added Successfully");
    }
    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }
    public function update(Request $request,$id){
        $category = Category::find($id);
        if ($request->hasFile('image'))
        {
            $path = 'assets/uploads/category/'.$category->image;
            if (File::exists($path))
            {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category',$filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == True ? '1':'0';
        $category->popular = $request->input('popular') == True ? '1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');
        $category->update();
        return redirect('/dashboard')->with('status',"Category updated Successfully");

    }
    public function destroy($id){
        $category = Category::find($id);
        if ($category->image)
        {
            $path = 'assets/uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('categories')->with('status',"Category deleted Successfully");
    }

    public function dashboard()
    {
        $categoryCount = Category::count();
        $productCount = Product::count();
        $userCount = User::count();
        $orderCount = Order::count();
        $pendingOrderCount = Order::where('status', 'pending')->count();
        $completeOrderCount = Order::where('status', 'complete')->count();

        return view('admin.index', compact('categoryCount', 'productCount', 'userCount','orderCount','pendingOrderCount','completeOrderCount'));
    }


}
