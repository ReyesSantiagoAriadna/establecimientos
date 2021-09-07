<template>
<div class="container my-5">
    <h2 class="text-center mb-5">{{establecimiento.nombre}}</h2>

    <div class="row aling-items-start">
        <div class="col-md-8">
            <img :src="`../storage/${establecimiento.imagen_principal}`" class="img-fluid" alt="imagen establecimiento">
            <p class="mt-3">{{establecimiento.descripcion}}</p>
        </div>

        <aside class="col-md-4">
            <div></div>

            <div class="p-4">
                <h2 class="text-center  mt-2 mb-4">Más información</h2>

                <p class="text-white mt-1">
                    <span class="font-wight-bold">Ubicación</span>
                    {{establecimiento.direccion}}
                </p>

                <p class="text-white mt-1">
                    <span class="font-wight-bold">Colonia</span>
                    {{establecimiento.colonia}}
                </p>

                <p class="text-white mt-1">
                    <span class="font-wight-bold">Horario</span>
                    {{establecimiento.apertura}} - {{establecimiento.cierre}}
                </p>

                <p class="text-white mt-1">
                    <span class="font-wight-bold">Teléfono</span>
                    {{establecimiento.telefono}}
                </p>
            </div>
        </aside>
    </div>
</div>
</template>

<script>
export default {
    mounted(){
        //console.log(this.$route.params)

        const {id} = this.$route.params;

        axios.get('/api/establecimientos/' + id)
            .then(respuesta => {
                //console.log(respuesta.data)
                this.$store.commit("AGREGAR_ESTABLECIMIENTO", respuesta.data);
            })
    },
    computed: {
        establecimiento(){
            return this.$store.getters.obtenerEstablecimiento;
        }
    }
}
</script>
