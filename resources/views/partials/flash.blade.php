@if( Session::has("success-ajax") )
<div class="alert alert-success alert-block" role="alert">
    {{ Session::get("success-ajax") }}
</div>
@endif

@if( Session::has("error") )
<div class="alert alert-danger alert-block" role="alert">
    {{ Session::get("error") }}
</div>
@endif