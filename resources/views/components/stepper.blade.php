@props(['active' => []])

@php
    $items = ['Registrasi', 'Ujian', 'Hasil Ujian', 'Pengumuman'];
@endphp

<div class="flex gap-3 justify-center w-full my-4">
    @foreach ($items as $item)
        <div class="flex gap-2 items-center">
            <div
                class="text-md rounded-full {{ in_array($item, $active) ? 'bg-primary-app text-white' : 'bg-transparent border text-gray-500' }} w-8 h-8 p-1">
                <div class="text-center">
                    {{ $loop->iteration }}
                </div>
            </div>

            <div class="text-lg font-bold {{ in_array($item, $active) ? 'text-black' : 'text-gray-500' }}">
                {{ $item }}
            </div>

            @if (!$loop->last)
                <div class="bg-primary-app h-1 w-20 ml-2"></div>
            @endif
        </div>
    @endforeach
</div>
