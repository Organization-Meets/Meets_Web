<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// Esta classe define um teste de funcionalidade para a aplicação
class ExampleTest extends TestCase
{
    /**
     * Um exemplo básico de teste.
     *
     * @return void
     */
    // Este método testa se a aplicação retorna uma resposta bem-sucedida ao acessar a rota principal
    public function test_the_application_returns_a_successful_response()
    {
        // Realiza uma requisição GET para a rota "/"
        $response = $this->get('/');

        // Verifica se o status da resposta é 200 (OK)
        $response->assertStatus(200);
    }
}

