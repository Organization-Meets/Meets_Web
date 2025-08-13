<?php

namespace Tests\Unit;

// Importa a classe base TestCase do PHPUnit para criar testes unitários
use PHPUnit\Framework\TestCase;

// Define a classe de teste ExampleTest que herda de TestCase
class ExampleTest extends TestCase
{
    /**
     * Um exemplo básico de teste.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        // Verifica se o valor verdadeiro é realmente verdadeiro
        // Este teste sempre irá passar, pois true é igual a true
        $this->assertTrue(true);
    }
}

