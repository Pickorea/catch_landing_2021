    <select name="{{ $name }}" id="{{ $id ?? $name }}" class="input form-control" {{ ($required ?? false) ? 'required' : '' }}>
        @if (!($required ?? false))
            <option value="">{{ $placeholder ?? 'Please select' }}</option>
        @endif
        @foreach($options as $option)
            <option @if($option == old($name, $value ?? ''))selected="true"@endif> {{ $option }}</option>
        @endforeach
    </select>
