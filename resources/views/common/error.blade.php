@if(Session::has('error'))
    <div class="alert alert-error">
        <button class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> {{ Session::get('error') }}
    </div>
@endif