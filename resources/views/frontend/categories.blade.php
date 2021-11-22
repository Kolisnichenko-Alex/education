@include ('frontend.header')
<div>
    <div class="container" style="padding: 10px">
        <div class="card" style="margin: 30px">
            <div class="card-header">
                <h4> Choose a category of articles</h4>
            </div>
            <div class="card-body" style="font-size: larger; font-style: italic">
                @foreach($categories as $key => $item)
                    <a href="{{route('home.category', $item->id)}}" class="card-title">{{$item->title}}
                        : {{$item->publishedArticles->count()}} articles</a></br>
                    @foreach($subcategories as $key => $ite)
                        @if($ite->parent_category_id == $item->id)
                            <a href="{{route('home.category', $ite->id)}}" class="card-title"> - {{$ite->title}}
                                : {{$ite->publishedArticles->count()}} articles</a></br>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
