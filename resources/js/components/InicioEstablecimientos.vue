<template>
<div>
   <categoria-cafe></categoria-cafe>
   <categoria-restaurant></categoria-restaurant>
   <categoria-hoteles></categoria-hoteles>
</div>
</template>

<script>
import CategoriaCafe from './CategoriaCafe';
import CategoriaHoteles from './CategoriaHoteles.vue';
import CategoriaRestaurant from './CategoriaRestaurant';

export default {
    components: {
        CategoriaCafe,
        CategoriaRestaurant,
        CategoriaHoteles
    }
}
</script>
