import './bootstrap';

//Vue Init
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import EmployeesComponent from "./components/employees/EmployeesComponent.vue";

createApp({
    components: {
        EmployeesComponent,
    }
}).mount('#app');
