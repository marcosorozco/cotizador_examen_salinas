<?php

namespace App\Http\Controllers\Plazos;

use App\Cotizaciones\Plazos\PlazoRepositoryInterface;
use App\Cotizaciones\Plazos\PlazoTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlazoRequest;
use App\Http\Requests\UpdatePlazoRequest;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class PlazoController extends Controller
{
    /**
     * @var PlazoRepositoryInterface
     */
    private $plazoRepository;

    /**
     * PlazoController constructor.
     */
    public function __construct(PlazoRepositoryInterface $plazoRepository)
    {
        $this->plazoRepository = $plazoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plazoTO = new PlazoTO();
        $plazoTO->setPaginate(5);
        $plazos = $this->plazoRepository->buscarPlazos($plazoTO);
        return view('plazos.index', compact('plazos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plazos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlazoRequest $request)
    {
        $plazoTO = new PlazoTO();
        $plazoTO->setPlazo($request->input('plazo'));
        $plazoTO->setDescripcion($request->input('descripcion'));
        $plazoTO->setTasaNormal($request->input('tasa_normal'));
        $plazoTO->setTasaPuntual($request->input('tasa_puntual'));
        $plazoTO->setUsuarioId(auth()->id());
        try {
            $this->plazoRepository->guardarPlazo($plazoTO);
        } catch (\Exception $error) {
            return redirect()->back()->withInput()->with('message', $error->getMessage());
        }
        return redirect()->route('plazos.index')->with('success', 'plazo guardado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plazoTO = new PlazoTO();
        $plazoTO->setId($id);
        $plazo = $this->plazoRepository->findPlazo($plazoTO);
        return view(
            'plazos.edit',
            compact(
                'plazo'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlazoRequest $request, $id)
    {
        $plazoTO = new PlazoTO();
        $plazoTO->setId($id);
        $plazoTO->setPlazo($request->input('plazo'));
        $plazoTO->setDescripcion($request->input('descripcion'));
        $plazoTO->setTasaNormal($request->input('tasa_normal'));
        $plazoTO->setTasaPuntual($request->input('tasa_puntual'));
        $plazoTO->setUsuarioId(auth()->id());
        try {
            $this->plazoRepository->actualizarPlazo($plazoTO);
        } catch (\Exception $error) {
            return redirect()->back()->withInput()->with('message', $error->getMessage());
        }
        return redirect()->route('plazos.index')->with('success', 'plazo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plazoTO = new PlazoTO();
        $plazoTO->setId($id);
        try {
            $this->plazoRepository->eliminarProducto($plazoTO);
        } catch (\Exception $error) {
            return redirect()->back()->withInput()->with('message', $error->getMessage());
        }
        return redirect()->route('plazos.index')->with('success', 'plazo eliminado correctamente');
    }
}
