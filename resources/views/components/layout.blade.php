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
<body class="bg-slate-800">
    <nav class="bg-gray-800 p-4">
        <ul class="flex space-x-4">
            <li><a href="{{ route('home') }}" class="text-white hover:text-gray-300">Home</a></li>
            @if (auth()->check())
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white hover:text-red-300">
                            Logout
                        </button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="text-white hover:text-gray-300">Login</a></li>
                <li><a href="{{ route('register') }}" class="text-white hover:text-gray-300">Register</a></li>
            @endif
        </ul>
    </nav>
    {{$slot}}
</body>
</html>
