<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Canais de Broadcast
|--------------------------------------------------------------------------
|
| Aqui você pode registrar todos os canais de transmissão de eventos que
| sua aplicação suporta. Os callbacks de autorização de canal fornecidos
| são usados para verificar se um usuário autenticado pode escutar o canal.
|
*/

// Registra um canal de broadcast chamado 'App.Models.User.{id}'.
// O callback de autorização verifica se o usuário autenticado ($user)
// possui o mesmo id que o parâmetro {id} do canal.
// Isso garante que apenas o próprio usuário possa escutar eventos privados desse canal.
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    // Compara o id do usuário autenticado com o id do canal.
    // Retorna true se forem iguais, permitindo o acesso ao canal.
    return (int) $user->id === (int) $id;
});
