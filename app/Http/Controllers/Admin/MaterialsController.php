<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MaterialsController extends Controller
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
        $colors = Materials::all();
        return view('backend.material.index', \compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.material.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'color_name' => 'required',
            'color_code' => 'required',
        ]);

        if ($validated) {
            $insert = Materials::insertGetId([
                'name'       => $request->color_name,
                'code'       => $request->color_code,
                'created_at' => Carbon::now()->toDateTimeString(),
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $data = Materials::find($id);
        if ($data->is_active == 1) {
            $data->is_active = 0;
        } else {
            $data->is_active = 1;
        }
        $insert = $data->save();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
