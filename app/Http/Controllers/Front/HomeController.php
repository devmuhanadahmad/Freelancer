<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $projects=Project::FilterActive()->with('category')->take(8)->get();
        return \view('front.index',compact('projects'));
    }
}
