<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserRegistrationAreaReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function main(Request $request)
    {
        if ($request->from && $request->to && $request->type) {
            $start_date = $request->from . " 00:00:00";
            $end_date   = $request->to . " 23:59:59";
            if ($request->type == 1) {
                $data = User::where('is_vendor', 1)->get();
            } else {
                $data = User::where('is_vendor', 0)->get();
            }
            $from_date = $request->from;
            $to_date   = $request->to;
            return view('backend.report.user-registration-area.datalist', compact('data', 'from_date', 'to_date'));
        } else {
            $data = null;
            return view('backend.report.user-registration-area.index');
        }
    }
}
