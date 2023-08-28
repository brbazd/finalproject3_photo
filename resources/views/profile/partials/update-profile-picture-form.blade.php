<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's avatar which will be visible across the whole website.") }}
        </p>
    </header>

    <div class="flex justify-start">

    </div>

    <form method="post" action="{{ route('profile.picture.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="image" :value="__('Image file')" />
            <input class="block w-full mt-1 p-1 text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400" id="image" name="image" type="file">
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-picture-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif

            @if (auth()->user()->picture_url !== null)
                <x-danger-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-avatar-deletion')"
                >{{ __('Delete Avatar') }}</x-danger-button>

                @if (session('status') === 'profile-picture-deleted')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Avatar deleted.') }}</p>
                @endif

            @endif

        </div>
    </form>



    <x-modal name="confirm-avatar-deletion" focusable>

        <form action="{{route('profile.picture.destroy')}}" method="post" class="p-6">

            @csrf
            @method('delete')

            <h2 class="text-xl text-center font-medium text-gray-900 dark:text-gray-100 pb-3">
                {{ __('Are you sure you want to delete this avatar?') }}
            </h2>
            <div class="mt-6 flex justify-center">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Avatar') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
