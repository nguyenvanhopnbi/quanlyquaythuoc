<div wire:ignore>
    <select {{ $attributes }} x-data="{ selects: @entangle($attributes->wire('model')) }" x-init="
        $($el).select2({ width: '100%' })
        $($el).on('change', function () {
            selects = $(this).val()
        })
    ">
        {{ $slot }}
    </select>
</div>
