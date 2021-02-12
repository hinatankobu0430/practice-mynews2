<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <!--囲まれたコードはphpで書かれた内容を表示する。の中身を文字列に置換し、HTMLの中に記載する。-->
    <head>
        <meta charset="utf-8">
        
        <!--windowsの基本ブラウザである、edgeに対応するという記載。-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <!--画面幅を小さくしたとき、例えばスマホで見た時に文字や画像の大きさを調整する。-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <!--クロス・サイト・リクエスト・フォージュリ（CSRF)とは悪意のあるエクスプロイトの１種-->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <!-- @ yieldは指定したセッションの内容を表示する。-->
        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
         <!--secure_assetはpublicディレクトリのパスを返す関数。-->
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            {{-- 画面上部に表示するナビゲーションバーです。 --}}
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="container">
                    
                    {{--{ url('/') }}はurl("パス")はそのままurlを返すメソッド。--}}
                    <a class="navbar-brand" href="{{ url('/') }}">
                        
                        {{--secure_assetと似たような関数で、configフォルダのapp.phpの中にあるnameにアクセス--}}
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                        </ul>
                    </div>
                </div>
            </nav>
            {{-- ここまでナビゲーションバー --}}

            <main class="py-4">
                {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                @yield('content')
            </main>
        </div>
    </body>
</html>