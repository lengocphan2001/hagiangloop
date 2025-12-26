<textarea 
    name="{{ $name }}" 
    id="{{ $id }}" 
    class="form-control @error($name) is-invalid @enderror" 
    rows="10"
    {{ $attributes }}
>{{ $value ?? old($name) }}</textarea>
@error($name)
    <span class="invalid-feedback">{{ $message }}</span>
@enderror
