<select {{ $attributes }} x-data="{ selects: @entangle($attributes->wire('model')) }" x-init="
    choices = new Choices($el);
    $($el).on('change', function () {
        selects = $(this).val()
    })
    choices.setChoiceByValue(selects)
">
    {{ $slot }}
</select>