@if(Session::has('message'))
    <div class="alert alert-{{(Session::get('type') === 'error') ? 'danger' : 'success'}}" role="alert">
        {{Session::get('message')}}
    </div>
@endif
