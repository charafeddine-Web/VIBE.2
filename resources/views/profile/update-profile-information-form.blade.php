<div>


<x-form-section submit="updateProfileInformation" class="bg-gray-900 rounded-lg shadow-xl p-6 border border-indigo-500/20">
<x-slot name="title">
        <h2 class="text-2xl font-bold text-white">{{ __('Profile Information') }}</h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-400">{{ __('Update your account\'s profile information and email address.') }}</p>
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                       wire:model.live="photo"
                       x-ref="photo"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" class="text-indigo-300 font-medium" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{$this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-24 w-24 object-cover ring-2 ring-indigo-500 shadow-lg">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-24 h-24 bg-cover bg-no-repeat bg-center ring-2 ring-indigo-500 shadow-lg"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <div class="mt-4 flex space-x-2">
                    <x-secondary-button class="bg-indigo-600 hover:bg-indigo-700 text-white border-0 shadow-md" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-secondary-button>

                    @if ($this->user->profile_photo_path)
                        <x-secondary-button type="button" class="bg-gray-800 hover:bg-gray-700 text-white border-0 shadow-md" wire:click="deleteProfilePhoto">
                            {{ __('Remove Photo') }}
                        </x-secondary-button>
                    @endif
                </div>

                <x-input-error for="photo" class="mt-2 text-red-400" />
            </div>
        @endif

        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="bio" value="{{ __('Bio') }}" class="text-indigo-300 font-medium" />
            <x-textarea id="bio" class="mt-1 block w-full bg-gray-800 border-gray-700 focus:border-indigo-500 text-white rounded-md shadow-sm" wire:model="state.bio" required autocomplete="bio" />
        </div>

        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="pseudo" value="{{ __('Pseudo Name') }}" class="text-indigo-300 font-medium" />
            <x-input id="pseudo" type="text" class="mt-1 block w-full bg-gray-800 border-gray-700 focus:border-indigo-500 text-white rounded-md shadow-sm" wire:model="state.pseudo" required autocomplete="pseudo" />
            <x-input-error for="pseudo" class="mt-2 text-red-400" />
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="name" value="{{ __('Name') }}" class="text-indigo-300 font-medium" />
            <x-input id="name" type="text" class="mt-1 block w-full bg-gray-800 border-gray-700 focus:border-indigo-500 text-white rounded-md shadow-sm" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2 text-red-400" />
        </div>

        <!-- Prenom -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="prenom" value="{{ __('Prenom') }}" class="text-indigo-300 font-medium" />
            <x-input id="prenom" type="text" class="mt-1 block w-full bg-gray-800 border-gray-700 focus:border-indigo-500 text-white rounded-md shadow-sm" wire:model="state.prenom" required autocomplete="prenom" />
            <x-input-error for="prenom" class="mt-2 text-red-400" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4 mt-4">
            <x-label for="email" value="{{ __('Email') }}" class="text-indigo-300 font-medium" />
            <x-input id="email" type="email" class="mt-1 block w-full bg-gray-800 border-gray-700 focus:border-indigo-500 text-white rounded-md shadow-sm" wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2 text-red-400" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-gray-400">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-indigo-400 hover:text-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-500">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3 text-indigo-400" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white border-0 shadow-md" wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>

<!-- Posts Section -->
<div class="mt-8 bg-gray-900 rounded-lg shadow-xl p-6 border border-indigo-500/20">
    <h2 class="text-2xl font-bold text-white mb-6">{{ __('Your Posts') }}</h2>

    <div class="space-y-6">
        @foreach($posts ?? [] as $post)
            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700 hover:border-indigo-500 transition">
                <h3 class="text-xl font-semibold text-white mb-2">{{ $post->title }}</h3>
                <p class="text-gray-400 mb-4">{{ $post->excerpt }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-indigo-400 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    <div class="flex space-x-2">
                        <a href="{{ route('posts.edit', $post) }}" class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-sm rounded-md shadow transition">Edit</a>
                        <button wire:click="deletePost({{ $post->id }})" class="px-3 py-1 bg-gray-700 hover:bg-red-700 text-white text-sm rounded-md shadow transition">Delete</button>
                    </div>
                </div>
            </div>
        @endforeach

        @if(empty($posts ?? []))
            <div class="text-center py-8">
                <p class="text-gray-400">{{ __('No posts yet.') }}</p>
                <a href="{{ route('posts.store') }}" class="mt-4 inline-block px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-md transition">
                    {{ __('Create Your First Post') }}
                </a>
            </div>
        @endif
    </div>

    @if(!empty($posts ?? []))
        <div class="mt-6 text-center">
            <a href="{{ route('posts.store') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-md transition">
                {{ __('Create New Post') }}
            </a>
        </div>
    @endif
</div>
</div>
