@php
    switch ($slot) {
        case 'success':
            $bgColor= 'success';
            break;
        
        case 'pending':
            $bgColor= 'warning';
            break;
        
        case 'error':
            $bgColor= 'danger';
            break;
        
        default:
            $bgColor= 'primary';
            break;
    }
@endphp

<span class="kt-badge kt-badge--{{ $bgColor }} kt-badge--inline kt-badge--pill">{{ Str::ucfirst($slot) }}</span>