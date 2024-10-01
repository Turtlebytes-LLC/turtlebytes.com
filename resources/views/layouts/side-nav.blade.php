<flux:sidebar stashable sticky class="lg:hidden bg-green-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="/" logo="https://fluxui.dev/img/demo/logo.png" name="{{ config('app.name') }}" class="px-2 dark:hidden" />
    <flux:brand href="/" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="{{ config('app.name') }}" class="px-2 hidden dark:flex" />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" href="/" current>Home</flux:navlist.item>
        <flux:navbar.item icon="book-open" href="{{route('blogs.index')}}">Blog</flux:navbar.item>

        @if(false)
        <flux:navlist.group expandable heading="Favorites" class="max-lg:hidden">
            <flux:navlist.item href="#">Marketing site</flux:navlist.item>
            <flux:navlist.item href="#">Android app</flux:navlist.item>
            <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>
        </flux:navlist.group>
        @endif
    </flux:navlist>

    <flux:spacer />

    @if(false)
    <flux:navlist variant="outline">
        <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
        <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
    </flux:navlist>
    @endif
</flux:sidebar>
