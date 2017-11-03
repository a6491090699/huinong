<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplyController extends Controller
{
    //
    public function index()
    {
        return view('home.supply.index');
    }

    public function addSupply()
    {
        return view('home.supply.add');
    }

    public function editSupply()
    {
        return view('home.supply.edit');
    }

    public function viewSupply()
    {
        return view('home.supply.view');
    }
}
