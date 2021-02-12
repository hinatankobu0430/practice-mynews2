<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
//自分が実装したい機能をここに入れていく。
{
    public function add()//create.blade.phpに返すアクション
    {
        return view('admin.news.create');
    }
}
