@extends('adminlte::page')

@section('content')
    <div class="box-body">
        @include('shared.flash')
        @include('shared.alerts')
        <table class="table table-striped table-hover" id="siswa-table">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Articles written</th>
            <th>Account Type</th>
            <th>Ban date</th>
            </thead>
            <tbody>
                <tr>
                    <th>{{ $user->id }}</th>
                    <th>{{ $user->name }}</th>
                    <th>{{ $user->email }}</th>
                    <th>{{ $articles }}</th>
                    <th>{{ $user->account_type }}</th>
                    <th>{{ $user->baned_at }}</th>
                </tr>
            </tbody>
        </table>
        <div class="box-footer">
            <div class="text-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}" role="button">Back</a>
                <a class="btn btn-success" href="{{ route('users.edit', $user->id) }}" role="button">
                    <i class="fas fa-pen"></i> {{ __('Edit') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
