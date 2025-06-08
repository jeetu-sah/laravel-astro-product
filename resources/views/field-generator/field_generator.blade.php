<div class="col-sm-4 mb-4">
    <label for="attribute_{{ $attribute->id }}" class="small">{{ $attribute->name }}</label>

    @if($attribute->type === 'text')
    <input
        type="{{ $attribute->type ?? 'text' }}"
        class="form-control form-control-sm"
        id="attribute_{{ $attribute->id }}"
        name="attributes[{{ $attribute->id }}]"
        placeholder="{{ $attribute->name }}"
        value="{{ old('attributes.' . $attribute->id) }}" />

    @elseif($attribute->type === 'select')

    <select
        class="form-control form-control-sm select2"
        id="attribute_{{ $attribute->id }}"
        name="attributes[{{ $attribute->id }}]">
        <option value="">-- Select {{ $attribute->name }} --</option>
        @foreach($attribute->values as $option)
        <option value="{{ $option->id }}"
            {{ old('attributes.' . $attribute->id) == $option ? 'selected' : '' }}>
            {{ ucfirst($option->name) }}
        </option>
        @endforeach
    </select>

    @elseif($attribute->type === 'image')
    <input
        type="file"
        class="form-control form-control-sm"
        id="attribute_{{ $attribute->id }}"
        name="attributes[{{ $attribute->id }}]"
        accept="image/*" />
    @endif

</div>