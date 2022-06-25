<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShoppingChargeRequest;
use App\Http\Requests\UpdateShoppingChargeRequest;
use App\Models\ShoppingCharge;
use Illuminate\Http\Request;

class ShoppingChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $data = ShoppingCharge::all();
        return view('backend.shoppingCharge.index', \compact('data'));
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
     * @param  \App\Http\Requests\StoreShoppingChargeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShoppingChargeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingCharge  $shoppingCharge
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCharge $shoppingCharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingCharge  $shoppingCharge
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shoppingCharge = ShoppingCharge::find($id);
        // dd($shoppingCharge);
        return view('backend.shoppingCharge.edit', compact('shoppingCharge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShoppingChargeRequest  $request
     * @param  \App\Models\ShoppingCharge  $shoppingCharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'charge' => 'required',
        ]);
        $update = ShoppingCharge::where('id', $id)->update([
            'charge' => $request->charge,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingCharge  $shoppingCharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingCharge $shoppingCharge)
    {
        //
    }
}
