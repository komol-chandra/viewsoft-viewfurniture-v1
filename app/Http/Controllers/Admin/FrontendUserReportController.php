<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class FrontendUserReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function user()
    {
        $data = User::where('is_vendor', 0)->get();
        return view('backend.report.user.index', compact('data'));

    }
    public function vendor()
    {
        $data = User::where('is_vendor', 1)->get();
        return view('backend.report.vendor.index', compact('data'));
    }
}
