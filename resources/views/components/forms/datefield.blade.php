<div class="form-group">
    @if($label ?? null)
        <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }}" for="{{ $id ?? $name }}">
            {{ $label }}
            @if($help ?? null)
                <a tabindex="0" data-toggle="popover" data-trigger="focus" title="Information" data-content="{{ $help }}"><i class="fas fa-info-circle"></i></a>
            @endif
        </label>
    @endif
    <div class="input-group">
        <input
            autocomplete="off"
            type="{{ $type ?? 'date' }}"
            name="{{ $name }}"
            id="{{ $id ?? $name }}"
            class="input form-control"
            placeholder="{{ $placeholder ?? '' }}"
            value="{{ old($name, $value ?? '') }}"
            {{ ($required ?? false) ? 'required' : '' }}
            {{ Arr::except($attributes, ['required', 'placeholder', 'label', 'class', 'name', 'id', 'value']) }} />
        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></div>
    </div>
    @error($name)
    <p class="form-error text-danger" role="alert">{{ $message }}</p>
    @enderror
</div>
