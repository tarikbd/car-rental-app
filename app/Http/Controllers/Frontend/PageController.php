<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
   public function home()
    {
		if (auth()->check() && auth()->user()->isAdmin()) {				
        return view('admin.index');
		}else{
			return view('frontend.home');
		}
	}
    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
