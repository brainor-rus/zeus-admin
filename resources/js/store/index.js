import Vue from 'vue';
import Vuex from 'vuex'
import sidebar from './modules/sidebar';
import title from './modules/title';
import options from './modules/options';

import { createFlashStore } from 'vuex-flash';

Vue.use(Vuex);


export default new Vuex.Store({
    modules: {
        options,
        sidebar,
        title
    },
    plugins: [
        createFlashStore()
    ]
});
