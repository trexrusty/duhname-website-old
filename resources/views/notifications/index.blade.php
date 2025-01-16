<x-layout>
    <div class="container mx-auto mt-5 max-w-2xl">
        <div class="bg-slate-800 rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-white">Notifications</h1>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-blue-400 hover:text-blue-300">
                            Mark all as read
                        </button>
                    </form>
                @endif
            </div>

            <div class="space-y-4">
                @forelse ($notifications as $notification)
                    <div class="flex items-center justify-between p-4 {{ $notification->read_at ? 'bg-slate-700' : 'bg-slate-600' }} rounded-lg">
                        <div class="flex-1">
                            <p class="text-white">{{ $notification->data['message'] }}</p>
                            <p class="text-sm text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        @if(!$notification->read_at)
                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm text-blue-400 hover:text-blue-300">
                                    Mark as read
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-center text-gray-400">No notifications</p>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</x-layout>
