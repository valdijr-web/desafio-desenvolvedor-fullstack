import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),

        viteStaticCopy({
            targets: [
                {
                    src: 'resources/assets/sb-admin-2/css',
                    dest: 'assets/sb-admin-2',
                },
                {
                    src: 'resources/assets/sb-admin-2/js',
                    dest: 'assets/sb-admin-2',
                },
                {
                    src: 'resources/assets/sb-admin-2/vendor/jquery',
                    dest: 'assets/sb-admin-2/vendor',
                },
                {
                    src: 'resources/assets/sb-admin-2/vendor/jquery-easing',
                    dest: 'assets/sb-admin-2/vendor',
                },
                {
                    src: 'resources/assets/sb-admin-2/vendor/jquery-mask',
                    dest: 'assets/sb-admin-2/vendor',
                },
                {
                    src: 'resources/assets/sb-admin-2/vendor/fontawesome-free',
                    dest: 'assets/sb-admin-2/vendor',
                },
                {
                    src: 'resources/assets/sb-admin-2/vendor/datatables',
                    dest: 'assets/sb-admin-2/vendor',
                },
                {
                    src: 'resources/assets/sb-admin-2/vendor/chart.js',
                    dest: 'assets/sb-admin-2/vendor',
                },
                {
                    src: 'resources/assets/sb-admin-2/vendor/bootstrap',
                    dest: 'assets/sb-admin-2/vendor',
                },
                {
                    src: 'resources/assets/sb-admin-2/vendor/select2',
                    dest: 'assets/sb-admin-2/vendor',
                },
                {
                    src: 'resources/assets/sb-admin-2/img',
                    dest: 'assets/sb-admin-2',
                },
            ]
        }),
    ],
});
