<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        
        <title>
            @yield('title')
            </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
        <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
        <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>

    </head>

    <body>
        <div id="app"> 
            {{-- ナビゲーションバー --}}
            @include('commons.navbar')
 


            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        </div>
        
        <script>
var infScroll = new InfiniteScroll( '.scroll_area', {
  path : ".pagination a[rel=next]",
  append : ".next_posts_link a"
  hideNav: '.next_posts_link', // 指定要素を非表示にする（ここは無くてもOK）
    button: '.view-more-button', // 記事を読み込むトリガーとなる要素を指定
    scrollThreshold: false,      // スクロールで読み込む：falseで機能停止（デフォルトはtrue）
    status: '.page-load-status', // ステータス部分の要素を指定
    history: 'false' 
});

</script>
        <script src="{{ mix('js/app.js') }}"></script>
            
            <!-- Bootstrap tooltips -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
            <!-- Bootstrap core JavaScript -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
            <!-- MDB core JavaScript -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
    </body>
</html>
