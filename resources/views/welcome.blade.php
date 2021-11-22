@extends('adminlte::page')
@section('title', 'Dashboard | Lara Admin')
@section('content_header')
    <h1>Welcome, {{ Auth::user()->name }}</h1>
@stop
@section('content')
        <div class="row">
            @if( Auth::user()->account_type == 'admin' )
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $users }}</h3>
                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="users" style="background-color: #3d9970" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $categories }}</h3>
                            <p>Categories</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="categories" style="background-color: #004a99" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $pages }}</h3>
                            <p>Saved Pages</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="pages" style="background-color: #3ab0c3" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $menu }}</h3>
                            <p>Menu Items</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="menu" style="background-color: #7abaff" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endif
            @if(Auth::user()->account_type == 'admin'|| Auth::user()->account_type == 'publisher')
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $articles }}</h3>
                        <p>Articles</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="articles" style="background-color: #855eca" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
                @endif
        </div>
@stop
