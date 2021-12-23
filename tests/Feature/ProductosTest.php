<?php

namespace Tests\Feature;

use App\Cotizaciones\Productos\ProductoRepositoryInterface;
use App\Cotizaciones\Productos\ProductoTO;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductosTest extends TestCase
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
            ->get(route('productos.index'));

        $response->assertStatus(200);
    }

    public function test_check_create()
    {
        $usuario = User::first();
        $response = $this->actingAs($usuario)
            ->get(route('productos.create'));

        $response->assertStatus(200);
    }

    public function test_check_edit()
    {
        $usuario = User::first();
        $producto = Producto::first();
        $response = $this->actingAs($usuario)
            ->get(route('productos.edit', $producto->id));

        $response->assertStatus(200);
    }


    public function test_verificar_guardado()
    {
        $usuario = User::first();
        $productoTO = new ProductoTO();
        $productoTO->setSku('XXXXXXXXX');
        $productoTO->setDescripcion('XXXXXXXXX');
        $productoTO->setPrecio(99.9);
        $productoTO->setUsuarioId($usuario->id);

        $productoRepository = resolve(ProductoRepositoryInterface::class);
        $productoRepository->guardarProducto($productoTO);
        $this->assertNotEquals($productoTO->getId(), null);
        Producto::destroy($productoTO->getId());
    }

    public function test_verificar_actualizacion()
    {
        $usuario = User::first();
        $productoTO = new ProductoTO();
        $productoTO->setSku('XXXXXXXXX');
        $productoTO->setDescripcion('XXXXXXXXX');
        $productoTO->setPrecio(99.9);
        $productoTO->setUsuarioId($usuario->id);

        $productoRepository = resolve(ProductoRepositoryInterface::class);
        $productoRepository->guardarProducto($productoTO);

        $productoTO->setSku($productoTO->getSku().'9');
        $productoRepository->actualizarProducto($productoTO);
        $this->assertDatabaseHas('productos', [
            'id'=>$productoTO->getId(),
            'sku'=>$productoTO->getSku()
        ]);
        Producto::destroy($productoTO->getId());
    }

    public function test_verificar_borrado()
    {
        $usuario = User::first();
        $productoTO = new ProductoTO();
        $productoTO->setSku('XXXXXXXXX');
        $productoTO->setDescripcion('XXXXXXXXX');
        $productoTO->setPrecio(99.9);
        $productoTO->setUsuarioId($usuario->id);

        $productoRepository = resolve(ProductoRepositoryInterface::class);
        $productoRepository->guardarProducto($productoTO);
        $productoRepository->eliminarProducto($productoTO);
        $this->assertDatabaseMissing('productos', [
            'id'=>$productoTO->getId(),
        ]);
    }
}
