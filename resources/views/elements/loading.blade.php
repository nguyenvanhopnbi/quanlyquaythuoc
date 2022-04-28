<link rel="stylesheet" href="{{asset('/assets/css/loading/loading.css')}}?v=1">

<div wire:ignore id="loading-x" class="hidden main-wrap {{isset($loading_position) && $loading_position === 'absolute' ? 'loading-absolute' : ''}}">
    <div class="bg">
        @switch($loadingType ?? 2)
            @case(2)
            <div class="loader" id="loader-2">
                <span></span>
                <span></span>
                <span></span>
            </div>
            @break
            @case(4)
            <div class="loader" id="loader-4">
                <span></span>
                <span></span>
                <span></span>
            </div>
            @break
            @case(1)
            <div class="loader" id="loader-1"></div>
            @break
            @case(6)
            <div class="loader" id="loader-6">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            @break
            @case(3)
            <div class="loader" id="loader-3"></div>
            @break
            @case(5)
            <div class="loader" id="loader-5">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            @break
            @case(7)
            <div class="loader" id="loader-7"></div>
            @break
            @case(8)
            <div class="loader" id="loader-8"></div>
            @break

            @default

        @endswitch
    </div>
</div>

