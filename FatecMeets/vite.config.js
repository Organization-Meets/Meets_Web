// Importa a função defineConfig do Vite, que é usada para definir a configuração do projeto
import { defineConfig } from 'vite';
// Importa o plugin laravel-vite-plugin, que integra o Vite ao Laravel
import laravel from 'laravel-vite-plugin';

// Exporta a configuração do Vite usando defineConfig
export default defineConfig({
    plugins: [
        // Adiciona o plugin do Laravel ao Vite
        laravel({
            // Define os arquivos de entrada para o Vite (CSS e JS principais do projeto)
            input: ['resources/css/app.css', 'resources/js/app.js'],
            // Habilita o recarregamento automático da página quando os arquivos são alterados
            refresh: true,
        }),
    ],
});
