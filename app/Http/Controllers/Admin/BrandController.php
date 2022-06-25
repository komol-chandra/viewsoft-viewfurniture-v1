<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // create
    public function create()
    {
        return view('backend.brand.create');
    }
    // store
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'        => 'required|unique:brands',
            'image'       => 'required',
            'description' => 'required',
            'url'         => 'required',
        ]);
        $proname = $request->name;
        $slug    = preg_replace('/[^A-Za-z0-9-]+/', '-', $proname);
        $insert  = Brand::insertGetId([
            'name'        => $request->name,
            'slug'        => $slug,
            'description' => $request->description,
            'url'         => $request->url,
            'image'       => '',
            'updated_by'  => Auth::user()->id,
            'created_at'  => Carbon::now()->toDateTimeString(),
        ]);
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $ImageName = 'Slider' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(170, 82)->save('uploads/brand/' . $ImageName);
            Brand::where('id', $insert)->update([
                'image' => $ImageName,
            ]);
        }
        if ($insert) {
            $notification = [
                'messege'    => 'Insert success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'insert Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    // all slider
    public function index()
    {
        $alldata = Brand::where('is_deleted', 0)->select(['name', 'image', 'id', 'is_active'])->orderBy('id', 'DESC')->get();
        return view('backend.brand.index', compact('alldata'));
    }
    // active
    public function active($id)
    {
        $active = Brand::where('id', $id)->update([
            'is_active'  => 1,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->todateTimeString(),
        ]);
        if ($active) {
            $notification = [
                'messege'    => 'Active success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Active Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    // Deactive
    public function deactive($id)
    {
        $Deactive = Brand::where('id', $id)->update([
            'is_active'  => 0,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->todateTimeString(),
        ]);
        if ($Deactive) {
            $notification = [
                'messege'    => 'Deactive success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Deactive Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    // edit
    public function edit($id)
    {
        $edit = Brand::where('id', $id)->first();
        return view('backend.brand.update', compact('edit'));
    }
    // delete
    public function delete($id)
    {
        $delete = Brand::where('id', $id)->update([
            'is_deleted' => 1,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        if ($delete) {
            $notification = [
                'messege'    => 'Delete success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Delete Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    // update
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'url'         => 'required',
        ]);
        $proname = $request->name;
        $slug    = preg_replace('/[^A-Za-z0-9-]+/', '-', $proname);
        $update  = Brand::where('id', $request->id)->update([
            'name'        => $request->name,
            'slug'        => $slug,
            'description' => $request->description,
            'url'         => $request->url,
            'updated_by'  => Auth::user()->id,
            'updated_at'  => Carbon::now()->toDateTimeString(),
        ]);
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $ImageName = 'Cate' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(170, 82)->save('uploads/brand/' . $ImageName);
            Brand::where('id', $request->id)->update([
                'image' => $ImageName,
            ]);
        }
        if ($update) {
            $notification = [
                'messege'    => 'Update success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Update Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
}
