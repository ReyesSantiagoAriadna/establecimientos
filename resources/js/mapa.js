import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();

document.addEventListener('DOMContentLoaded', () => {

    if (document.querySelector('#mapa')) {
        const lat = document.querySelector('#lat').value === '' ? 17.060729 : document.querySelector('#lat').value;
        const lng = document.querySelector('#lng').value === '' ? -96.7317606 : document.querySelector('#lng').value;
        const apikey = "AAPKe683b484dd044a41b1d39c5a5dae0a6aHrp5xGfOuWfDANwICfjp0-USxW6FX1j8R-r_LjI5En9sx_eNg9r7Mflc__wuTvgX";

        const mapa = L.map('mapa').setView([lat, lng], 16);

        //eliminar pines previos
        let markers = new L.FeatureGroup().addTo(mapa);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        // agregar el pin
        marker = new L.marker([lat, lng],{
            draggable: true, //mover marcador
            autoPan: true,   //mover marcador y mapa
        }).addTo(mapa);

        markers.addLayer(marker);

        //geocode service
       // const geocodeService = L.esri.Geocoding.geocodeService();

        var geocodeService = L.esri.Geocoding.geocodeService({
            apikey: apikey
        });

        //Buscador de direcciones
        const buscador = document.querySelector('#formBuscador');
        buscador.addEventListener('blur', buscarDireccion);

        reubicarPin(marker);

        function reubicarPin(marker){
             //detectar movimiento del marker
            marker.on('moveend', function(e){
                //console.log('soltaste el pin');
                marker = e.target;

                //console.log(marker.getLatLng());
                const posicion = marker.getLatLng()

                console.log(posicion);

                //centrar automaticamente el mapa
                mapa.panTo(new L.LatLng( posicion.lat, posicion.lng));

                //Reverse Geocoding, cuando el usuario reubica el pin
                geocodeService.reverse().latlng(posicion,16).run(function(error,resultado){
                    //console.log(error);

                    //console.log(resultado.address);

                    marker.bindPopup(resultado.address.LongLabel);
                    marker.openPopup();

                    //llenar los campos
                    llenarInputs(resultado);
                })

            });

        }


        function buscarDireccion(e){
            if (e.target.value.length > 1) {
                provider.search({query: e.target.value + ' Oaxaca MX '})
                    .then(resultado => {
                        if (resultado) {
                            //limpiar lo pines previos
                            markers.clearLayers();

                            //console.log(resultado[0].bounds[0])
                            geocodeService.reverse().latlng(resultado[0].bounds[0],16).run(function(error,resultado){
                                //llenar los campos
                                llenarInputs(resultado);

                                //centrar el mapa
                                mapa.setView(resultado.latlng)

                                //agregar el pin
                                marker = new L.marker(resultado.latlng,{
                                    draggable: true, //mover marcador
                                    autoPan: true,   //mover marcador y mapa
                                }).addTo(mapa);

                                //asignar el contenido de markers  al nuevo pin
                                markers.addLayer(marker);

                                //mover el pin
                                reubicarPin(marker);
                            })
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }

        function llenarInputs(resultado){
            document.querySelector('#direccion').value = resultado.address.Address || '';
            document.querySelector('#colonia').value = resultado.address.Neighborhood || '';
            document.querySelector('#lat').value = resultado.latlng.lat || '';
            document.querySelector('#lng').value = resultado.latlng.lng || '';

        }
    }
});
