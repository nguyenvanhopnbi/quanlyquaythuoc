@props(['type', 'icon', 'active'])

@if ($active ?? null)
<div class="alert alert-solid-{{ $type ?? 'primary' }} alert-bold fade show kt-margin-b-20" role="alert">
    <div class="alert-icon">
        {!! $icon ?? '<i class="fa fa-exclamation-triangle"></i>' !!}
    </div>
    <div class="alert-text">{{ $slot }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
    </div>
</div>
@endif
