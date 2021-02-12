{{-- layouts/admin.blade.phpを読み込む --}}
{{--Viewファイルの継承--}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'ニュースの新規作成')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>ニュース新規作成</h2>
                {{--Rooting->Controller->Viewへアクションを返す。--}}
                <form action="{{ action('Admin\NewsController@create') }}" method="post" enctype="multipart/form-data">
                   {{--count($errors)：$errorsはvalidateで弾かれた内容を記憶する配列
                   countメソッドは配列の個数を返すメソッド
                   エラーがなければ、$errorsはnullを返すのでcount($errors)は0を返す。--}}
                    @if(count($errors)>0)
                    <ul>
                        {{--foreachは配列の数だけループする構文
                        つまり$errorsの中身の数だけループをしてその中身を$eに代入している。--}}
                        @foreach($errors->all() as $e)
                        {{--$eに代入された中身を下記の文で表示している。
                        Modelの設定が完了したらエラーメッセージがでるようになる--}}
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-10">
                            {{--old('変数名')...入力フォームから送信など次画面に進んだ際、
                            エラーがあって、最初の入力フォームに戻されたときに入力された内容を
                            「自動で入れなおしてあげる」便利な機能--}}
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2">画像</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control-file" name="image">
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection