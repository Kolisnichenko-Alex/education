<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">


<nav class="navbar navbar-expand-md navbar-light bg-light">
    <h3 class="my-auto"><a class="navbar-brand" href="{{'/'}}">Laravel Educational Blog</a></h3>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse w-100 flex-md-column" id="navbarCollapse">
        <ul class="navbar-nav ml-auto mb-2 mb-md-0">
            <li class="nav-item active border-right">
                <a class="nav-link py-1" href="{{'/home/categories'}}">Categories</a>
            </li>

            @if(\Request::is('/'))
                @foreach($menu as $key => $item)
                    <li class="nav-item active border-right">
                        <a class="nav-link py-1" href="{{$item->url}}">{{$item->title}}</a>
                    </li>
                @endforeach
            @endif
            @if(Auth::check() ==  false)
                <li class="nav-item border-right">
                    <a class="nav-link py-1" style="font-weight: bold" href="{{'/register'}}">
                        Register</a>
                </li>
                <li class="nav-item border-right">
                    <a class="nav-link py-1" style="font-weight: bold" href="{{'/login'}}">
                        Log in</a>
                </li>
            @else
                <li class="nav-item border-right">
                    <a class="nav-link py-1" style="font-weight: bold" href="{{'/logout'}}">
                        Log out</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
<hr class="my-sm-1">
@include('shared.flash')
@include('shared.alerts')
@include('shared.messages')
