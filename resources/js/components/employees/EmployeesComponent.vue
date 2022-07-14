<template>
    <div class="flex pt-24 pb-24 items-start justify-center text-white">
        <div class="w-full container">
            <employees-index @addNewEmployee="addNewEmployee" @editEmployee="editEmployee" ref="indexComponent"></employees-index>
        </div>

        <div id="slide-over-container" class="fixed inset-0 w-full h-full" :class="[isSlideOverOpen ? '' : 'invisible']">
            <div id="slide-over-bg" class="absolute duration-500 ease-out transition-all inset-0 w-full h-full bg-gray-900" :class="[isSlideOverOpen ? 'opacity-50' : 'opacity-0']"></div>
            <div id="slide-over" class="absolute w-1/3 rounded-[60px] duration-500 ease-out h-full bg-gray-700 left-2 top-0" :class="[isSlideOverOpen ? '' : '-translate-x-full']">

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
