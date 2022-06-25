<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // about us
    public function update()
    {
        $data = AboutUs::select(['details', 'id'])->where('keyword', 'about_us')->first();
        return view('backend.about-us.update', compact('data'));
    }
    // contact us
    public function contactUsPage()
    {
        $data = AboutUs::select(['details', 'id'])->where('keyword', 'contact_us')->first();
        return view('backend.about-us.update', compact('data'));
    }
    // update Store
    public function updateSubmit(Request $request)
    {
        $this->validate($request, [
            'details' => 'required',
        ]);
        $update = AboutUs::where('id', $request->id)->update([
            'details'    => $request->details,
            'updated_at' => Carbon::now()->toDateTimeString(),
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

    public function privacyPolicy()
    {
        $data = AboutUs::select(['details', 'id'])->where('keyword', 'privacy_policy')->first();
        return view('backend.about-us.privacy_policy', compact('data'));
    }

    public function productUploadPolicy()
    {
        $data = AboutUs::select(['details', 'id'])->where('keyword', 'product_upload_policy')->first();
        return view('backend.about-us.product_upload_policy', compact('data'));
    }

    public function termsCondition()
    {
        $data = AboutUs::select(['details', 'id'])->where('keyword', 'terms_condition')->first();
        return view('backend.about-us.terms_conditions', compact('data'));
    }

}
