@props(['title', 'description', 'route', 'iconColor'])

<a href="{{ $route }}" class="group">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-{{ $iconColor }}-200 hover:shadow-md transition-all duration-300 h-full">
        <div class="flex items-center mb-4">
            <div class="bg-{{ $iconColor }}-50 p-3 rounded-lg mr-4">
                <svg class="w-6 h-6 text-{{ $iconColor }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-{{ $iconColor }}-600">{{ $title }}</h3>
        </div>
        <p class="text-gray-500">{{ $description }}</p>
        <div class="mt-4 text-{{ $iconColor }}-600 flex items-center">
            <span>Accéder</span>
            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
    </div>
</a>
