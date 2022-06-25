<?php

namespace App\Http\Controllers\Admin;

use Image;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // create
    public function create()
    {
        $allCategory = Category::where('is_active', 1)->where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        return view('backend.subCategory.create', compact('allCategory'));
    }
    // store
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|unique:sub_categories',
            'category' => 'required',
        ]);
        $proname = $request->name;
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $proname);
        $insert = SubCategory::insertGetId([
            'name' => $request->name,
            'category' => $request->category,
            'slug' => $slug,
            'image' => '',
            'updated_by' => Auth::user()->id,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = 'Slider' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/subcategory/' . $ImageName);
            SubCategory::where('id', $insert)->update([
                'image' => $ImageName,
            ]);
        }
        if ($insert) {
            $notification = array(
                'messege' => 'Insert success!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'messege' => 'insert Faild!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    // all slider
    public function index()
    {
        $alldata = SubCategory::where('is_deleted', 0)->select(['category', 'name', 'image', 'id', 'is_active'])->orderBy('id', 'DESC')->get();
        return view('backend.subCategory.index', compact('alldata'));
    }
    // active
    public function active($id)
    {
        $active = SubCategory::where('id', $id)->update([
            'is_active' => 1,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->todateTimeString(),
        ]);
        if ($active) {
            $notification = array(
                'messege' => 'Active success!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'messege' => 'Active Faild!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    // Deactive
    public function deactive($id)
    {
        $Deactive = SubCategory::where('id', $id)->update([
            'is_active' => 0,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->todateTimeString(),
        ]);
        if ($Deactive) {
            $notification = array(
                'messege' => 'Deactive success!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'messege' => 'Deactive Faild!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    // edit
    public function edit($id)
    {
        $allCategory = Category::where('is_active', 1)->where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        $edit = SubCategory::where('id', $id)->select(['id', 'name', 'image'])->first();
        return view('backend.subCategory.update', compact('edit', 'allCategory'));
    }
    // delete
    public function delete($id)
    {
        $delete = SubCategory::where('id', $id)->update([
            'is_deleted' => 1,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        if ($delete) {
            $notification = array(
                'messege' => 'Delete success!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'messege' => 'Delete Faild!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    // update
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);
        $proname = $request->name;
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $proname);
        $update = SubCategory::where('id', $request->id)->update([
            'name' => $request->name,
            'category' => $request->category,
            'slug' => $slug,
            'image' => '',
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = 'Cate' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/subcategory/' . $ImageName);
            SubCategory::where('id', $request->id)->update([
                'image' => $ImageName,
            ]);
        }
        if ($update) {
            $notification = array(
                'messege' => 'Update success!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'messege' => 'Update Faild!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
