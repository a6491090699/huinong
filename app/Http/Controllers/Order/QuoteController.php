<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Quote;

class QuoteController extends Controller
{
    //

    public function addQuote($id)
    {
    

        return view('home.quote.add',['wid'=> $id]);


    }


}
