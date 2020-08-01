<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\History;
use Carbon\Carbon;

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
        
        //dd($request);
        $news = new News;
        //配列で全て格納　dd($form);で確認
        $form = $request->all();
        //dd($form);
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
    
    public function index(Request $request){
        $cond_title = $request->cond_title;
        //dd($cond_title);
        if($cond_title != ''){
            // 検索されたら検索結果を取得する
            $posts = News::where('title', $cond_title)->get();
        } else {
            $posts = News::all();
        }
        
        return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request){
        $news = News::find($request->id);
        if(empty($news)){
            abort(404);
        }
        
        return view('admin.news.edit', ['news_form' => $news]);
    }
    
    
    public function update(Request $request){
        
        $this->validate($request, News::$rules);
        // News Modelからデータを取得する
        $news = News::find($request->id);
        // 送信されてきたフォームデータを格納する
        $news_form = $request->all();
        
        //画像が再設定されていた時の処理
        // if(isset($news_form['image'])){
        //     $path = $request->file('image')->store('public/image');
        //     $news->image_path = basename($path);
        //     //name='remove'を受け取っている。つまり、削除ボタンが押されたこと場合の処理
        // } elseif(isset($request->remove)) {
        //     $news->image_path = null;
        // }
        // unset($news_form['_token']);
        // unset($news_form['remove']);
        // unset($news_form['image']);
        if ($request->remove == 'true') {
            $news_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $news_form['image_path'] = basename($path);
        } else {
            $news_form['image_path'] = $news->image_path;
        }

        unset($news_form['_token']);
        unset($news_form['image']);
        unset($news_form['remove']);
        
        $news->fill($news_form)->save();
        
        $history = new History;
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now('Asia/Tokyo');
        $history->save();
        
        return redirect('admin/news');
    }
    
    public function delete(Request $request){
        $news = News::find($request->id);
        
        $news->delete();
        
        return redirect('admin/news/'); 
    }
}
