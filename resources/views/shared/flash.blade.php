@if(request()->session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ request()->session()->get('success') }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fa fa-times"></i>
        </button>
    </div>
@endif
@if(request()->session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ request()->session()->get('error') }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fa fa-times"></i>
        </button>
    </div>
@endif
