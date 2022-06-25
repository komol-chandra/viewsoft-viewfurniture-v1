<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubcriptionController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'email' => 'required|unique:subscriptions|max:25',
        ]);
        $insert = Subscription::insert([
            'email'      => $request->email,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        if ($insert) {
            Alert::toast('Subscription success!', 'success');
            return redirect()->back();
        } else {
            Alert::toast('Subscription Faild!', 'error');
            return redirect()->back();
        }
    }
}
