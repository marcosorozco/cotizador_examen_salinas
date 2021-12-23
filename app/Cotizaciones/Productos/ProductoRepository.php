<?php


namespace App\Cotizaciones\Productos;


use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductoRepository implements ProductoRepositoryInterface
{

    public function buscarProductos(ProductoTO $productoTO)
    {
        $productos = Producto::query();
        if ($productoTO->getPaginate()) {
            return $productos->paginate($productoTO->getPaginate());
        }
        return $productos->get();
    }

    public function guardarProducto(ProductoTO $productoTO)
    {
        $producto = new Producto();
        $producto->sku = $productoTO->getSku();
        $producto->descripcion = $productoTO->getDescripcion();
        $producto->usuario_id = $productoTO->getUsuarioId();
        $producto->precio = $productoTO->getPrecio();
        $producto->save();
        $productoTO->setId($producto->id);
    }

    public function findProducto(ProductoTO $productoTO)
    {
        return Producto::find($productoTO->getId());
    }

    public function actualizarProducto(ProductoTO $productoTO)
    {
        $producto = $this->findProducto($productoTO);
        $producto->sku = $productoTO->getSku();
        $producto->descripcion = $productoTO->getDescripcion();
        $producto->usuario_id = $productoTO->getUsuarioId();
        $producto->precio = $productoTO->getPrecio();
        $producto->save();
    }

    public function eliminarProducto(ProductoTO $productoTO)
    {
        Producto::destroy($productoTO->getId());
    }

    public function autocompletarProducto($query)
    {
        return Producto::where(DB::raw('concat(sku, " ",descripcion)'), 'like', '%'.$query.'%')
            ->get()
            ->map(
                function ($elemento) {
                    return [
                        'id'=>$elemento->id,
                        'valor'=>$elemento->sku." ".$elemento->descripcion,
                        'sku'=>$elemento->sku,
                        'descripcion' => $elemento->descripcion,
                        'precio'=>$elemento->precio
                    ];
                }
            )
            ->toArray();
    }
}
