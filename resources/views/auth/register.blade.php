<x-layout>
    <div class="container mx-auto mt-5 max-w-md bg-slate-00 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-white">Create Account</h1>
        <form action="{{ route('register') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>
            <div class="mb-4">
                <label for="tag" class="block text-sm font-medium text-gray-700">Tag</label>
                <input type="text" name="tag" id="tag" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>
            <div class="flex justify-center">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create User</button>
            </div>

            <div class="flex justify-center">
                <x-captcha class="mt-4 items-center"/>
            </div>

        </form>
    </div>
</x-layout>
