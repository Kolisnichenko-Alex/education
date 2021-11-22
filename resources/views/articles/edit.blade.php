@extends('adminlte::page')

@section('content')
    <div class="box-body">
        @include('shared.flash')
        @include('shared.alerts')
        {!! Form::model($article, [
       'method' => 'PUT',
       'route' => ['articles.update', $article->id],
       'files' => true
       ])!!}

        <div class="form-group row">
            <label for="title" class="col-sm-1 col-form-label text-md-center">{{ __('Title :') }}</label>
            <div class="col-md-10">
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label for="text" class="col-sm-1 col-form-label text-md-center">{{ __('Text :') }}</label>
            <div class="col-md-10">
                {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-1 col-form-label text-md-center">
                {!! Form::label('Categories :')!!}
            </div>
            <div class="col-md-10">
                <select name="categories[]" class="form-control select-tag" multiple>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                        @foreach ($categories_selected as $selected)
                            {{($category->id == $selected->category_id) ? 'selected' : ''}}
                            @endforeach
                        >{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr class="my-4">

        <div class="col-sm-1 col-form-label text-md-center">
            {!! Form::label('Images :')!!}
        </div>
        @foreach ($images as $key => $image)
            <div class="form-group row">
                <div class="col-md-1 col-form-label text-md-center" style="align-content: center">
                    <a class="btn btn-outline-danger float-right"
                       onclick="return confirm('Are you sure, you want to delete this comment ?')"
                       href="{{ route('images.detach', $image->id) }}" title="Delete">
                        Detach
                    </a>
                </div>
                <div class="col-md-8">
                    <img src="{{($image->image['url'])}}" alt="Image" style="max-height: 500px; max-width: 700px"/>
                </div>
            </div>
        @endforeach

        <hr class="my-4">
        <div class="col-sm-1 col-form-label text-md-center">
            {!! Form::label('Comments :')!!}
        </div>
        @foreach ($comments as $key => $comment)
            <div class="form-group row">
                <label for="comment" class="col-sm-1 col-form-label text-md-center">{{ __(' ') }}</label>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            {{$comment->user->name}} :
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$comment->created_at}}</h5>
                            <p class="card-text">{{$comment->text}}</p>
                            <hr class="my-4">
                            <a class="btn btn-outline-danger float-right"
                               onclick="return confirm('Are you sure, you want to delete this comment ?')"
                               href="{{ route('comments.destroy', $comment->id) }}" title="Delete">
                                Remove comment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <hr class="my-4">
        <div class="form-group row">
            <div class="col-sm-11 col-form-label text-md-right">
                <a class="btn btn-primary" href="{{ route('articles.index') }}" role="button">Back</a>
                {!! Form::submit('Save', ['class' => 'btn btn-info', 'title' => 'Save']) !!}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
