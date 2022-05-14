<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function getData()
    {
        return DataTables::of(renderDataRS())->make(true);
    }
}
