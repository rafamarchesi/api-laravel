<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Registro;
use Illuminate\Foundation\Testing\WithFaker;

class RegistroTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_list_registros()
    {
        $registros = Registro::factory()->count(3)->create();

        $response = $this->get('/api/registros');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    public function test_can_show_registro()
    {
        $registro = Registro::factory()->create();

        $response = $this->get('/api/registros/' . $registro->id);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $registro->id,
            'nome' => $registro->nome
        ]);
    }

    public function test_cannot_show_non_existent_registro()
    {
        $response = $this->get('/api/registros/999');

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Registro não encontrado',
        ]);
    }
}
