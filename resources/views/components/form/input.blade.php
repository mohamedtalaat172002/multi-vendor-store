<input
{{--  type="{{ $type }}" --}}   
    name="{{ $name }}"
    id="{{ $name }}"
    placeholder="{{ $placeholder }}"
    class="form-control @error($name) is-invalid @enderror"
   {{-- value="{{ old($name, $value) }}"--}}
    {{ $attributes->except(['type', 'name', 'placeholder', 'value']) }}
/>
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
