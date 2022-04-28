<input type="text" {{ $attributes }} x-data="{amount: @entangle($attributes->wire('model'))}"
    x-init="$($el).simpleMoneyFormat()">