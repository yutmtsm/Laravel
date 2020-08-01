<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
    //
    public function add(){
        return view('admin.news.create');
    }
    
    public function create(Request $request){
        
        $this->validate($request, News::$rules);
        // $this->validate($request, [
        //     'title' => 'required',
        //     'body' => 'required',
        // ]);
        
        dd($request);
        $news = new News;
        //配列で全て格納　dd($form);で確認
        $form = $request->all();
        if(isset($form['image'])){
            //画像をStrange内に格納し、パスを代入
            $path = $request->file('image')->store('public/image');
            //画像のパス先を格納
            $news->image_path = basename($path);
        } else {
            $news->image_path = null;
        }
        //dd($form);
        //不要な物があれば以下で削除
        unset($form['_token']);
        unset($form['image']);
        //dd($news);
        //"image_path" => null飲み格納されてる
        $news->fill($form);
        //dd($news);
        //全部格納されてることを確認
        $news->save();
        
        return redirect('admin/news/create');
    }
}
