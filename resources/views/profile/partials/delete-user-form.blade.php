{{-- resources/views/profile/partials/delete-user-form.blade.php --}}
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
        </p>
    </header>

    {{-- Bouton de déclenchement de la modale --}}
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="w-full sm:w-auto"
    >
        {{ __('Delete Account') }}
    </x-danger-button>

    {{-- Modale de confirmation --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Confirm Account Deletion') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('This action cannot be undone. All data will be permanently erased.') }}
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
                @csrf
                @method('delete')

                {{-- Champ mot de passe --}}
                <div>
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full"
                        placeholder="{{ __('Enter your password') }}"
                        required
                    />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                {{-- Boutons d'action --}}
                <div class="mt-6 flex justify-between">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button type="submit" class="ml-3">
                        {{ __('Delete Account Permanently') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </x-modal>
</section>
