@extends('layouts.app')

@section('title', 'トップページ')

@section('content')

<div class="container mt-4">
  <div class="row d-flex justify-content-center">
    <div class="row col-md-12">
      <aside class="col-3 d-none d-md-block position-fixed">
      </aside>
      <main class="col-md-7 offset-md-5">
<div class="row">
    <div class="col-md mb-4">
        <div class="card article-card">
            @foreach($articles as $article)
            <div style="" class="col-md-6 mt-4 mb-4">
                <h4>コメント: {{ $article->body }}</h4>
    	        <h5>id: {{ $article->user_id }}</h5>
    	        <h5>名前: {{ $article->user->name }}</h5>
    	  　</div>
    	  　@endforeach
    	  　
	    </div>
    </div>
</div>

</main>

    </div>
  </div>
</div>	                    

@endsection