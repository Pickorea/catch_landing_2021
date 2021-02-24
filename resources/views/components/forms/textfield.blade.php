<div class="form-group">
    @if($label ?? null)
        <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }}" for="{{ $id ?? $name }}">
            {{ $label }}
            @if($help ?? null)
                <a tabindex="0" data-toggle="popover" data-trigger="focus" title="Information" data-content="{{ $help }}"><i class="fas fa-info-circle"></i></a>
            @endif
        </label>
    @endif
    <input
        autocomplete="off"
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        class="input form-control"
        placeholder="{{ $placeholder ?? '' }}"
        value="{{ old($name, $value ?? '') }}"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ Arr::except($attributes, ['required', 'placeholder', 'label', 'class', 'name', 'id', 'value', 'help']) }}
    />
    @error($name)
    <p class="form-error" role="alert">{{ $message }}</p>
    @enderror
</div>
