<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;

class NewsController extends Controller
//自分が実装したい機能をここに入れていく。
{
    public function add()//create.blade.phpに返すアクション
    {
        return view('admin.news.create');
    }
    
    public function create(Request $request)
    {
        //Validationを行う。
        $this->validate($request, News::$rules);//News Modelの$rulesメソッドにアクセス
        
        $news = new News;
        $form = $request->all();
        
        //フォームから画像が送信されてきたら、保存して、$news->image_pathに画像のパスを保存する。
        if(isset($form['image'])) {
            $path =$request->file('image')->store('public/image');
            $news ->image_path = basename($path);
        }else{
            $news->image_path = null;
        }
        
        //フォームから送信されてきた_tokenを削除するコード
        unset($form['token']);
        //フォームから送信されてきたimageを削除するコード
        unset($form['image']);
        
        //データベースに保存する
        $news->fill($form);
        $news->save();
        
        return redirect('admin/news/create');
        
    }
}
