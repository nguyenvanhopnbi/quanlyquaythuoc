@props(['icon', 'title', 'active' => false])

<li class="kt-menu__item kt-menu__item--submenu {{ $active ? 'kt-menu__item--active kt-menu__item--open' : '' }}"
    aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
        {{ $icon }}
        <span class="kt-menu__link-text">{{ $title }}</span>
        <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
    <div class="kt-menu__submenu ">
        <span class="kt-menu__arrow"></span>
        <ul class="kt-menu__subnav">
            <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                <span class="kt-menu__link">
                    <span class="kt-menu__link-text">{{ $title }}</span>
                </span>
            </li>
            {{ $slot }}
        </ul>
    </div>
</li>
