<?php


namespace App\Cotizaciones\Productos;


interface ProductoRepositoryInterface
{

    public function buscarProductos(ProductoTO $productoTO);

    public function guardarProducto(ProductoTO $productoTO);

    public function findProducto(ProductoTO $productoTO);

    public function actualizarProducto(ProductoTO $productoTO);

    public function eliminarProducto(ProductoTO $productoTO);

    public function autocompletarProducto($query);
}
