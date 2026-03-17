@props(['label', 'name', 'type' => 'text', 'value' => '', 'placeholder' => ''])

<div class="mb-5">
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        class="w-full border rounded-lg px-4 py-2.5 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition
               {{ $errors->has($name) ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
    >
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>