@include ('frontend.header')
<div>
    <div class="container" style="padding: 10px">
        <div class="card" style="margin: 30px">
            <div class="card-header" style="background-color: #7abaff; font-size: larger; font-style: italic; font-weight: bolder">
                {{$article->title}}
                <div class="float-right">
                    @if(Auth::check())
                        @if($favorites == 0)
                            <div class="form-group row">
                                <div class="col-sm-11 col-form-label text-md-right">
                                    <a class="btn btn-success" href="{{ route('article.like', $article->id)}}"
                                       role="button">
                                        Add to Favorites
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <div class="col-sm-11 col-form-label text-md-right">
                                    <a class="btn btn-danger" href="{{ route('article.dislike', $article->id) }}"
                                       role="button">
                                        Remove from Favorites
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <div class="card-body">
                <blockquote class="blockquote">
                    <p class="card-text mb-0">{!! nl2br(e($article->text)) !!}</p>
                </blockquote>
                @foreach ($article->images as $image)
                    <div class="form-group row">
                        <label for="image" class="col-sm-1 col-form-label text-md-center">{{ __(' ') }}</label>
                        <div class="col-md-10">
                            <img src="{{url($image->url)}}" alt="Image" style="max-height: 500px; max-width: 700px"/>
                        </div>
                    </div>
                @endforeach
                <hr class="my-4">
                <h5 class="card-title">Author : {{$article->user->name}}</h5>
            </div>
        </div>

        @foreach($article->comments as $comment)
            <div class="card" style="margin: 30px">
                <div class="card-header" style="background-color: #7abaff">
                    {{$comment->user->name}} said :
                </div>
                <div class="card-body">
                    <blockquote class="blockquote">
                        <p class="card-text mb-0">{!! nl2br(e($comment->text)) !!}</p>
                    </blockquote>
                </div>
            </div>
        @endforeach

        @if(Auth::check())
            <div class="card" style="margin: 30px">
                <div class="card-header" style="background-color: #7abaff">
                    Add new Comment :
                </div>
                <div class="card-body">
                    {!! Form::open(['method' => 'POST','route' => ['comment.post', $article->id],'files' => false]) !!}
                    <blockquote class="blockquote">
                        {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
                    </blockquote>
                    <button type="submit" class="btn btn-success">
                        Post Comment
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
