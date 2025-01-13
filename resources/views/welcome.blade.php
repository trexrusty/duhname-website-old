@vite('resources/js/app.js')
@vite('resources/css/app.css')
<div id="home" class="container mx-auto p-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Generate Your Icon</h2>

        <form class="space-y-6">
            <div class="relative">
                @csrf
                <label for="seed" class="block text-sm font-medium text-gray-700 mb-2">Icon Seed</label>
                <input
                    id="seed"
                    name="seed"
                    type="text"
                    placeholder="Enter seed value"
                    hx-trigger="keyup changed delay:500ms"
                    hx-post="{{ route('icon') }}"
                    hx-target="#icon-preview"
                    class="w-full rounded-md border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                >
            </div>
            <div id="icon-preview" class="flex justify-center"></div>
            <button
                type="submit"
                hx-post="{{ route('saveIcon') }}"
                hx-target="#home"
                class="w-full px-4 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
            >
                Save Icon
            </button>
        </form>
    </div>

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
