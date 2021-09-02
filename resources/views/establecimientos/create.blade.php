@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

    <link
        rel="stylesheet"
        href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
    />
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Registrar establecimiento</h1>

        <div class="mt-5 row justify-content-center">
            <form action="" class="col-md-9 col-xs-12 card card-body">
                <fieldset class="border p-4">
                    <legend class="text-primary">Nombre, Categoría e Imagen Principal</legend>

                    <div class="form-group">
                        <label for="nombre">Nombre establecimiento</label>
                        <input
                            id="nombre" type="text"
                            class="form-control @error('nombre') is-invalid @enderror"
                            placeholder="Nombre Establecimiento"
                            name="nombre"
                            value="{{ old('nombre') }}"
                        >

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categoria_id">Categoría</label>

                        <select class="form-control @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id">
                            <option value="" selected disabled>--- Seleccione --</option>

                            @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}"
                                    {{ old('categoria_id')  == $categoria->id ? 'selected' : '' }}
                                >{{$categoria->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="imagen_principal">Imagen Principal</label>
                        <input
                            id="imagen_principal" type="file"
                            class="form-control @error('imagen_principal') is-invalid @enderror"
                             name="imagen_principal"
                            value="{{ old('imagen_principal') }}"
                        >

                        @error('imagen_principal')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                </fieldset>

                <fieldset class="border p-4">
                    <legend class="text-primary">Ubicación: </legend>

                    <div class="form-group">
                        <label for="formBuscador">Coloca la dirección del Establecimiento</label>
                        <input
                            id="formBuscador" type="text"
                            placeholder="Calle del Establecimiento"
                            class="form-control"
                        >
                        <p class="text-secondary mt-5 mb-3 text-center">
                            El asistente colocará una dirección estimada o mueve el Pin hacia el lugar correcto
                        </p>
                    </div>

                    <div class="form-group">
                        <div id="mapa" style="height: 400px"></div>
                    </div>

                    <p class="informacion">Confirma que los siguientes campos son correctos</p>

                    <div class="form-group">
                        <label for="direccion">Direcciíon</label>
                        <input type="text" id="direccion"
                              class="form-control @error('direccon') is-invalid @enderror"
                              placeholder="Dirección"
                              value="{{ old('direccion') }}"
                        >
                        @error('direccion')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="colonia">Colonia</label>
                        <input type="text" id="colonia"
                              class="form-control @error('colonia') is-invalid @enderror"
                              placeholder="Colonia"
                              value="{{ old('Colonia') }}"
                        >
                        @error('colonia')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <input type="hidden" id="lat" name="lat" value="{{ old('lat') }}">
                    <input type="hidden" id="lng" name="lng" value="{{ old('lng') }}">
                </fieldset>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    <script src="https://unpkg.com/esri-leaflet" defer></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>


@endsection
