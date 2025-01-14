<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-secondary text-white">
    <nav class="bg-secondary p-4 flex justify-center items-center">
        <div class="flex space-x-4 items-center">
            <a href="{{ route('home') }}" class="text-white hover:text-gray-300">Home</a>
            @if (auth()->check())
                <img src="{{ auth()->user()->icon_url ?? 'http://localhost:9000/local/user_icons/' . auth()->user()->id . '.png' }}"
                     alt="User icon"
                     class="w-8 h-8 rounded-full">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white hover:text-red-300">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white hover:text-gray-300">Login</a>
                <a href="{{ route('register') }}" class="text-white hover:text-gray-300">Register</a>
            @endif
        </div>
    </nav>
    {{$slot}}
</body>
</html>
