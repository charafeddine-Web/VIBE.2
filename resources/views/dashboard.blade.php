<x-app-layout>
    <div class="min-h-screen  dark:bg-gray-900">
        <!-- Main Container - Three Column Layout -->
        <div class="flex mx-auto">
            <!-- Left Sidebar - Navigation -->
            <x-sidebar-left />
            <!-- Main Content - Posts Feed -->
            <div class="w-full md:w-3/2 md:ml-1/5 pt-4 px-4 sm:px-6 md:px-8">
                <div class="mt-2 bg-white dark:bg-gray-900 p-4 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800 max-w-2xl mx-auto">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="h-10 w-10 rounded-full object-cover border-2 border-indigo-500" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                @else
                                    <div class="h-10 w-10 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <textarea
                                    name="content"
                                    rows="2"
                                    class="w-full p-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none text-gray-800 dark:text-gray-200 placeholder-gray-500 dark:placeholder-gray-400 transition duration-200 ease-in-out"
                                    placeholder="What's on your mind, {{ Auth::user()->name }}?"
                                ></textarea>
                                <div id="imagePreview" class="hidden mt-3 relative rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800">
                                    <img id="preview" class="w-full max-h-40 object-contain" src="" alt="Preview">
                                    <button type="button" id="removeImage" class="absolute top-2 right-2 bg-gray-800 bg-opacity-70 text-white rounded-full p-1 hover:bg-opacity-100 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Action Bar -->
                                <div class="flex flex-wrap justify-between items-center mt-4 border-t border-gray-200 dark:border-gray-700 pt-3">
                                    <!-- Attachment Options -->
                                    <div class="flex items-center space-x-2 mb-2 sm:mb-0">
                                        <label for="image-upload" class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer transition group">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">Photo</span>
                                        </label>
                                        <input
                                            id="image-upload"
                                            type="file"
                                            name="image"
                                            accept="image/*"
                                            class="hidden"
                                            onchange="previewImage(this)"
                                        >
                                    </div>

                                    <button
                                        type="submit"
                                        class="px-6 py-2 bg-indigo-500 hover:bg-indigo-700 text-white font-medium rounded-lg transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        Post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Posts Feed -->
                <div class="mt-6 space-y-6 max-w-2xl mx-auto">
                    @foreach($posts as $post)
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-md relative border border-gray-200 dark:border-gray-700">
                            <!-- Post Header with User Info -->
                            <div class="flex items-center mb-3">
                                <div class="flex-shrink-0">
{{--                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $post->user->profile_photo_url ?? asset('img/default-avatar.png') }}" alt="{{ $post->user->name }}">--}}
                                </div>
                                <div class="ml-3">
{{--                                    <p class="font-medium text-gray-900 dark:text-white">{{ $post->user->name }}</p>--}}
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                                </div>

                                @if(auth()->user()->id === $post->user_id)
                                    <div class="ml-auto">
                                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            <p class="text-gray-800 dark:text-gray-200 mb-3">{{ $post->content }}</p>
                            @if($post->image)
                                <div class="rounded-lg overflow-hidden mb-3">
                                    <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-auto max-h-96 object-contain" alt="Post image">
                                </div>
                            @endif
                            <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-200 dark:border-gray-700">
                                <button class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                    <span>Like</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span>Comment</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    <span>Share</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Sidebar - Contacts & Friend Requests -->
            <div class="hidden lg:block w-1/5 fixed right-0 h-screen pt-16 pb-4 px-2 overflow-y-auto bg-white dark:bg-gray-900 border-l border-gray-200 dark:border-gray-800">
                <!-- Friend Requests Section -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Friend Requests</h3>
                    <div class="space-y-3">
                        <!-- Friend request items would go here -->
                        <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900 dark:text-white">New Request</p>
                                    <div class="flex space-x-2 mt-2">
                                        <button class="px-3 py-1 bg-indigo-500 text-white text-sm rounded-md hover:bg-indigo-600">Accept</button>
                                        <button class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-sm rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">Decline</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('afficherDemandesAmitie') }}" class="block text-indigo-500 hover:text-indigo-600 text-sm mt-3">See all requests</a>
                </div>

                <!-- Contacts Section -->
                <div class="p-4 border-t border-gray-200 dark:border-gray-800">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Contacts</h3>
                    <div class="space-y-2">
                        <!-- Contact items would go here -->
                        <a href="#" class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg">
                            <div class="h-8 w-8 rounded-full bg-gray-300 dark:bg-gray-600 relative">
                                <span class="absolute bottom-0 right-0 block h-2 w-2 rounded-full bg-green-500 ring-1 ring-white"></span>
                            </div>
                            <span class="ml-3 text-gray-900 dark:text-white">Friend Name</span>
                        </a>
                        <a href="#" class="flex items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg">
                            <div class="h-8 w-8 rounded-full bg-gray-300 dark:bg-gray-600"></div>
                            <span class="ml-3 text-gray-900 dark:text-white">Another Friend</span>
                        </a>
                    </div>
                    <a href="{{ route('showallamis') }}" class="block text-indigo-500 hover:text-indigo-600 text-sm mt-3">See all friends</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Bar (Facebook-style) - Fixed at Bottom -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 flex justify-around p-2 z-50">
        <a href="{{ route('posts.index') }}" class="flex flex-col items-center p-2 text-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-xs">Home</span>
        </a>
        <a href="{{ route('showallamis') }}" class="flex flex-col items-center p-2 text-gray-500 dark:text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span class="text-xs">Friends</span>
        </a>
        <a href="{{ route('afficherDemandesAmitie') }}" class="flex flex-col items-center p-2 text-gray-500 dark:text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            <span class="text-xs">Requests</span>
        </a>
        <a href="{{ route('profile.show') }}" class="flex flex-col items-center p-2 text-gray-500 dark:text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-xs">Settings</span>
        </a>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            const removeButton = document.getElementById('removeImage');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }

            removeButton.addEventListener('click', function() {
                input.value = '';
                previewContainer.classList.add('hidden');
                preview.src = '';
            });
        }

    <!-- Dark Mode Toggle Script -->
        // Check for saved dark mode preference or use user's system preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Function to toggle dark mode
        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }
    </script>
</x-app-layout>
