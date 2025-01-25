<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('chirps.update', $chirp) }}">
            @csrf
            @method('patch')
            <x-trix-input
                id="content"
                name="content"
                class="block w-full bg-white dark:bg-gray-900 border-gray-300 dark:border-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                :value="old('content', $chirp->content?->toTrixHtml())"
                :accept-mentions="true"
                :accept-files="true"
            />
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a class="dark:text-gray-400" href="{{ route('chirps.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
