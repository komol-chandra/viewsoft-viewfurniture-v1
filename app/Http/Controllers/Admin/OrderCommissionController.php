<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\orderCommission;

class OrderCommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $alldata = orderCommission::OrderBy('id', 'DESC')->get();

        return view('backend.ordercommission.index', compact('alldata'));
    }
}
