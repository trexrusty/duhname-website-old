@vite('resources/js/app.js')

<form hx-post="{{ route('icon') }}" hx-target="#icon-preview" class="space-y-4">
    <div>
        @csrf
        <input
            id="seed"
            name="seed"
            type="text"
            placeholder="Enter seed value"
            hx-trigger="keyup changed delay:500ms"
            hx-post="{{ route('icon') }}"
            hx-target="#icon-preview"
            class="rounded border p-2"
        >
    </div>

    <button
        type="submit"
        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
    >
        Generate Icon
    </button>

    <div id="icon-preview"></div>
</form>
