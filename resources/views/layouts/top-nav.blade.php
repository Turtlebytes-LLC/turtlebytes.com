<nav class="bg-gradient-to-r from-blue-500 to-blue-700 py-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-white text-3xl font-extrabold tracking-wide">{{ config('app.name') }}</a>
        <ul class="flex gap-3">
            <li><a href="/" class="text-white hover:text-gray-200 transition duration-300">Home</a></li>
            <li><a href="{{ route('blogs.index') }}" class="text-white hover:text-gray-200 transition duration-300">Blogs</a></li>
        </ul>
    </div>
</nav>
