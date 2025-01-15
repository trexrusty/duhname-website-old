<div id="post-{{ $post->id }}" class="border border-gray-500 container mx-auto mb-5 max-w-md bg-slate-00 rounded-lg shadow-md p-6 text-white">
    <div class="flex items-center text-left mb-2">
        <img src="http://localhost:9000/local/user_icons/{{ $post->owner->id }}.png" class="w-10 h-10 rounded-full">
        <div class="flex flex-col">
            <a href="{{ route('home', $post->owner->id) }}" class="text-sm hover:text-gray-300">{{ $post->owner->tag }}</a>
            <p class="text-xs">{{ $post->created_at->diffForHumans() }}</p>
        </div>
    </div>
    <p>{{ $post->content }}</p>
    <form class="flex items-center justify-center" hx-post="{{ route('like.post', $post->id) }}" hx-target="#post-{{ $post->id }}" hx-swap="outerHTML">
        @csrf
        <p>{{ $post->likes->count() }}</p>
        <button type="submit"
            class="{{ $post->likes->contains('user_id', Auth::id()) ? 'bg-red-500' : 'bg-secondary' }}">
            {{ $post->likes->contains('user_id', Auth::id()) ? 'Unlike' : 'Like' }}
        </button>
    </form>
</div>
