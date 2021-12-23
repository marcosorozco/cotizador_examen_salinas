@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Plazo') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('plazos.update', $plazo->id) }}">
                            @method('PUT')
                            @include('plazos.form_create_edit')
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
