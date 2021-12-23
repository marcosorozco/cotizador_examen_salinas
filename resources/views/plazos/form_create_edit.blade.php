
@csrf

<div class="row mb-3">
    <label for="plazo" class="col-md-4 col-form-label text-md-right">{{ __('Plazo') }}</label>

    <div class="col-md-6">
        <input id="plazo"
               type="number"
               step="1"
               class="form-control @error('plazo') is-invalid @enderror"
               name="plazo"
               value="{{old('plazo', $plazo->plazo ?? null)}}"
               required>

        @error('tasa_normal')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="sku" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>

    <div class="col-md-6">
        <input id="descripcion"
               type="text"
               class="form-control @error('descripcion') is-invalid @enderror"
               name="descripcion"
               value="{{ old('descripcion', $plazo->descripcion ?? null) }}"
               required
               autocomplete="descripcion" autofocus>

        @error('sku')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="tasa_normal" class="col-md-4 col-form-label text-md-right">{{ __('Tasa Normal') }}</label>

    <div class="col-md-6">
        <input id="tasa_normal"
               type="number"
               step="any"
               class="form-control @error('tasa_normal') is-invalid @enderror"
               name="tasa_normal"
               value="{{old('tasa_normal', $plazo->tasa_normal ?? null)}}"
               required>

        @error('tasa_normal')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="tasa_puntual" class="col-md-4 col-form-label text-md-right">{{ __('Tasa Puntual') }}</label>

    <div class="col-md-6">
        <input id="tasa_puntual"
               type="number"
               step="any"
               class="form-control @error('tasa_puntual') is-invalid @enderror"
               name="tasa_puntual"
               value="{{old('tasa_puntual', $plazo->tasa_puntual ?? null)}}"
               required>

        @error('tasa_puntual')
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
