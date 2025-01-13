<x-layout>

    @if (auth()->user())
        <div class="max-w-md mx-auto mt-8 bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center space-x-4">
                <img id="profile-icon" src="{{ $iconUrl }}" alt="User Icon" class="w-32 h-32 rounded-full shadow-lg">
                <div class="space-y-2">
                    <p class="text-xl font-semibold">{{ auth()->user()->username }}</p>
                    <p class="text-gray-600">{{ auth()->user()->tag }}</p>
                    <p class="text-gray-500 text-sm">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    @endif
</div>
</x-layout>
