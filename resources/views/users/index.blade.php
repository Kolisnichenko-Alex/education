@extends('adminlte::page')

@section('content')
    <div class="box-body">
        @include('shared.flash')
        @include('shared.alerts')
        <table class="table table-striped table-hover" id="siswa-table">
            <thead>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Account Type</th>
            <th>
                <div class="text-right">
                    <a class="btn btn-info" href="{{ route('users.create') }}" role="button">
                        <i class="fas fa-plus"></i> {{ __('Create new User') }}
                    </a>
                </div>
            </th>
            </thead>
            <tbody>
            <?php $no =1;?>
            @foreach ($users as $key => $value)
                <tr @if($value->baned_at === null) class="alert-default-success" @else class="alert-default-danger" @endif>
                    <th>{{ $no++ }}</th>
                    <th>{{ $value->name }}</th>
                    <th>{{ $value->email }}</th>
                    <th>{{ $value->account_type }}</th>
                    <th class="text-right">
                        <div class="text-right" style="display:inline-block">
                            <a href="{{route('users.show', $value->id)}}" title="View" class="btn btn-outline-primary">
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{route('users.edit', $value->id)}}" title="Edit" class="btn btn-outline-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{route('users.ban', $value->id)}}" title="{{$value->baned_at ? 'Unban' : 'Ban'}}"
                               class="btn btn-outline-info">
                                <i class="fas {{ $value->baned_at ? 'fa-user-check' : 'fa-user-slash'}}"></i>
                            </a>
                            <form action="{{route('users.destroy', $value->id)}}" method="post"
                                  style="display:inline-block"
                                  onsubmit="return confirm('Are you sure, you want to delete {{$value->name}} ?')">
                                {!! csrf_field() !!}
                                {!! method_field('delete') !!}
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-user-minus"></i>
                                </button>
                            </form>
                        </div>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection
