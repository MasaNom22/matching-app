<div class="row">
                <div class="col-md mb-4">
                    <div class="card article-card">
                        <div class="card-body d-flex flex-row row">
                            <div class="col-2"><i class="fas fa-user-circle fa-3x mr-1"></i></div>
                            <div style="" class="col-8">
                                
                                <a class="text-dark" href="{{ route('articles.show', ['id' => $article->id]) }}"><h4>コメント: {{ $article->body }}</h4></a>
                    	        <h6>投稿日時: {{ $article->created_at->format('Y/m/d H:i') }}</h6>
                    	        <h5>名前: {{ $article->user->name }}</h5>
                    	        @include('likes.likes_button')
                    	  　</div>
                	  　<!-- dropdown -->
                	  　@if ($article->user_id == Auth::id())
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
                              {!! Form::model($article, ['route' => ['articles.destroy', $article->id], 'method' => 'delete']) !!}
                              {!! Form::submit('投稿を削除する', ['class' => 'dropdown-item text-danger ']) !!}
                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                        <!-- dropdown -->
                      @endif
                	  </div>　
            	    </div>
                </div>
            </div>