<x-app-layout>
    <div class="flex gap-40">

    <x-sidebar-left />



    <div class="max-w-5xl mx-auto px-4 py-8">

        <!-- Liste des amis -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($amis as $ami)
                <div class="flex items-center justify-between bg-gray-900 p-4 rounded-xl shadow-lg hover:scale-105 transition-all duration-300">
                    <!-- Avatar & Infos -->
                    <div class="flex items-center gap-4">
                        <img src="{{ $ami->profile_photo_url ?? 'https://via.placeholder.com/50' }}" alt="Avatar"
                             class="w-12 h-12 rounded-full border-2 border-indigo-500 shadow-md">
                        <div>
                            <span class="text-black font-semibold text-lg">{{ $ami->pseudo }}</span>
                            <p class="text-gray-600 text-sm">{{ $ami->nom }} {{ $ami->prenom }}</p>
                        </div>
                    </div>

                    <!-- Icône de messagerie -->
                    <a href="{{ route('messages', $ami->id) }}"
                       class="text-indigo-400 hover:text-indigo-500 transition-all duration-300">
                        <i class="fas fa-comment-alt text-xl"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    </div>
</x-app-layout>
