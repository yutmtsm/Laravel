<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Changelog;
use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        $form = $request->all();
        //dd($profile);
        //テーブルに無い値があるので削除
        unset($form['_token']);
        
        $profile->fill($form);
        //dd($profile);
        $profile->save();
        //dd($profile);
        //新規追加後一覧に移動
        return redirect('admin/profile');
    }

    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if(empty($profile)){
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    
     public function index(Request $request){
        $cond_title = $request->cond_title;
        //dd($cond_title);
        if($cond_title != ''){
            // 検索されたら検索結果を取得する
            $posts = Profile::where('name', $cond_title)->get();
        } else {
            $posts = Profile::all();
        }
        
        return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = Profile::find($request->id);
        //dd($profile);
        $profile_form = $request->all();
        unset($profile_form['_token']);
        
        $profile->fill($profile_form);
        //dd($profile);
        $profile->save();
        
        $changelog = new Changelog;
        $changelog->profile_id = $profile->id;
        $changelog->edited_at = Carbon::now('Asia/Tokyo');
        $changelog->save();
        
        return redirect('admin/profile');
    }
    
    public function delete(Request $request){
        $profile = Profile::find($request->id);
        
        $profile->delete();
        
        return redirect('admin/profile/'); 
    }
}
