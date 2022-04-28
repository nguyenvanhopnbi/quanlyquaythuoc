@props(['timestamp', 'format' => 'd-m-Y H:i:s'])

<span>{{ Carbon\Carbon::createFromTimestamp($timestamp)->format($format) }}</span>