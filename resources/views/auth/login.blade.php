<x-layout>
    <div class="container mx-auto mt-5 max-w-md bg-slate-00 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-white">Login</h1>
        <form action="{{ route('login.post') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-white">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full border-white-200 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 bg-slate-400 text-white">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-white">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 border-solid block w-full border-white rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 bg-slate-400 text-white">
            </div>
            <div class="flex justify-center">
                <x-captcha />
            </div>
            <div class="flex justify-center">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Login</button>
            </div>
        </form>
    </div>
</x-layout>
