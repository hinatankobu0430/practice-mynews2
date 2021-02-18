<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        //$postsにはNewsクラスのデータをすべて取得し、降順にソートされた値が代入されている。
        $posts = News::all()->sortByDesc('updated_at');//$postは最新の記事以外の記事が格納されている。
        if(count($posts)>0){//変数$postsのすべての要素の数が、0より多かった場合。
            $headline = $posts->shift();//最新の記事を$headlineに代入
        }else{//$postsのすべての要素の数が、0以下の場合。nullを返す。
            $headline = null;
        }
    
    //news/index.blade.phpファイルを渡している。
    //viewテンプレートにheadline、posts、という変数を渡している。
    return view('news.index',['headline' => $headline, 'posts' => $posts]);
    }
}
