<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AdsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // all slider
    public function index()
    {
        $alldata = Ads::isDeleted()->select(['image', 'ads_section', 'add_limit', 'view_count', 'click_count', 'id', 'is_active'])->orderBy('id', 'DESC')->get();
        return view('backend.ads.index', compact('alldata'));
    }
    // create
    public function create()
    {
        return view('backend.ads.create');
    }
    // store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ads_section' => 'required',
            'url'         => 'required',
            'add_limit'   => 'required',
        ]);
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $ImageName = 'Ads' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/ads/' . $ImageName);
        }
        $insert = Ads::insertGetId([
            'ads_section' => $request->ads_section,
            'url'         => $request->url,
            'image'       => $ImageName,
            'add_limit'   => $request->add_limit,
            'updated_by'  => Auth::user()->id,
            'created_at'  => Carbon::now()->toDateTimeString(),
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

    // active
    public function active($id)
    {
        $active = Ads::where('id', $id)->update([
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
        $Deactive = Ads::where('id', $id)->update([
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
        $edit = Ads::where('id', $id)->first();
        return view('backend.ads.update', compact('edit'));
    }
    // delete
    public function delete($id)
    {
        $delete = Ads::where('id', $id)->update([
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
        $request->validate([
            'ads_section' => 'required',
            'url'         => 'required',
            'add_limit'   => 'required',
        ]);
        if ($request->hasFile('image')) {
            $image     = $request->file('image');
            $ImageName = 'Ads' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/ads/' . $ImageName);

        } else {
            $ImageName = Ads::where('id', $request->id)->first();
            $ImageName = $ImageName->image;

        }
        $update = Ads::where('id', $request->id)->update([
            'ads_section' => $request->ads_section,
            'url'         => $request->url,
            'add_limit'   => $request->add_limit,
            'image'       => $ImageName,
            'updated_by'  => Auth::user()->id,
            'updated_at'  => Carbon::now()->toDateTimeString(),
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
