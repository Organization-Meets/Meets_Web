// Importa a biblioteca lodash e a atribui ao objeto global window.
// Lodash fornece utilitários para facilitar o trabalho com arrays, objetos, etc.
import _ from 'lodash';
window._ = _;

/**
 * Carregamos a biblioteca HTTP axios, que permite emitir facilmente
 * requisições para o back-end Laravel. Esta biblioteca lida automaticamente
 * com o envio do token CSRF como um header, baseado no valor do cookie "XSRF".
 */
import axios from 'axios';
window.axios = axios;

// Define o cabeçalho 'X-Requested-With' como 'XMLHttpRequest' em todas as requisições axios.
// Isso indica ao servidor que a requisição foi feita via AJAX.
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo expõe uma API expressiva para assinar canais e escutar eventos
 * que são transmitidos pelo Laravel. Echo e a transmissão de eventos
 * permitem que sua equipe construa facilmente aplicações web robustas e em tempo real.
 */

// Importa a biblioteca Echo do laravel-echo para comunicação em tempo real.
// import Echo from 'laravel-echo';

// Importa a biblioteca Pusher para integração com o serviço Pusher.
// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// Inicializa o Echo com as configurações do Pusher, utilizando variáveis de ambiente.
// window.Echo = new Echo({
//     broadcaster: 'pusher', // Define o tipo de broadcaster como Pusher.
//     key: import.meta.env.VITE_PUSHER_APP_KEY, // Chave do aplicativo Pusher.
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1', // Cluster do Pusher.
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`, // Host WebSocket.
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80, // Porta WebSocket padrão.
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443, // Porta WebSocket segura padrão.
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https', // Força conexão segura se o esquema for 'https'.
//     enabledTransports: ['ws', 'wss'], // Transportes habilitados: WebSocket e WebSocket seguro.
// });
