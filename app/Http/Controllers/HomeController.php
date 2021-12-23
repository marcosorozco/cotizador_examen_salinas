<?php

namespace App\Http\Controllers;

use App\Cotizaciones\Plazos\PlazoRepositoryInterface;
use App\Cotizaciones\Plazos\PlazoTO;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var PlazoRepositoryInterface
     */
    private $plazoRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PlazoRepositoryInterface $plazoRepository)
    {
        $this->middleware('auth');
        $this->plazoRepository = $plazoRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $plazos = $this->plazoRepository->buscarPlazos(new PlazoTO());
        return view(
            'home',
            compact(
                'plazos'
            )
        );
    }
}
