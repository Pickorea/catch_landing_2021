<div class="form-group">
    @if($label ?? null)
        <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }}" for="{{  $id ?? $name }}">
            {{ $label }}
            @if($help ?? null)
                <a tabindex="0" data-toggle="popover" data-trigger="focus" title="Information" data-content="{{ $help }}"><i class="fas fa-info-circle"></i></a>
            @endif
        </label>
    @endif
    <select name="{{ $name }}" id="{{ $id ?? $name }}" class="input form-control" {{ ($required ?? false) ? 'required' : '' }}>
        @if (!($required ?? false))
            <option value="">{{ $placeholder ?? 'Please select' }}</option>
        @endif
        @foreach($options as $option)
            <option @if($option == old($name, $value ?? ''))selected="true"@endif> {{ $option }}</option>
        @endforeach
    </select>
    @error($name)
    <p class="form-error" role="alert">{{ $message }}</p>
    @enderror
</div>
