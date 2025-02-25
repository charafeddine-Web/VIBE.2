<x-form-section submit="updateProfileInformation">

    <x-slot name="form" class="flex items-center">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-6">
                <!-- Profile Photo Section - Facebook Style -->
                <div class="relative mb-6">
                    <div class="w-full h-48 bg-gray-200 rounded-t-lg overflow-hidden relative">
                        <!-- Current Profile Photo - Larger and Positioned Like Facebook -->
                        <div class="absolute -bottom-0 left-4 z-10" x-show="! photoPreview">
                            <div class="relative group">
                                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                                     class="rounded-full h-32 w-32 object-cover border-4 border-white shadow-md">

                                <!-- Overlay for Edit Icon -->
                                <div class="absolute inset-0 rounded-full bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition cursor-pointer"
                                     x-on:click.prevent="$refs.photo.click()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-16 left-4 z-10" x-show="photoPreview" style="display: none;">
                            <div class="relative group">
                                <span class="block rounded-full w-32 h-32 bg-cover bg-no-repeat bg-center border-4 border-white shadow-md"
                                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>

                                <!-- Overlay for Edit Icon -->
                                <div class="absolute inset-0 rounded-full bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition cursor-pointer"
                                     x-on:click.prevent="$refs.photo.click()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

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

                    <div class="bg-white p-4 rounded-b-lg shadow-sm flex justify-between items-center mt-16">
                        <div>
                            <h2 class="text-xl font-bold">{{ $this->user->name .' '.$this->user->prenom }}</h2>
                            <p class="text-gray-500 text-sm">{{ $this->user->pseudo ?? 'Add a username' }} </p>
                        </div>
                        <div class="flex space-x-2">
                            <x-secondary-button class="bg-blue-50 hover:bg-blue-100 text-blue-700" type="button" x-on:click.prevent="$refs.photo.click()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ __('Update Photo') }}
                            </x-secondary-button>

                            @if ($this->user->profile_photo_path)
                                <x-secondary-button type="button" class="text-gray-700" wire:click="deleteProfilePhoto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    {{ __('Remove') }}
                                </x-secondary-button>
                            @endif
                        </div>
                    </div>
                </div>

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- User Info Section with Facebook-like Styling -->
        <div class="col-span-6 bg-white p-6 rounded-lg shadow-sm mb-4">
            <h3 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">{{ __('About You') }}</h3>

            <div class="space-y-4">
                <div>
                    <x-label for="bio" value="{{ __('Bio') }}" class="text-gray-700 font-medium" />
                    <x-textarea id="bio" class="mt-1 block w-full rounded-md  border-none" rows="3" wire:model="state.bio" autocomplete="bio" placeholder="Write something about yourself..." />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-label for="pseudo" value="{{ __('Username') }}" class="text-gray-700 font-medium" />
                        <x-input id="pseudo" type="text" class="mt-1 block w-full rounded-md border-gray-300" wire:model="state.pseudo" autocomplete="pseudo" />
                        <x-input-error for="pseudo" class="mt-1" />
                    </div>

                    <div>
                        <x-label for="name" value="{{ __('Last Name') }}" class="text-gray-700 font-medium" />
                        <x-input id="name" type="text" class="mt-1 block w-full rounded-md border-gray-300" wire:model="state.name" required autocomplete="name" />
                        <x-input-error for="name" class="mt-1" />
                    </div>

                    <div>
                        <x-label for="prenom" value="{{ __('First Name') }}" class="text-gray-700 font-medium" />
                        <x-input id="prenom" type="text" class="mt-1 block w-full rounded-md border-gray-300" wire:model="state.prenom" required autocomplete="prenom" />
                        <x-input-error for="prenom" class="mt-1" />
                    </div>

                    <div>
                        <x-label for="email" value="{{ __('Email') }}" class="text-gray-700 font-medium" />
                        <x-input id="email" type="email" class="mt-1 block w-full rounded-md border-gray-300" wire:model="state.email" required autocomplete="username" />
                        <x-input-error for="email" class="mt-1" />

                        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                            <p class="text-sm mt-2 text-yellow-600 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                {{ __('Your email address is unverified.') }}

                                <button type="button" class="ml-2 text-blue-600 hover:underline rounded-md focus:outline-none" wire:click.prevent="sendEmailVerification">
                                    {{ __('Verify now') }}
                                </button>
                            </p>

                            @if ($this->verificationLinkSent)
                                <p class="mt-2 font-medium text-sm text-green-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex items-center">
            <x-action-message class="mr-3 text-green-600 flex items-center" on="saved">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ __('Profile updated successfully!') }}
            </x-action-message>

            <x-button wire:loading.attr="disabled" wire:target="photo" class="bg-blue-600 hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                {{ __('Save Changes') }}
            </x-button>
        </div>
    </x-slot>
</x-form-section>
