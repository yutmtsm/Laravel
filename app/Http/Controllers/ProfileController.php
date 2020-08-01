<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{
    //
    public function index(Request $request){
        $posts = Profile::all()->sortByDesc('updated_at');
        if(count($posts) > 0){
            $headline = $posts->shift();
        }
        
        return view('profile.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
