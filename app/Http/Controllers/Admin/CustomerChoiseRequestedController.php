<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomChoiseRequested;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerChoiseRequestedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
        $alldata = CustomChoiseRequested::where('is_deleted', 0)->with('Product', 'Customer', 'Color', 'Material', 'FinishedColor');

        if ($request->from && $request->to) {

            $start_date = $request->from . " 00:00:00";
            $end_date   = $request->to . " 23:59:59";

            $alldata   = $alldata->whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'DESC')->get();
            $from_date = $request->from;
            $to_date   = $request->to;

            return view('backend.report.customer-custom-choose.search', compact('alldata', 'from_date', 'to_date'));
        } else {
            $alldata = $alldata->orderBy('id', 'DESC')->get();

            // dd($alldata);
            return view('backend.report.customer-custom-choose.index', compact('alldata'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = CustomChoiseRequested::where('is_deleted', 0)->with('Product', 'Customer', 'Color', 'Material', 'Vendor', 'FinishedColor')->where('id', $id)->first();
        return view('backend.report.customer-custom-choose.view', \compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $data = CustomChoiseRequested::find($id);
        if ($data->is_approve == '1') {
            $data->is_approve = 0;
            $data->updated_by = Auth::user()->id;
            $data->updated_at = now();
            $insert           = $data->save();
        } else {
            $data->is_approve = 1;
            $data->updated_by = Auth::user()->id;
            $data->updated_at = now();
            $insert           = $data->save();
        }

        if ($insert) {
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

    public function customOrderCreate($id)
    {
        $data = CustomChoiseRequested::where('is_deleted', 0)->with('Product', 'Customer', 'Color', 'Material', 'Vendor', 'FinishedColor')->where('id', $id)->first();
        return view('backend.report.customer-custom-choose.create-order', \compact('data'));

    }

    public function customOrderStore(Request $request)
    {
        $validated = $request->validate([
            'custom_product_price' => 'required',
            'product_id'           => 'required',
            'user_id'              => 'required',
            'vendor_id'            => 'required',
            'color_id'             => 'required',
            'material_id'          => 'required',
            'finished_color_id'    => 'required',
            'hight'                => 'required',
            'weight'               => 'required',
            'length'               => 'required',
        ]);

        $insert = CustomChoiseRequested::where('id', $request->id)->update([
            'product_id'           => $request->product_id,
            'user_id'              => $request->user_id,
            'vendor_id'            => $request->vendor_id,
            'color_id'             => $request->color_id,
            'material_id'          => $request->material_id,
            'finished_color_id'    => $request->finished_color_id,
            'hight'                => $request->hight,
            'weight'               => $request->weight,
            'length'               => $request->length,
            'is_approve'           => 1,
            'custom_product_price' => $request->custom_product_price,
            'created_at'           => now(),
            'updated_at'           => now(),

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

}
