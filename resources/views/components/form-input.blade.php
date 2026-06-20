@props([
    'label',
    'name',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'icon' => null
])

<div class="form-control w-full">
    <label class="label">
        <span class="label-text font-medium text-base-content">
            @if($icon)
                <span class="mr-2">{!! $icon !!}</span>
            @endif
            {{ $label }}
            @if($required)
                <span class="text-error">*</span>
            @endif
        </span>
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        class="input input-bordered w-full focus:input-primary transition-all duration-200 @error($name) input-error @enderror"
    />
    @error($name)
        <label class="label">
            <span class="label-text-alt text-error">{{ $message }}</span>
        </label>
    @enderror
</div>
