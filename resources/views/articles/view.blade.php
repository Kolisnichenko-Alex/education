@extends('adminlte::page')

@section('content')
    <div class="box-body">

        <div class="form-group row">
            <label for="title" class="col-sm-1 col-form-label text-md-center">{{ __('Title :') }}</label>
            <div class="col-md-10">
                <h3>{{ $article->title }}</h3>
            </div>
        </div>
        <div class="form-group row">
            <label for="author" class="col-sm-1 col-form-label text-md-center">{{ __('Author :') }}</label>
            <div class="col-md-10">
                <h3>{{ $article->user->name }}</h3>
            </div>
        </div>
        <div class="form-group row">
            <label for="text" class="col-sm-1 col-form-label text-md-center">{{ __('Text :') }}</label>
            <div class="col-md-10">
                {!! Form::textarea('text', "{$article->text}", ['class' => 'form-control', 'readonly']) !!}
            </div>
        </div>

        <hr class="my-4">
        <label for="images" class="col-sm-1 col-form-label text-md-center">{{ __('Images : ') }}</label>

        @foreach ($article->images as $image)
            <div class="form-group row">
                <label for="image" class="col-sm-1 col-form-label text-md-center">{{ __(' ') }}</label>
                <div class="col-md-10">
                    <img src="{{url($image->url)}}" alt="Image" style="max-height: 500px; max-width: 700px"/>
                </div>
            </div>
        @endforeach

        <hr class="my-4">
        <label for="comment" class="col-sm-1 col-form-label text-md-center">{{ __('Comments : ') }}</label>
        @foreach ($article->comments as $comment)
            <div class="form-group row">
                <label for="comment" class="col-sm-1 col-form-label text-md-center">{{ __(' ') }}</label>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            {{$comment->user->name}}  :
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$comment->created_at}}</h5>
                            <p class="card-text">{{$comment->text}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <hr class="my-4">
        <div class="form-group row">
            <div class="col-sm-11 col-form-label text-md-right">
                <a class="btn btn-primary" href="{{ route('articles.index') }}" role="button">Back</a>
                <a class="btn btn-success" href="{{ route('articles.edit', $article->id) }}" role="button"><i class="fas fa-pen"></i> {{ __('Edit') }}</a>
            </div>
        </div>

    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
