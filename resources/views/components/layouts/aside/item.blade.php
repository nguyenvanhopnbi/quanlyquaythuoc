@props(['icon', 'href', 'active' => false])

<li {{ $attributes->merge(['class' => 'kt-menu__item' . ($active ? ' kt-menu__item--active' : '')]) }}
    aria-haspopup="true">
    <a href="{{ $href }}" class="kt-menu__link ">
        {{ $icon }}
        <span class="kt-menu__link-text">{{ $slot }}</span>
    </a>
</li>
