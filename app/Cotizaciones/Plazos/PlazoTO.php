<?php


namespace App\Cotizaciones\Plazos;


class PlazoTO
{
    private $id;
    private $descripcion;
    private $tasa_normal;
    private $tasa_puntual;
    private $usuario_id;
    private $paginate;
    private $plazo;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getTasaNormal()
    {
        return $this->tasa_normal;
    }

    /**
     * @param mixed $tasa_normal
     */
    public function setTasaNormal($tasa_normal): void
    {
        $this->tasa_normal = $tasa_normal;
    }

    /**
     * @return mixed
     */
    public function getTasaPuntual()
    {
        return $this->tasa_puntual;
    }

    /**
     * @param mixed $tasa_puntual
     */
    public function setTasaPuntual($tasa_puntual): void
    {
        $this->tasa_puntual = $tasa_puntual;
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * @param mixed $usuario_id
     */
    public function setUsuarioId($usuario_id): void
    {
        $this->usuario_id = $usuario_id;
    }

    /**
     * @return mixed
     */
    public function getPaginate()
    {
        return $this->paginate;
    }

    /**
     * @param mixed $paginate
     */
    public function setPaginate($paginate): void
    {
        $this->paginate = $paginate;
    }

    /**
     * @return mixed
     */
    public function getPlazo()
    {
        return $this->plazo;
    }

    /**
     * @param mixed $plazo
     */
    public function setPlazo($plazo): void
    {
        $this->plazo = $plazo;
    }
}
