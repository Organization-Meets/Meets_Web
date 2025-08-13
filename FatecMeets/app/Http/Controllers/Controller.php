<?php

namespace App\Http\Controllers;

// Importa os traits necessários para autorização, despacho de jobs e validação
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Autoriza requisições
use Illuminate\Foundation\Bus\DispatchesJobs; // Despacha jobs (tarefas)
use Illuminate\Foundation\Validation\ValidatesRequests; // Valida requisições
use Illuminate\Routing\Controller as BaseController; // Importa o controlador base do Laravel

/**
 * Classe Controller principal.
 * 
 * Esta classe serve como base para todos os controladores do aplicativo.
 * Ela utiliza traits do Laravel para fornecer funcionalidades de autorização,
 * despacho de jobs e validação de requisições.
 */
class Controller extends BaseController
{
    // Usa os traits para adicionar funcionalidades de autorização, jobs e validação
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

