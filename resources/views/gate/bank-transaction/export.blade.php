<table class="table mb-0 w-100" id="table-log-transaction">
    <thead class="bg-light ">
    <tr>
        @foreach ($columns as $column)
            <th scope="col" class="border-0">{{ Str::of($column)->replace('_', ' ')->title() }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            @foreach ($columns as $column)
                <td>{{ $item[$column] }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>

