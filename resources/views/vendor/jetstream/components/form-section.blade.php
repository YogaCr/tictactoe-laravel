@props(['submit'])

<div {{ $attributes->merge(['class' => '']) }}>
    {{-- <x-jet-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title> --}}

    <div class="md:mt-0 md:col-span-2">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="overflow-hidden sm:rounded-md">
                <div class="px-4 sm:p-6">
                        {{ $form }}
                </div>

                @if (isset($actions))
                    <div class="flex items-center justify-center px-4 pb-4 text-right sm:px-6">
                        {{ $actions }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
