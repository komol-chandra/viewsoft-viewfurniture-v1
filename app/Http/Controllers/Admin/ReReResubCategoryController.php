<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ReReReSubCategory;
use App\Models\ReReSubCategory;
use App\Models\ResubCategory;
use App\Models\SubCategory;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReReResubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // create
    public function create()
    {
        $allCategory = Category::where('is_active', 1)->where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        return view('backend.reReResubCategory.create', compact('allCategory'));
    }
    // store
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'            => 'required|unique:re_re_re_sub_categories',
            'category'        => 'required',
            'subcategory'     => 'required',
            'resubcategory'   => 'required',
            'reresubcategory' => 'required',
        ]);
        $proname = $request->name;
        $slug    = preg_replace('/[^A-Za-z0-9-]+/', '-', $proname);
        $insert  = ReReReSubCategory::insertGetId([
            'name'               => $request->name,
            'category'           => $request->category,
            'sub_category'       => $request->subcategory,
            're_sub_category'    => $request->resubcategory,
            're_re_sub_category' => $request->reresubcategory,
            'slug'               => $slug,
            'updated_by'         => Auth::user()->id,
            'created_at'         => Carbon::now()->toDateTimeString(),
        ]);
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
        $alldata = ReReReSubCategory::where('is_deleted', 0)->with(['Category_id', 'SubCategory_id', 'ReSubCategory_id', 'ReReSubCategory_id'])->select(['category', 'sub_category', 're_sub_category', 're_re_sub_category', 'name', 'id', 'is_active'])->orderBy('id', 'DESC')->get();
        return view('backend.reReResubCategory.index', compact('alldata'));
    }
    // active
    public function active($id)
    {
        $active = ReReReSubCategory::where('id', $id)->update([
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
        $Deactive = ReReReSubCategory::where('id', $id)->update([
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
        $allCategory      = Category::where('is_active', 1)->select(['name', 'id'])->where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        $allSubCategory   = SubCategory::select(['name', 'id', 'category'])->where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        $allReSubCategory = ReSubCategory::select(['name', 'id', 'category', 'sub_category'])->where('is_deleted', 0)->orderBy('id', 'DESC')->get();

        $allReReSubCategory = ReReSubCategory::select(['name', 'id', 'category', 'sub_category', 're_sub_category'])->where('is_deleted', 0)->orderBy('id', 'DESC')->get();

        $edit = ReReReSubCategory::where('id', $id)->first();
        return view('backend.reReResubCategory.update', compact('allReReSubCategory', 'edit', 'allCategory', 'allSubCategory', 'allReSubCategory'));
    }
    // delete
    public function delete($id)
    {
        $delete = ReReReSubCategory::where('id', $id)->update([
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
            'name'            => 'required',
            'category'        => 'required',
            'subcategory'     => 'required',
            'resubcategory'   => 'required',
            'reresubcategory' => 'required',
        ]);
        $proname = $request->name;
        $slug    = preg_replace('/[^A-Za-z0-9-]+/', '-', $proname);
        $update  = ReReReSubCategory::where('id', $request->id)->update([
            'name'               => $request->name,
            'category'           => $request->category,
            'sub_category'       => $request->subcategory,
            're_sub_category'    => $request->resubcategory,
            're_re_sub_category' => $request->reresubcategory,
            'slug'               => $slug,
            'updated_by'         => Auth::user()->id,
            'updated_at'         => Carbon::now()->toDateTimeString(),
        ]);
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
