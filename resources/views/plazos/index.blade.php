@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Plazos') }}</div>

                    <div class="card-body">


                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Opciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{route('home')}}">Regresar</a></li>
                                <li><a class="dropdown-item" href="{{route('plazos.create')}}">Nuevo Plazo</a></li>
                            </ul>
                        </div>

                        <table class="table table-striped text-center">
                            <thead>
                            <tr>
                                <th scope="col">Plazo</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Tasa Normal</th>
                                <th scope="col">Tasa Puntual</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($plazos as $plazo)
                                <tr>
                                    <td>{{$plazo->plazo}}</td>
                                    <td>{{$plazo->descripcion}}</td>
                                    <td>{{$plazo->tasa_normal}}</td>
                                    <td>{{$plazo->tasa_puntual}}</td>
                                    <td>{{$plazo->user->email}}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{route('plazos.edit', $plazo->id)}}"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <form action="{{route('plazos.destroy', $plazo->id)}}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Sin Datos</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {!! $plazos->links() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
