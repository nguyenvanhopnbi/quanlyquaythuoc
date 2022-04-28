@if(Session::has('message'))
    <div class="alert alert-solid-{{ Session::get('alert-class', 'success') }} alert-bold" role="alert">
        <div class="alert-text">{{ Session::get('message') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif