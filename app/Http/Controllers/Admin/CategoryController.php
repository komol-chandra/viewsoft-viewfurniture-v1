<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Category;
use Image;
use Auth;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // create
    public function create(){
        return view('backend.category.create');
    }
    // store
    public function store(Request $request){
     
        $validated = $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'required',
        ]);
        $proname = $request->name;
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $proname);
        $insert=Category::insertGetId([
            'name'=>$request->name,
            'slug'=>$slug,
            'image'=>'',
            'updated_by'=>Auth::user()->id,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = 'Slider' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/category/' . $ImageName);
            Category::where('id', $insert)->update([
                'image' => $ImageName,
            ]);
        }
        if($insert){
            $notification = array(
                'messege' => 'Insert success!',
                'alert-type' => 'success'
              );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'insert Faild!',
                'alert-type' => 'error'
              );
            return redirect()->back()->with($notification);
        }
    }
    // all slider
    public function index(){
        $alldata=Category::where('is_deleted',0)->select(['name','image','id','is_active'])->orderBy('id','DESC')->get();
        return view('backend.category.index',compact('alldata'));
    }
    // active
    public function active($id){
        $active=Category::where('id',$id)->update([
            'is_active'=>1,
            'updated_by'=>Auth::user()->id,
            'updated_at'=>Carbon::now()->todateTimeString(),
        ]);
        if($active){
            $notification = array(
                'messege' => 'Active success!',
                'alert-type' => 'success'
              );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Active Faild!',
                'alert-type' => 'error'
              );
            return redirect()->back()->with($notification);
        }
    }
    // Deactive
    public function deactive($id){
        $Deactive=Category::where('id',$id)->update([
            'is_active'=>0,
            'updated_by'=>Auth::user()->id,
            'updated_at'=>Carbon::now()->todateTimeString(),
        ]);
        if($Deactive){
            $notification = array(
                'messege' => 'Deactive success!',
                'alert-type' => 'success'
              );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Deactive Faild!',
                'alert-type' => 'error'
              );
            return redirect()->back()->with($notification);
        }
    }
    // edit
    public function edit($id){
        $edit=Category::where('id',$id)->select(['id','name','image'])->first();
        return view('backend.category.update',compact('edit'));
    }
    // delete
    public function delete($id){
        $delete=Category::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_by'=>Auth::user()->id,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification = array(
                'messege' => 'Delete success!',
                'alert-type' => 'success'
              );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Delete Faild!',
                'alert-type' => 'error'
              );
            return redirect()->back()->with($notification);
        }
    }
    // update
    public function update(Request $request){
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $proname = $request->name;
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $proname);
        $update=Category::where('id',$request->id)->update([
            'name'=>$request->name,
            'slug'=> $slug,
            'updated_by'=>Auth::user()->id,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = 'Cate' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/category/' . $ImageName);
            Category::where('id',$request->id)->update([
                'image' => $ImageName,
            ]);
        }
        if($update){
            $notification = array(
                'messege' => 'Update success!',
                'alert-type' => 'success'
              );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Update Faild!',
                'alert-type' => 'error'
              );
            return redirect()->back()->with($notification);
        }
    }
}
