<template>
    <div class="flex pt-24 pb-24 items-start justify-center text-white">
        <div class="w-full container">
            <employees-index @addNewEmployee="addNewEmployee" @editEmployee="editEmployee" ref="indexComponent"></employees-index>
        </div>

        <div id="slide-over-container" class="fixed inset-0 w-full h-full" :class="[isSlideOverOpen ? '' : 'invisible']">
            <div id="slide-over-bg" class="absolute duration-500 ease-out transition-all inset-0 w-full h-full bg-gray-900" :class="[isSlideOverOpen ? 'opacity-50' : 'opacity-0']"></div>
            <div id="slide-over" class="absolute w-1/3 rounded-[60px] duration-500 ease-out h-full bg-gray-700 left-2 top-0" :class="[isSlideOverOpen ? '' : '-translate-x-full']">
<!--                <div @click="isSlideOverOpen = !isSlideOverOpen" class="w-10 h-10 text-gray-600 flex items-center justify-center absolute top-0 right-0 mt-2 mr-12">-->
<!--                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>-->
<!--                </div>-->

                <employee-create v-if="isCreate" @closeForm="closeForm"></employee-create>
                <employee-edit v-else :id="employeeId" @closeForm="closeForm"></employee-edit>

            </div>
        </div>

    </div>
</template>

<script>

import EmployeesIndex from "./EmployeesIndex.vue";
import EmployeeCreate from "./EmployeeCreate.vue";
import EmployeeEdit from "./EmployeeEdit.vue";

export default {
    components: {
        EmployeesIndex,
        EmployeeCreate,
        EmployeeEdit
    },
    data() {
        return {
            isSlideOverOpen: false,
            title: 'Slide-over',
            count: 0,
            employeeId: null,
            isCreate: true,
        }
    },
    methods: {
        addNewEmployee() {
            this.isCreate = true;
            this.isSlideOverOpen = true;
        },
        editEmployee(id) {
            console.log(id);
            this.employeeId = id;
            this.isCreate = false;
            this.isSlideOverOpen = true;
        },
        closeForm() {
            this.$refs.indexComponent.refreshEmployees();
            this.isSlideOverOpen = false;
        }
    }
}
</script>
