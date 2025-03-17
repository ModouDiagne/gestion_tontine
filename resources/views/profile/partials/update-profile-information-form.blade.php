<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    {{-- Boutons de navigation --}}
    <div class="row mt-4 mb-4 g-3">
        <div class="col">
            <button type="button"
                    class="btn btn-outline-info w-100"
                    data-bs-toggle="collapse"
                    data-bs-target="#profileInfo">
                {{ __('Information Profil') }}
            </button>
        </div>
        <div class="col">
            <x-primary-button class="w-100">
                {{ __('Modifier Profil') }}
            </x-primary-button>
        </div>
        <div class="col">
            <a href="{{ route('profile.edit') }}#delete"
               class="btn btn-outline-danger w-100">
                {{ __('Supprimer Profil') }}
            </a>
        </div>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Section des champs du formulaire --}}
        <div id="profileInfo" class="collapse show">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4">
                        <p class="text-sm text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Nouveaux champs --}}
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Téléphone')" />
                <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <div class="mt-4">
                <x-input-label for="address" :value="__('Adresse')" />
                <x-textarea id="address" name="address" class="mt-1 block w-full">{{ old('address', $user->address) }}</x-textarea>
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            <div class="mt-4">
                <x-input-label for="avatar" :value="__('Photo de profil')" />
                <input id="avatar" name="avatar" type="file" class="mt-1 block w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @if($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="mt-2 h-20 w-20 rounded-full object-cover border-2 border-gray-200">
                @endif
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>

        {{-- Section de suppression conditionnelle --}}
        @if(Str::contains(url()->current(), '#delete'))
            <div id="delete-profile" class="mt-8">
                @include('profile.partials.delete-user-form')
            </div>
        @endif
    </form>
</section>
