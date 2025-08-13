<?php

namespace Tests; // Define o namespace para os testes

use Illuminate\Foundation\Testing\TestCase as BaseTestCase; // Importa a classe base de teste do Laravel

/**
 * Classe abstrata TestCase
 * 
 * Esta classe serve como base para todos os testes automatizados.
 * Ela utiliza a trait CreatesApplication para inicializar a aplicação
 * antes da execução dos testes.
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication; // Usa a trait que cria a instância da aplicação para os testes
}

