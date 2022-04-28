@props(['value' => 0])

<div x-data="{
    amount: {{ intval($value) }},
    get unformat() {
        return this.amount.toString().replace(/\./g, '');
    }
}" x-init="() => {
    $($refs.formatted).simpleMoneyFormat()
}">
    <input type="text" x-ref="formatted" x-model="amount" {{ $attributes->except('name', 'value') }}>
    <input type="hidden" x-model="unformat" {{ $attributes->only('name') }}>
</div>
