<button {{ $attributes->merge(['type' => 'submit','style'=>'width:100%;','class'=>'btn btn-success']) }}>
    {{ $slot }}
</button>
