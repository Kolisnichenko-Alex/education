@extends('adminlte::page')

@section('content')
    <div class="box-body">
        @include('shared.flash')
        @include('shared.alerts')
        {!! Form::model($menuItem, [
       'method' => 'PUT',
       'route' => ['menu.update', $menuItem->id],
       'files' => false
       ])!!}

        <div class="form-group row">
            <label for="title" class="col-sm-4 col-form-label text-md-center">{{ __('Title') }}</label>
            <div class="col-md-10">
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label for="url" class="col-sm-4 col-form-label text-md-center">{{ __('Url') }}</label>
            <div class="col-md-10">
                {!! Form::text('url', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="box-footer">
            <div class="text-right">
                <a class="btn btn-primary" href="{{ route('menu.index') }}" role="button">Back</a>
                {!! Form::submit('Save', ['class' => 'btn btn-info', 'title' => 'Save']) !!}
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
