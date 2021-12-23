<?php

namespace Tests\Feature;

use App\Cotizaciones\Plazos\PlazoRepositoryInterface;
use App\Cotizaciones\Plazos\PlazoTO;
use App\Models\Plazo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlazosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_check_index()
    {
        $usuario = User::first();
        $response = $this->actingAs($usuario)
            ->get(route('plazos.index'));

        $response->assertStatus(200);
    }

    public function test_check_create()
    {
        $usuario = User::first();
        $response = $this->actingAs($usuario)
            ->get(route('plazos.create'));

        $response->assertStatus(200);
    }

    public function test_check_edit()
    {
        $usuario = User::first();
        $plazo = Plazo::first();
        $response = $this->actingAs($usuario)
            ->get(route('plazos.edit', $plazo->id));

        $response->assertStatus(200);
    }

    public function test_verificar_guardado()
    {
        $usuario = User::first();
        $plazoTO = new PlazoTO();
        $plazoTO->setPlazo(12);
        $plazoTO->setDescripcion('Plazo Test');
        $plazoTO->setTasaNormal(1);
        $plazoTO->setTasaPuntual(1);
        $plazoTO->setUsuarioId($usuario->id);
        $plazoRepository = resolve(PlazoRepositoryInterface::class);
        $plazoRepository->guardarPlazo($plazoTO);
        $this->assertNotEquals($plazoTO->getId(), null);
        Plazo::destroy($plazoTO->getId());
    }

    public function test_verificar_actualizacion()
    {
        $usuario = User::first();
        $plazoTO = new PlazoTO();
        $plazoTO->setPlazo(12);
        $plazoTO->setDescripcion('Plazo Test');
        $plazoTO->setTasaNormal(1);
        $plazoTO->setTasaPuntual(1);
        $plazoTO->setUsuarioId($usuario->id);
        $plazoRepository = resolve(PlazoRepositoryInterface::class);
        $plazoRepository->guardarPlazo($plazoTO);
        $plazoTO->setTasaPuntual(9999);
        $plazoRepository->actualizarPlazo($plazoTO);
        $this->assertDatabaseHas('plazos', [
            'id'=>$plazoTO->getId(),
            'tasa_puntual'=>$plazoTO->getTasaPuntual()
        ]);
        Plazo::destroy($plazoTO->getId());
    }

    public function test_verificar_borrado()
    {
        $usuario = User::first();
        $plazoTO = new PlazoTO();
        $plazoTO->setPlazo(12);
        $plazoTO->setDescripcion('Plazo Test');
        $plazoTO->setTasaNormal(1);
        $plazoTO->setTasaPuntual(1);
        $plazoTO->setUsuarioId($usuario->id);
        $plazoRepository = resolve(PlazoRepositoryInterface::class);
        $plazoRepository->guardarPlazo($plazoTO);
        $plazoRepository->eliminarProducto($plazoTO);
        $this->assertDatabaseMissing('plazos', [
            'id'=>$plazoTO->getId(),
        ]);
    }
}
