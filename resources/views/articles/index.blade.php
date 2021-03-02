@extends('layouts.app')

@section('title', 'トップページ')

@section('content')

<div class="container mt-4">
  <div class="row d-flex justify-content-center">
    <div class="row col-md-12">
      <aside class="col-3 d-none d-md-block position-fixed">
      </aside>
      <main class="col-md-7 offset-md-5">
          @foreach($articles as $article)
            <div class="row">
                <div class="col-md mb-4">
                    <div class="card article-card">
                        <div class="card-body d-flex flex-row row">
                            <div class="col-2"></div>
                            <div style="" class="col-8">
                                <h4>コメント: {{ $article->body }}</h4>
                    	        <h5>id: {{ $article->user_id }}</h5>
                    	        <h5>名前: {{ $article->user->name }}</h5>
                    	  　</div>
                	  　<!-- dropdown -->
                      <div class="col-1 card-text">
                        <div class="dropdown text-center">
                          <a class="in-link p-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-lg"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('articles.edit', ['id' => $article->id]) }}">
                              <i class="fas fa-pen mr-1"></i>投稿を編集する
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
                              <i class="fas fa-trash-alt mr-1"></i>投稿を削除する
                            </a>
                          </div>
                        </div>
                      </div>
                      <!-- dropdown -->
                	  </div>　
            	    </div>
                </div>
            </div>
            @endforeach
        </main>
    </div>
  </div>
</div>	                    

@endsection