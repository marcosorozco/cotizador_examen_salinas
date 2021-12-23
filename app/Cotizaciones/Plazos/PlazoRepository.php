<?php


namespace App\Cotizaciones\Plazos;


use App\Models\Plazo;
use Illuminate\Database\Eloquent\Model;

class PlazoRepository implements PlazoRepositoryInterface
{

    public function buscarPlazos(PlazoTO $plazoTO)
    {
        $plazos = Plazo::query();
        if ($plazoTO->getPaginate()) {
            return $plazos->paginate($plazoTO->getPaginate());
        }
        return $plazos->get();
    }

    public function findPlazo(PlazoTO $plazoTO)
    {
        return Plazo::find($plazoTO->getId());
    }

    public function guardarPlazo(PlazoTO $plazoTO)
    {
        $plazo = new Plazo();
        $plazo->plazo = $plazoTO->getPlazo();
        $plazo->descripcion = $plazoTO->getDescripcion();
        $plazo->tasa_normal = $plazoTO->getTasaNormal();
        $plazo->tasa_puntual = $plazoTO->getTasaPuntual();
        $plazo->usuario_id = $plazoTO->getUsuarioId();
        $plazo->save();
        $plazoTO->setId($plazo->id);
    }

    public function actualizarPlazo(PlazoTO $plazoTO)
    {
        $plazo = $this->findPlazo($plazoTO);
        $plazo->plazo = $plazoTO->getPlazo();
        $plazo->descripcion = $plazoTO->getDescripcion();
        $plazo->tasa_normal = $plazoTO->getTasaNormal();
        $plazo->tasa_puntual = $plazoTO->getTasaPuntual();
        $plazo->usuario_id = $plazoTO->getUsuarioId();
        $plazo->save();
    }

    public function eliminarProducto(PlazoTO $plazoTO)
    {
        return Plazo::destroy($plazoTO->getId());
    }
}
