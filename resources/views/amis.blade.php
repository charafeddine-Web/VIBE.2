<x-app-layout>
    <div class="flex justify-between items-start h-[100vh] gap-6 bg-gradient-to-br from-gray-900 to-indigo-950">
        <x-sidebar-left />

        <div class="flex-1 max-w-6xl mx-auto px-4 py-6 pl-40">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2 flex items-center">
                    <i class="fas fa-users text-indigo-400 mr-3"></i>
                    Mes Amis
                </h1>
                <div class="h-0 w-32 bg-indigo-500 rounded-full mb-4"></div>
                <p class="text-indigo-200 text-lg">Retrouvez tous vos amis et connectez-vous avec eux.</p>
            </div>

            <!-- Friends Grid with Facebook-like styling -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($amis as $ami)
                    <div class="bg-gray-800 bg-opacity-70 rounded-lg overflow-hidden shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1 border border-gray-700 group">
                        <!-- Profile photo - larger and centered like Facebook -->
                        <div class="pt-4 flex justify-center">
                            <a href="{{ route('profil.show', ['userId' => $ami->id]) }}" class="relative">
                                <div class="w-24 h-24 rounded-full border-4 border-gray-800 overflow-hidden mx-auto">
                                    <img src="{{ $ami->profile_photo_url ?? 'https://via.placeholder.com/50' }}" alt="Avatar"
                                         class="w-full h-full object-cover">
                                </div>
                            </a>
                        </div>

                        <!-- Profile info - centered like Facebook -->
                        <div class="px-4 py-3 text-center">
                            <h3 class="text-xl font-bold text-white group-hover:text-indigo-300 transition-colors">
                                <a href="{{ route('profil.show', ['userId' => $ami->id]) }}">{{ $ami->pseudo }}</a>
                            </h3>
                            <a href="{{ route('profil.show', ['userId' => $ami->id]) }}" class="text-indigo-200 text-sm block">
                                {{ $ami->nom }} {{ $ami->prenom }}
                            </a>
                        </div>

                        <!-- Action buttons - Facebook style with confirm/remove -->
                        <div class="px-4 pb-4">
                            <div class="grid grid-cols-2 gap-2">
                                <a href="#" class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-3 rounded-md transition-colors text-sm font-medium">
                                    <i class="fas fa-comment-alt mr-1"></i>
                                    Message
                                </a>
                                <a href="{{ route('profil.show', ['userId' => $ami->id]) }}" class="flex items-center justify-center bg-gray-700 hover:bg-gray-600 text-white py-2 px-3 rounded-md transition-colors text-sm font-medium">
                                    <i class="fas fa-user-friends mr-1"></i>
                                    Voir profil
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
