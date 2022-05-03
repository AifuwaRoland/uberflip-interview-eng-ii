<?php

namespace App\Http\Controllers;
use App\Models\University;
use App\Models\Domain;
use App\Models\WebPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function getList()
    {
        //call University controller 
        return view('welcome')->with('universities',University::paginate(10));
    }
}
