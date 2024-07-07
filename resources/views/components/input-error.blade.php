@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['style' => 'color:red; list-style:none;']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
