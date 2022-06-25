<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $alldata = Review::with('customer', 'product')->where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        return view('backend.review.index', compact('alldata'));
    }
    // active
    public function status($id)
    {
        $review = Review::find($id);
        if ($review->is_active == 1) {
            $review->is_active = 0;
        } else {
            $review->is_active = 1;

        }
        $review->updated_by = Auth::user()->id;
        $review->updated_at = Carbon::now()->todateTimeString();
        $review->save();

        if ($review) {
            $notification = [
                'messege'    => 'Status Change success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Status Change Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function edit($id)
    {
        $edit = Category::where('id', $id)->select(['id', 'name', 'image'])->first();
        return view('backend.review.update', compact('edit'));
    }
    // delete
    public function delete($id)
    {
        $delete = Category::where('id', $id)->update([
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
            'name' => 'required',
        ]);
        $proname = $request->name;
        $slug    = preg_replace('/[^A-Za-z0-9-]+/', '-', $proname);
        $update  = Category::where('id', $request->id)->update([
            'name'       => $request->name,
            'slug'       => $slug,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $ImageName = 'Cate' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/category/' . $ImageName);
            Category::where('id', $request->id)->update([
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
