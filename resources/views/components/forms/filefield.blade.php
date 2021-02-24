<div class="form-group">
    @if($label ?? null)
        <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }}" for="{{ $id ?? $name }}">
            {{ $label }}
            @if($help ?? null)
                <a tabindex="0" data-toggle="popover" data-trigger="click" title="Information" data-content="{{ $help }}"><i class="fas fa-info-circle"></i></a>
            @endif
        </label>
    @endif

    <div class="custom-file">
        <input
            type="file"
            name="{{ $name }}"
            class="custom-file-input"
            id="{{ $id ?? $name }}"
            placeholder="{{ $placeholder ?? '' }}"
            value="{{ old($name, $value ?? '') }}"
            {{ ($required ?? false) ? 'required' : '' }}
            {{ Arr::except($attributes, ['required', 'placeholder', 'label', 'class', 'name', 'id', 'value']) }}
        />
        <label class="custom-file-label" for="{{ $id ?? $name }}">Choose file</label>
    </div>
    @error($name)
    <p class="form-error" role="alert">{{ $message }}</p>
    @enderror
</div>

@once
    @push('after-scripts')
        <script src="{{ route('frontend.index') }}/js/bs-custom-file-input.min.js"></script>
        <script>
            $(document).ready(function () {
                bsCustomFileInput.init()
            });
        </script>
    @endpush
@endonce
