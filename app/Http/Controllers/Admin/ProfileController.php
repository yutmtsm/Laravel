<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

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
        dd($profile);
        //新規追加後一覧に移動
        return redirect('admin/news');
    }

    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if(empty($profile)){
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }

    public function update()
    {
        return redirect('admin/profile/edit');
    }
}
