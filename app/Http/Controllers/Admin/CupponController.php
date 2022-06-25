<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuppon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CupponController extends Controller
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
        $alldata = Cuppon::where('is_deleted', 0)->get();
        return view('backend.cuppon.index', compact('alldata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.cuppon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCupponRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cuppon_code' => 'required',
            'date'        => 'required',
            'amount'      => 'required',
            'amount_type' => 'required',
        ]);

        if ($validated) {
            $insert = Cuppon::insertGetId([
                'cuppon_code' => $request->cuppon_code,
                'date'        => Carbon::parse($request->date),
                'amount'      => $request->amount,
                'amount_type' => $request->amount_type,
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuppon  $cuppon
     * @return \Illuminate\Http\Response
     */
    public function show(Cuppon $cuppon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuppon  $cuppon
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuppon $cuppon)
    {
        return view('backend.cuppon.update', compact('cuppon'));
    }
    // active
    public function active($id)
    {
        $active = Cuppon::where('id', $id)->update([
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
        $Deactive = Cuppon::where('id', $id)->update([
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCupponRequest  $request
     * @param  \App\Models\Cuppon  $cuppon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request->all();
        $validated = $request->validate([
            'cuppon_code' => 'required',
            'date'        => 'required',
            'amount'      => 'required',
            'amount_type' => 'required',
        ]);

        if ($validated) {
            $insert = Cuppon::where('id', $request->id)->update([
                'cuppon_code' => $request->cuppon_code,
                'date'        => Carbon::parse($request->date),
                'amount'      => $request->amount,
                'amount_type' => $request->amount_type,
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuppon  $cuppon
     * @return \Illuminate\Http\Response
     */
    // delete
    public function delete($id)
    {
        $delete = Cuppon::where('id', $id)->update([
            'is_deleted' => 1,
            // 'updated_by' => Auth::user()->id,
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

    public function cupponAdd(Request $request, Cuppon $cuppon)
    {
        if ($request->cuppon == $cuppon->cuppon) {
            return $request->all();
        }

    }
}