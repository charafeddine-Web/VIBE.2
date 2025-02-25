<x-app-layout>
    <x-slot name="header">
        <!-- Section for Adding Posts -->
        <div class="mt-2 bg-white dark:bg-gray-900 p-4 rounded-xl shadow-lg border border-gray-200 dark:border-gray-800">
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
                    rows="3"
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
    </x-slot>

    <div class="py-12 min-h-screen bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-indigo-900 via-gray-900 to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="backdrop-blur-xl bg-white/5 overflow-hidden shadow-md sm:rounded-2xl border border-white/10 p-6">
                @foreach($posts as $post)
                    <div class="bg-gray-900 p-4 rounded-lg shadow-md mb-4 relative">
                        <p class="text-white">{{ $post->content }}</p>
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-60 object-cover mt-2 rounded-lg">
                        @endif

                        @if(auth()->user()->id === $post->user_id)
                            <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="absolute top-2 right-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

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
        });
    }
</script>
