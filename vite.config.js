import { defineConfig, resolveConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',                    // Not used as Bootstrap covers styling
                'resources/js/app.js',                      // Loaded on all pages
                'resources/js/helpers/signup-form.js',      // Signup form related assets
                'resources/js/helpers/pvgis-request.js'     // PVGIS request methods
            ],
            refresh: true,
        }),
    ],
});
