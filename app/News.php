<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    
    protected $guarded = array('id');
    
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
        );
        
        //News Modelに関連付け（リレーション）を行う。
        //News Model➡$news->histories()で簡単にアクセス可能のメソッドを作成。
    public function histories()
    {
        return $this->hasMany('App\History');
    }
}
