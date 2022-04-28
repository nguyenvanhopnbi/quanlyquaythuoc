@props(['type', 'active'])

@if ($active ?? null)
<div x-data x-init="
    () => window.emitEvent('notify', {'type': '{{ $type }}','message': '{{ $slot }}'})
"></div>
@endif
