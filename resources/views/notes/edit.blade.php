<x-app-layout :title=$title>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 p-4">
        <div class="flex justify-between items-center">
            <div class="float-left">
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-gray-100">
                    {{ __('Edit Note') }}
                </h2>
            </div>
            <div class="float-right">

                <x-amber-btn-link :href="route('notes.index')"> <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                    </svg>
                    Back
                </x-amber-btn-link>

            </div>
        </div>

        <form method="post" action="{{ route('notes.update', $note) }}"
            class="mt-6 space-y-6 border border-cyan-500 dark:border-gray-800 p-6 dark:bg-slate-800">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $note->title)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
            <div>
                <x-input-label for="body" :value="__('Body')" />
                <x-textarea-input name="body"
                    class="mt-1 block w-full">{{ old('body', $note->body) }}</x-textarea-input>
                <x-input-error class="mt-2" :messages="$errors->get('body')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Update') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
