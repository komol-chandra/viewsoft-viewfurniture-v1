<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Models\Slider;
use Carbon\Carbon;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // create
    public function create(){
        return view('backend.slider.create');
    }
    // store
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'required',
        ]);
        $insert=Slider::insertGetId([
            'title'=>$request->title,
            'image'=>'',
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = 'Slider' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/slider/' . $ImageName);
            Slider::where('id', $insert)->update([
                'image' => $ImageName,
            ]);
        }
        if($insert){
            $notification = array(
                'messege' => 'insert success!',
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
        $alldata=Slider::select(['title','image','id','is_active'])->orderBy('id','DESC')->get();
        return view('backend.slider.index',compact('alldata'));
    }
    // active
    public function active($id){
        $active=Slider::where('id',$id)->update([
            'is_active'=>1,
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
        $Deactive=Slider::where('id',$id)->update([
            'is_active'=>0,
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
        $edit=Slider::where('id',$id)->select(['id','title','image'])->first();
        return view('backend.slider.update',compact('edit'));
    }
    // delete
    public function delete($id){
        $delete=Slider::where('id',$id)->delete();
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
            'title' => 'required',
        ]);
        $update=Slider::where('id',$request->id)->update([
            'title'=>$request->title,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = 'Slider' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/slider/' . $ImageName);
            Slider::where('id',$request->id)->update([
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
