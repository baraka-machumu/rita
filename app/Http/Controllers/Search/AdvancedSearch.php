<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvancedSearch extends Controller
{
    //


    public  function  advancedSearch(){

        return  view('search.advanced_search');
    }

}
