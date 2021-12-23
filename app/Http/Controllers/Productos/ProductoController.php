<?php

namespace App\Http\Controllers\Productos;

use App\Cotizaciones\Productos\ProductoRepositoryInterface;
use App\Cotizaciones\Productos\ProductoTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * @var ProductoRepositoryInterface
     */
    private $productoRepository;

    /**
     * ProductoController constructor.
     */
    public function __construct(ProductoRepositoryInterface $productoRepository)
    {
        $this->productoRepository = $productoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productoTO = new ProductoTO();
        $productoTO->setPaginate(5);
        $productos = $this->productoRepository->buscarProductos($productoTO);
        return view(
            'productos.index',
            compact('productos')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductoRequest $request)
    {
        $productoTO = new ProductoTO();
        $productoTO->setSku($request->input('sku'));
        $productoTO->setDescripcion($request->input('descripcion'));
        $productoTO->setPrecio($request->input('precio'));
        $productoTO->setUsuarioId(auth()->id());
        try {
            $this->productoRepository->guardarProducto($productoTO);
        } catch (\Exception $error) {
            return redirect()->back()->with('message', $error->getMessage());
        }
        return redirect()->route('productos.index')->with('success'. 'Producto guardado correctamente');
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
        $productoTO = new ProductoTO();
        $productoTO->setId($id);
        $producto = $this->productoRepository->findProducto($productoTO);
        return view(
            'productos.edit',
            compact(
                'producto'
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
    public function update(UpdateProductoRequest $request, $id)
    {
        $productoTO = new ProductoTO();
        $productoTO->setId($id);
        $productoTO->setSku($request->input('sku'));
        $productoTO->setDescripcion($request->input('descripcion'));
        $productoTO->setPrecio($request->input('precio'));
        $productoTO->setUsuarioId(auth()->id());
        try {
            $this->productoRepository->actualizarProducto($productoTO);
        } catch (\Exception $error) {
            return redirect()->back()->with('message', $error->getMessage());
        }
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productoTO = new ProductoTO();
        $productoTO->setId($id);
        try {
            $this->productoRepository->eliminarProducto($productoTO);
        } catch (\Exception $error) {
            return redirect()->back()->with('message', $error->getMessage());
        }
        return redirect()->route('productos.index')->with('success'. 'Elemento eliminado');
    }

    public function autocompletar($query, Request $request)
    {
        return response()->json($this->productoRepository->autocompletarProducto($query));
        $json = ['status' => 'ok', 'message' => 'busqueda exitosa', 'data' => []];
        try {
            $json['data']['productos'] = $this->productoRepository->autocompletarProducto($query);
        } catch (\Exception $error) {
            $json['status'] = 'error';
            $json['message'] = $error->getMessage();
        }
        return response()->json($json);
    }
}
