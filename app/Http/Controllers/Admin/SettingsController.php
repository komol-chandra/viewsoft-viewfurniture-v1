<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;
use App\Models\Seo;
use App\Models\Social;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // company Information
    public function companyInformation()
    {
        $edit = CompanyInformation::first();
        return view('backend.settings.companyInformation', compact('edit'));
    }
    // company Information Update
    public function companyInformationSubmit(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'email'        => 'required',
            'mobile'       => 'required',
            'bkash_number' => 'required',
        ]);
        $update = CompanyInformation::where('id', $request->id)->update([
            'company_name'    => $request->company_name,
            'email'           => $request->email,
            'mobile'          => $request->mobile,
            'bkash_number'    => $request->bkash_number,
            'company_motto'   => $request->company_motto,
            'company_address' => $request->company_address,
            'telephone'       => $request->telephone,
            'updated_at'      => Carbon::now()->toDateTimeString(),
        ]);
        if ($request->hasFile('logo')) {
            $image     = $request->file('logo');
            $ImageName = 'logo' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/logo/' . $ImageName);
            CompanyInformation::where('id', $request->id)->update([
                'logo' => $ImageName,
            ]);
        }
        if ($request->hasFile('favicon')) {
            $image     = $request->file('favicon');
            $ImageName = 'favicon' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('uploads/logo/' . $ImageName);
            CompanyInformation::where('id', $request->id)->update([
                'favicon' => $ImageName,
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
    // seo index
    public function seoInformation()
    {
        $edit = Seo::first();
        return view('backend.settings.seo', compact('edit'));
    }
    //
    public function seoInformationSubmit(Request $request)
    {

        $this->validate($request, [
            'meta_title'       => 'required',
            'meta_author'      => 'required',
            'meta_keyword'     => 'required',
            'meta_description' => 'required',
        ]);
        $update = Seo::where('id', $request->id)->update([
            'meta_title'          => $request->meta_title,
            'meta_author'         => $request->meta_author,
            'meta_keyword'        => $request->meta_keyword,
            'meta_description'    => $request->meta_description,

            'google_verification' => $request->google_verification,
            'bing_verification'   => $request->bing_verification,
            'google_analytics'    => $request->google_analytics,
            'alexa_analytics'     => $request->alexa_analytics,
            'updated_at'          => Carbon::now()->toDateTimeString(),
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
    // social Information
    public function socialInformation()
    {
        $edit = Social::select(['instagram', 'id', 'facebook', 'twitter', 'linkend', 'youtube', 'skype', 'google_plus', 'feed'])->first();
        return view('backend.settings.social', compact('edit'));
    }
    //
    public function socialInformationSubmit(Request $request)
    {

        $this->validate($request, [
            'facebook' => 'required',
        ]);
        $update = Social::where('id', $request->id)->update([
            'facebook'    => $request->facebook,
            'twitter'     => $request->twitter,
            'youtube'     => $request->youtube,
            'linkend'     => $request->linkend,
            'google_plus' => $request->google_plus,
            'skype'       => $request->skype,
            'feed'        => $request->feed,
            'instagram'   => $request->instagram,
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
