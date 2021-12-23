<?php


namespace App\Cotizaciones\Plazos;


interface PlazoRepositoryInterface
{

    public function buscarPlazos(PlazoTO $plazoTO);

    public function findPlazo(PlazoTO $plazoTO);

    public function guardarPlazo(PlazoTO $plazoTO);

    public function actualizarPlazo(PlazoTO $plazoTO);

    public function eliminarProducto(PlazoTO $plazoTO);
}
