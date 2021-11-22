@extends('adminlte::page')

@section('content')
    <div class="box-body">
        @include('shared.flash')
        @include('shared.alerts')
        {!! Form::open([
        'method' => 'POST',
        'route' => 'categories.store',
        'files' => false
        ]) !!}

        <div class="form-group row">
            <label for="title" class="col-sm-1 col-form-label text-md-center">{{ __('Title') }}</label>
            <div class="col-md-10">
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-1 col-form-label text-md-center">
                {!! Form::label('Parent category')!!}
            </div>
            <div class="col-md-10">

                <select id="parent_category_id" name="parent_category_id" class="form-control select-tag">
                    <option value="{{null}}"> None</option>
                        @foreach($categories as $category)
                            <option
                                value="{{$category->id}}" {{in_array($category->id, old("parent_category_id") ?: []) ? "selected": ""}}>{{$category->title}}</option>
                        @endforeach
                </select>

            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-11 col-form-label text-md-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}" role="button">Back</a>
                {!! Form::submit('Save', ['class' => 'btn btn-info', 'title' => 'Save']) !!}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
