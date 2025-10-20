<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('web.home');
    }

    public function about()
    {
        return view('web.about');
    }

    public function services()
    {
        return view('web.services');
    }
    
    public function blog()
    {
        return view('web.blog');
    }

    public function blogDetails()
    {
        return view('web.blog_details');
    }

    public function elements()
    {
        return view('web.elements');
    }

    public function contact()
    {
        return view('web.contact');
    }
}
