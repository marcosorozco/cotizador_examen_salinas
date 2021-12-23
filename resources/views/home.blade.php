@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">


                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Configuracion
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{route('productos.index')}}">Productos</a></li>
                            <li><a class="dropdown-item" href="{{route('plazos.index')}}">Plazos</a></li>
                        </ul>
                    </div>


                    <br>

                    <div class="row mb-3">
                        <label for="producto"
                               class="col-md-4 col-form-label text-md-right text-right">{{ __('Producto') }}</label>

                        <div class="col-md-6">
                            <input id="Producto"
                                   type="text"
                                   class="form-control typeahead"
                                   name="sku"
                                   value=""
                                   required
                                   autocomplete="off" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="plazo_id"
                               class="col-md-4 col-form-label text-md-right text-right">{{ __('Plazo') }}</label>

                        <div class="col-md-6">
                            <select class="form-control select_plazo" name="plazo_id" id="">
                                <option value="">seleccione</option>
                                @foreach($plazos as $plazo)
                                    <option value="{{$plazo->id}}">{{$plazo->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="alert alert-danger alert_datos_incompletos" role="alert">
                            Es necesario seleccionar producto y plazo!!
                        </div>
                    </div>

                    <div class="row mb-3">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <td>Sku</td>
                                    <td>Producto</td>
                                    <td>Plazo</td>
                                    <td>Precio</td>
                                    <td>T. Normal</td>
                                    <td>Abono Normal</td>
                                    <td>T. Puntual</td>
                                    <td>Abono Puntual</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="table_sku"></td>
                                    <td id="table_producto"></td>
                                    <td id="table_plazo"></td>
                                    <td id="table_precio"></td>
                                    <td id="table_tasa_normal"></td>
                                    <td id="table_precio_normal"></td>
                                    <td id="table_tasa_puntual"></td>
                                    <td id="table_precio_puntual"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js" crossorigin="anonymous"></script>
    <script>
        var plazos = {!! $plazos->keyBy('id') !!};
        function calcularAbonos() {
            var precio = parseFloat($("#table_precio").text());
            var tasa_normal = parseFloat($("#table_tasa_normal").text());
            var tasa_puntual = parseFloat($("#table_tasa_puntual").text());
            var plazo = parseFloat($("#table_plazo").text());
            $("#table_precio_normal").html( Math.round((((precio*tasa_normal)+precio)/plazo) * 100)/ 100);
            $("#table_precio_puntual").html( Math.round((((precio*tasa_puntual)+precio)/plazo)*100)/100);
        }
        $(
            function () {
                var productos = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    //remote: '{{route('productos.autocompletar', ['query'=>''])}}'+'/%QUERY'
                    remote: {
                        url: '{{route('productos.autocompletar', ['query'=>''])}}/%QUERY',
                        wildcard: '%QUERY'
                    }
                });

                $('.typeahead').typeahead({
                    minLength :3,
                    highlight : true
                }, {
                    name: 'productos',
                    display: 'valor',
                    source: productos
                }).on('typeahead:selected', function(obj, datum, name ){
                    console.log(datum);
                    $('#table_sku').html(datum.sku);
                    $('#table_producto').html(datum.descripcion);
                    $('#table_precio').html(datum.precio);
                    if ($("#table_tasa_normal").text() && $("#table_sku").text()) {
                        calcularAbonos();
                        $('.alert_datos_incompletos').css('display', 'none');
                    } else {
                        $('.alert_datos_incompletos').css('display', 'block');
                    }
                }).on('focus',function(){
                    $("#table_sku").html("");
                    $("#table_producto").html("");
                    $("#table_precio").html("");
                    $("#table_precio_normal").html("");
                    $("#table_precio_puntual").html("");
                    $(this).val("");
                });

                $(document).on('click', '.btn-outline-primary', function () {
                    console.log('click en boton');
                } );

                $(document).on('change', '.select_plazo', function () {
                    var plazo_id = $(this).val();
                    $("#table_plazo").html("");
                    $("#table_tasa_normal").html("");
                    $("#table_tasa_puntual").html("");
                    $("#table_precio_normal").html("");
                    $("#table_precio_puntual").html("");
                    if (plazo_id) {
                        var plazo = plazos[plazo_id];
                        $("#table_plazo").html(plazo.plazo);
                        $("#table_tasa_normal").html(plazo.tasa_normal);
                        $("#table_tasa_puntual").html(plazo.tasa_puntual);
                        console.log('valor sku '+$("#table_sku").text());
                        console.log('valor tasa '+$("#table_tasa_normal").text());
                        if ($("#table_tasa_normal").text() && $("#table_sku").text()) {
                            calcularAbonos();
                            $('.alert_datos_incompletos').css('display', 'none');
                        } else {
                            $('.alert_datos_incompletos').css('display', 'block');
                        }
                    }
                } );
            }
        );
    </script>
@endsection
