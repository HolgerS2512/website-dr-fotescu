import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            // deploy
            // input: ['resources/assets/css/app.css', 'resources/assets/js/app.js'],
            // dev
            input: [
                "resources/assets/css/app.css",
                "resources/assets/scss/app.scss",
                "resources/assets/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
