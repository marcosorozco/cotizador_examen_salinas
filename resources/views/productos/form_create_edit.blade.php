
@csrf

<div class="row mb-3">
    <label for="sku" class="col-md-4 col-form-label text-md-right">{{ __('Sku') }}</label>

    <div class="col-md-6">
        <input id="sku"
               type="text"
               class="form-control @error('sku') is-invalid @enderror"
               name="sku"
               value="{{ old('sku', $producto->sku ?? null) }}"
               required
               autocomplete="sku" autofocus>

        @error('sku')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

    <div class="col-md-6">
        <input id="descripcion"
               type="text"
               class="form-control @error('descripcion') is-invalid @enderror"
               name="descripcion"
               value="{{old('descripcion', $producto->descripcion ?? null)}}"
               required autocomplete="current-password">

        @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="precio" class="col-md-4 col-form-label text-md-right">{{ __('Precio') }}</label>

    <div class="col-md-6">
        <input id="precio"
               type="number"
               step="any"
               class="form-control @error('precio') is-invalid @enderror"
               name="precio"
               value="{{old('precio', $producto->precio ?? null)}}"
               required autocomplete="current-password">

        @error('precio')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-0">
    <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Guardar') }}
        </button>
    </div>
</div>
