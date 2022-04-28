<select {{ $attributes }} wire:ignore x-data="{ selects: @entangle($attributes->wire('model')) }" x-init="
    $($el).selectpicker()
    $($el).on('changed.bs.select', function () {
        selects = $(this).val()
    })

">
    {{ $slot }}
</select>