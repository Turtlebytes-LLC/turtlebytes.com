<nav class="bg-blue-500 py-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-white text-2xl font-bold">{{config('app.name')}}</a>
        <ul class="flex space-x-4">
            <li><a href="/" class="text-white">Home</a></li>
            <li><a href="{{route('blogs.index')}}" class="text-white">Blogs</a></li>
        </ul>
    </div>
</nav>
