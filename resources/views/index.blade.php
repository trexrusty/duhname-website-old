<x-layout>
    <h1>Hello World</h1>
    <div class="container mx-auto mt-5 max-w-md bg-slate-00 rounded-lg shadow-md p-6 text-center">
        @if (auth()->check())
            <p>Post something</p>
            <form action="{{ route('post.store') }}" method="POST">
                @csrf
                <input type="text" name="content" class="mt-1 block w-full border-gray-500 rounded-md shadow-sm text-white bg-secondary">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Post</button>
            </form>
        @endif
    </div>
    @foreach ($posts as $post)
        <div class="border border-gray-500 container mx-auto mt-5 max-w-md bg-slate-00 rounded-lg shadow-md p-6 text-white">
            <div class="flex items-center text-left mb-2">
                <img src="http://localhost:9000/local/user_icons/{{ $post->owner->id }}.png" class="w-10 h-10 rounded-full">
                <div class="flex flex-col">
                    <a href="{{ route('home', $post->owner->id) }}" class="text-sm hover:text-gray-300">{{ $post->owner->tag }}</a>
                    <p class="text-xs">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <div class="">
                <p>{{ $post->content }}</p>
            </div>
        </div>
    @endforeach
    {{ $posts->links() }}
</x-layout>
