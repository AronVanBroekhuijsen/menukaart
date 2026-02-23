import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/css/app.css',
                'resources/css/admin.scss',
                'resources/js/app.js',
                'resources/js/admin.js',
                'node_modules/jodit/es5/jodit.css',
                'node_modules/bootstrap/dist/css/bootstrap.css'
],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
