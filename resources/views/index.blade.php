<x-layout>
    <div class="container mx-auto mt-5 max-w-md bg-slate-00 rounded-lg shadow-md p-6 text-center">
        <h1 class="text-2xl font-bold">Hello World</h1>
        @if (auth()->check())
            <p>Post something</p>
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="text-red-500">{{ $error }}</p>
                @endforeach
            @endif
            <form hx-post="{{ route('post.store') }}" hx-target="#posts-container" hx-swap="innerHTML" hx-on::after-request="this.reset()">
                @csrf
                <input type="text" name="content" class="mt-1 block w-full border-gray-500 rounded-md shadow-sm text-white bg-secondary hover:bg-tertiary">
                <button type="submit" class="px-4 py-2 mt-2 bg-secondary text-white rounded hover:bg-tertiary mb-2" >Post</button>
                <x-captcha />
            </form>
        @endif
    </div>
    <div id="posts-container" hx-get="{{ route('post.index') }}" hx-trigger="load" hx-swap="innerHTML">
        <div id="replace-posts">
        </div>
    </div>
</x-layout>
