<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Models\Admin;
use App\Models\Option;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shopSections = Option::where('key', 'shop_page_section')->where('is_deleted', 0)->get();
        return \view('backend.shop-section-info.index', \compact('shopSections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return \view('backend.shop-section-info.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOptionRequest $request)
    {
        if ($request->hasFile('cover')) {
            $image     = $request->file('cover');
            $ImageName = 'shop_section' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/shop-section/' . $ImageName);
        } else {
            $ImageName = null;
        }

        $insert = Option::insert([
            'title'       => $request->title,
            'key'         => 'shop_page_section',
            'title_key'   => '11_offer',
            'description' => $request->description,
            'cover'       => $ImageName,
            'created_by'  => Auth::user()->id,
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $option = Option::find($id);
        if ($option->is_active == 1) {
            $option->is_active = 0;
        } else {
            $option->is_active = 1;
        }
        $insert = $option->save();
        if ($insert) {
            $notification = [
                'messege'    => 'Status success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Status Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $option = Option::find($id);
        return view('backend.shop-section-info.update', \compact('option'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOptionRequest  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOptionRequest $request, $id)
    {
        $option = Option::find($id);
        if ($request->hasFile('cover')) {
            $image     = $request->file('cover');
            $ImageName = 'shop_section' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/shop-section/' . $ImageName);
        } else {
            $ImageName = $option->cover;
        }

        $insert = Option::where('id', $option->id)->update([
            'title'       => $request->title,
            'key'         => 'shop_page_section',
            'description' => $request->description,
            'cover'       => $ImageName,
            'updated_by'  => Auth::user()->id,
            'updated_at'  => Carbon::now()->toDateTimeString(),
        ]);

        if ($insert) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $option            = Option::find($id);
        $option->is_active = 1;
        $insert            = $option->save();
        if ($insert) {
            $notification = [
                'messege'    => 'Deleted success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'Deleted Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

}
