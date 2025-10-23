import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/registro_artis.css',
                'resources/css/crear_boleta.css',
                'resources/css/consulta.css',
                'resources/css/eventos_dispo.css',
                'resources/css/localidad.css',
                'resources/css/index.css',
                'resources/css/index2.css',
                

            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
