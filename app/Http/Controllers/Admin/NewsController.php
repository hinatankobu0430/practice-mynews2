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
        $this->validate($request, News::$rules);//static $rulesにアクセス(//News.phpファイルの$rulesを指定している。)
        
        $news = new News;//インスタンスの生成。
        $form = $request->all();//$formの中身をすべて取得。
        
        //フォームから画像が送信されてきたら、保存して、$news->image_pathに画像のパスを保存する。
        //条件式と結果：もし$formの'image'にデータ（画像）が入っていれば、storage/app/public/imageフォルダに保存。
        if(isset($form['image'])) {
            $path =$request->file('image')->store('public/image');
            //basename:ファイル名だけ取得するメソッド（ハッシュ化されたファイル名を取得可能）
            $news ->image_path = basename($path);
        }else{//Newsテーブルのimage_pathに何もなかったらnullを代入。
            $news->image_path = null;
        }
        
        //フォーム($form)から送信されてきた_tokenを削除するコード
        unset($form['token']);
        //フォーム($form)から送信されてきたimageを削除するコード
        unset($form['image']);
        
        //データベースに保存する
        $news->fill($form);
        $news->save();
        //create.blade.phpに移動。
        return redirect('admin/news/create');
        
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            //検索されたら検索結果を取得する
            //where：newsテーブルの中のtitleカラムでユーザーが入力した文字（$cond_title）に一致するレコードを取得。
            $posts = News::where('title', $cond_title)->get();
        }else{
            //それ以外はすべてのニュースを取得する。
            //データベースに保存されているnewsテーブルのレコードを全て取得し、変数に代入している。
            $posts = News::all();
        }
        //ユーザーが入力した文字列($cond_title)を渡し、ページを開く。
        return view('admin.news.index', ['posts' => $posts,'cond_title' => $cond_title]);
    }
}
