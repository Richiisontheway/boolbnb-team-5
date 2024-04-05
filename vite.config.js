import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/scss/variables.scss',
                'resources/scss/sponsors/sponsors.scss',
                'resources/scss/apartments/apartments.scss',
                'resources/scss/apartments/show.scss',
                'resources/scss/services/index.scss',
                'resources/scss/contacts/messages.scss',
                'resources/scss/dashboard/dashboard.scss',
                'resources/scss/auth/register.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~resources': '/resources/',
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});
