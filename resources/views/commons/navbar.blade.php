<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark aqua-gradient">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/"><i class=""></i>マッチングアプリ</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item">
                        <span class="nav-link">ようこそ、 {{ Auth::user()->name }}さん</span>
                    </li>
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item"></li>
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item"></li>
                    
                    {{-- ログアウトへのリンク --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout.get') }}">ログアウト</a>
                    </li>
                    
                @else
                    
                    <li class="nav-item">{!! link_to_route('signup.get', '新規登録', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
    </nav>
</header>
