import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);


export default new Vuex.Store({
    state: {
        cafes: [],
        restaurantes: [],
        hoteles: [],
        establecimiento: {}
    },
    mutations: {
        AGREGAR_CAFES(state, cafes){
            state.cafes = cafes;
        },
        AGREGAR_RESTAURANT(state, restaurants){
            state.restaurantes = restaurants;
        },
        AGREGAR_HOTELES(state, hoteles){
            state.hoteles = hoteles;
        },
        AGREGAR_ESTABLECIMIENTO(state, establecimiento){
            state.establecimiento = establecimiento;
        }
    },
    getters: {
        obtenerEstablecimiento: state => {
            return state.establecimiento
        }
    }
})
