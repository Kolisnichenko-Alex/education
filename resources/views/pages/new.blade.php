@extends('adminlte::page')

@section('content')
    <div class="box-body">
        {!! Form::open([
        'method' => 'POST',
        'route' => 'pages.store',
        'files' => false
        ]) !!}
        @include('shared.flash')
        @include('shared.alerts')
        <div class="form-group row">
            <label for="title" class="col-sm-4 col-form-label text-md-center">{{ __('Title') }}</label>
            <div class="col-md-10">
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label for="html" class="col-sm-4 col-form-label text-md-center">{{ __('HTML') }}</label>
            <div class="col-md-10">
                {!! Form::textarea('html', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="box-footer">
            <div class="text-right">
                <a class="btn btn-info" href="{{ route('pages.index') }}" role="button">Back</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'title' => 'Save']) !!}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
