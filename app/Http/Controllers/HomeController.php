<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Property;
use App\Weather;

class HomeController extends Controller
{
    public function __construct(private Weather $weather)
    {
        
    }
    
    public function index(){
        $properties = Property::orderBy('created_at' ,'desc')->available()->recent()->limit(4)->get();
        return view('home', ['properties'=>$properties]);
    }
}
