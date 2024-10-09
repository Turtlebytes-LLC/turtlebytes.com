import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'

export default defineConfig({
    server: {
        host: '0.0.0.0',  // Listen on all IPs
        hmr: {
            host: '192.168.1.4', // Replace with your local machine's IP address
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js'],
            refresh: [
                ...refreshPaths,
                'app/Filament/**',
                'app/Forms/Components/**',
                'app/Livewire/**',
                'app/Infolists/Components/**',
                'app/Providers/Filament/**',
                'app/Tables/Columns/**',
            ],
        }),
    ],
})
