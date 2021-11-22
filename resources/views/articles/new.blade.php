@extends('adminlte::page')

@section('content')
    <div class="box-body">
        @include('shared.flash')
        @include('shared.alerts')
        {!! Form::open([
        'method' => 'POST',
        'route' => 'articles.store',
        'files' => true
        ]) !!}

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
                {!! Form::label('Categories')!!}
            </div>
            <div class="col-md-10">
                <select name="categories[]" class="form-control select-tag" multiple>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{in_array($category->id, old("categories") ?: []) ? "selected": ""}}>{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

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
