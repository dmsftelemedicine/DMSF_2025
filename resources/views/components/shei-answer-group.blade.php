{{-- SHEI Answer Group Component --}}
{{-- Usage: <x-shei-answer-group :answers="$answers" :selected="$selected" /> --}}
@props([
    'answers' => [], 
    'selected' => null,
])
<div class="flex gap-2 flex-wrap">
    @foreach ($answers as $answer)
        <button type="button"
            class="px-3 py-2 rounded-lg bg-gray-100 hover:bg-green-100 {{ $selected === $answer ? 'bg-green-600 text-white font-bold' : '' }}"
            @click="$dispatch('answer-selected', { value: '{{ $answer }}' })"
        >{{ $answer }}</button>
    @endforeach
</div>
