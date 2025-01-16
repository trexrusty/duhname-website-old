@foreach ($posts as $post)
<div id="post-{{ $post->id }}" class="border border-gray-500 container mx-auto mb-5 max-w-md bg-slate-00 rounded-lg shadow-md p-6 text-white">
    <div class="flex items-center text-left mb-2">
        <img src="http://localhost:9000/local/user_icons/{{ $post->owner->id }}.png" class="w-10 h-10 rounded-full">
        <div class="flex flex-col">
            <div class="flex items-center">
                <a href="{{ route('home', $post->owner->id) }}" class="text-sm hover:text-gray-300 {{ $post->owner->is_bugfinder ? 'text-bugfinder' : '' }}">{{ $post->owner->tag }}</a>
                @if($post->owner->hasRole('Verified'))
                    <p class="text-xs text-verified ml-2">Verified</p>
                @endif
            </div>
            <p class="text-xs">{{ $post->created_at->diffForHumans() }}</p>
        </div>
    </div>
    <p class="whitespace-normal break-words">{{ Str::limit($post->content, 75) }}</p>
    <form class="flex items-center justify-end" hx-post="{{ route('like.post', $post->id) }}" hx-target="#post-{{ $post->id }}" hx-swap="outerHTML">
        @csrf
        <p class="text-sm">{{ $post->likes_count }}</p>
        <button type="submit" class="flex items-right">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="{{ $post->likes->contains('user_id', Auth::id()) ? 'red' : 'white' }}">
                <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z"/>
                </svg>
            </button>
    </form>
</div>
@endforeach

@if ($posts->hasMorePages())
    <div
        hx-get="{{ $posts->nextPageUrl() }}"
        hx-trigger="intersect once"
        hx-swap="afterend"
    ></div>
@elseif ($posts->lastPage() == $posts->currentPage())
    <div class="text-center text-gray-500 mb-5">No more posts</div>
@endif
