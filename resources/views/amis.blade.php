<x-app-layout>
    <div class="flex justify-between  items-start h-[100vh]  gap-6 bg-gradient-to-br from-gray-900 to-indigo-950  ">
        <x-sidebar-left />

        <div class="flex-1 max-w-6xl mx-auto px-4 py-6  pl-40       ">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2 flex items-center">
                    <i class="fas fa-users text-indigo-400 mr-3"></i>
                    Mes Amis
                </h1>
                <div class="h-0 w-32 bg-indigo-500 rounded-full mb-4"></div>
                <p class="text-indigo-200 text-lg">Retrouvez tous vos amis et connectez-vous avec eux.</p>
            </div>

            <!-- Search Filter -->
{{--            <div class="mb-8 bg-gray-800 bg-opacity-60 rounded-xl p-4 shadow-lg backdrop-blur-sm border border-gray-700">--}}
{{--                <div class="flex flex-wrap gap-4 items-center">--}}
{{--                    <div class="relative flex-grow max-w-md">--}}
{{--                        <input type="text" placeholder="Rechercher un ami..."--}}
{{--                               class="w-full bg-gray-900 border border-indigo-500 rounded-full py-2 px-4 pl-10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">--}}
{{--                        <i class="fas fa-search absolute left-3 top-3 text-indigo-400"></i>--}}
{{--                    </div>--}}
{{--                    <select class="bg-gray-900 border border-indigo-500 rounded-full py-2 px-4 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">--}}
{{--                        <option>Tous les amis</option>--}}
{{--                        <option>Récemment ajoutés</option>--}}
{{--                        <option>En ligne</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- Friends Grid with Animation -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($amis as $ami)
                    <div class="bg-gray-800 bg-opacity-70 rounded-xl overflow-hidden shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1 border border-gray-700 group">
                        <!-- Header with cover image -->
                        <div class="h-24 bg-gradient-to-r from-indigo-600 to-purple-600 relative">
                            <!-- Status indicator -->
{{--                            <div class="absolute top-3 right-3 flex items-center bg-gray-900 bg-opacity-70 rounded-full px-2 py-1">--}}
{{--                                <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>--}}
{{--                                <span class="text-xs text-white">En ligne</span>--}}
{{--                            </div>--}}
                        </div>

                        <!-- Profile section -->
                        <div class="px-4 py-5 relative">
                            <div class="absolute -top-8 left-4 w-16 h-16 rounded-full border-4 border-gray-800 overflow-hidden">
                                <img src="{{ $ami->profile_photo_url ?? 'https://via.placeholder.com/50' }}" alt="Avatar"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="mt-8 mb-4">
                                <h3 class="text-xl font-bold text-white group-hover:text-indigo-300 transition-colors"><a href="#">{{ $ami->pseudo }}</a></h3>
                                <a href="#" class="text-indigo-200 text-sm">{{ $ami->nom }} {{ $ami->prenom }}</a>
                            </div>

                            <!-- Action buttons -->
                            <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-700">
                                <a href="#" class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition-colors">
                                    <i class="fas fa-comment-alt mr-2"></i>
                                    Message
                                </a>

                                <div class="flex gap-2">

                                    <button class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-700 hover:bg-gray-600 text-white transition-colors">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
{{--            <div class="mt-10 flex justify-center">--}}
{{--                <div class="flex items-center gap-2 bg-gray-800 rounded-full px-4 py-2 shadow-md">--}}
{{--                    <button class="w-8 h-8 flex items-center justify-center rounded-full text-indigo-300 hover:bg-gray-700 transition-colors">--}}
{{--                        <i class="fas fa-angle-left"></i>--}}
{{--                    </button>--}}
{{--                    <button class="w-8 h-8 flex items-center justify-center rounded-full bg-indigo-600 text-white">1</button>--}}
{{--                    <button class="w-8 h-8 flex items-center justify-center rounded-full text-indigo-300 hover:bg-gray-700 transition-colors">2</button>--}}
{{--                    <button class="w-8 h-8 flex items-center justify-center rounded-full text-indigo-300 hover:bg-gray-700 transition-colors">3</button>--}}
{{--                    <button class="w-8 h-8 flex items-center justify-center rounded-full text-indigo-300 hover:bg-gray-700 transition-colors">--}}
{{--                        <i class="fas fa-angle-right"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</x-app-layout>
