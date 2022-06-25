<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomChoiseRequestedRequest;
use App\Http\Requests\UpdateCustomChoiseRequestedRequest;
use App\Models\CustomChoiseRequested;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class CustomChoiseRequestedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomChoiseRequestedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id'  => 'required',
            'user_id'     => 'required',
            'vendor_id'   => 'required',
            'color_id'    => 'required',
            'material_id' => 'required',
            'hight'       => 'required',
            'weight'      => 'required',
            'length'      => 'required',
            'address'     => 'required',
        ]);

        if ($request->hasFile('product_img')) {
            $image     = $request->file('product_img');
            $ImageName = 'th' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(590, 668)->save('uploads/custom_choose/' . $ImageName);
        } else {
            $ImageName = null;
        }
        $insert = CustomChoiseRequested::insert([
            'image'             => $ImageName,
            'product_id'        => $request->product_id,
            'user_id'           => $request->user_id,
            'vendor_id'         => $request->vendor_id,
            'color_id'          => $request->color_id,
            'material_id'       => $request->material_id,
            'finished_color_id' => $request->finished_color_id,
            'hight'             => $request->hight,
            'weight'            => $request->weight,
            'length'            => $request->length,
            'description'       => $request->description,
            'address'           => $request->address,
            'created_at'        => now(),
            'updated_at'        => now(),

        ]);

        if ($insert) {
            Alert::toast('Insert success!', 'success');
            return redirect()->back();

        } else {
            Alert::toast('Insert Faild!', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomChoiseRequested  $customChoiseRequested
     * @return \Illuminate\Http\Response
     */
    public function show(CustomChoiseRequested $customChoiseRequested)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomChoiseRequested  $customChoiseRequested
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomChoiseRequested $customChoiseRequested)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomChoiseRequestedRequest  $request
     * @param  \App\Models\CustomChoiseRequested  $customChoiseRequested
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomChoiseRequestedRequest $request, CustomChoiseRequested $customChoiseRequested)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomChoiseRequested  $customChoiseRequested
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomChoiseRequested $customChoiseRequested)
    {
        //
    }
}
