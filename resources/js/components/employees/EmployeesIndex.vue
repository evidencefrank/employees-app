<template>
    <div class="w-full flex flex-col items-center justify-center gap-10">
        <div class="flex flex-row items-center justify-between w-full">
            <div>
                <h1 class="text-3xl font-semibold">Employees</h1>
                <p v-if="employees.length > 0">There are {{ employees.length }} employees</p>
                <p v-else>No employees</p>
            </div>
            <div class="basis-1/2">
                <input type="text" placeholder="Search" v-model="searchQuery" class="w-full h-12 text-white rounded-lg grow">
            </div>
            <div class="w-36">
                <select class="rounded-xl border-none p-0 pl-2 w-full bg-[#110010]" id="filter">
                    <option>Filter By</option>
                    <option>Years Of Experience</option>
                    <option>Rating</option>
                </select>
            </div>
            <div>
                <button @click="addNewEmployee" class="rounded-3xl bg-purple-400 p-3 flex items-center text-white hover:bg-purple-600 text-sm w-auto">
                    <svg class="w-6 h-6 pr-1 fill-white stroke-purple-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>New Employee</span>
                </button>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center w-full gap-8" v-if="searchedEmployees.length > 0">
            <div v-for="(employee, index ) in searchedEmployees" :key="employee.id" class="w-full">
                <div class="text-xl flex flex-row items-center justify-between gap-28 border rounded-2xl bg-stone-400 p-4">
                    <div>
                        <span class="border-2 border-purple-900 p-1 px-3 rounded-full text-purple-900">{{index + 1}}</span>
                    </div>

                    <div>
                        <span>{{employee.first_name}}</span>
                    </div>

                    <div>
                        <span>{{employee.last_name}}</span>
                    </div>

                    <div>
                        <span>{{employee.contact_number}}</span>
                    </div>

                    <div>
                        <span>{{employee.email}}</span>
                    </div>

                    <div>
                        <span>{{employee.uuid}}</span>
                    </div>

                    <div class="flex">
                        <a @click="editEmployee(employee.id)">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <a @click="deleteEmployee(employee.id)">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div v-else class="flex flex-col items-center justify-center w-full gap-8">
            <div>
                <img src="/assets/Icon.JPG" alt="logo">
            </div>
            <p>
                There is nothing here
            </p>
            <p class="text-center">
                Create a new employee by clicking the <br>
                New Employee button to get started
            </p>
        </div>

    </div>
</template>

<script>
import useEmployees from "../../composables/employees";
import {onMounted, ref, computed} from "vue";

export default {
    name: 'EmployeesIndex',
    setup(){
        const { employees, getEmployees, destroyEmployee } = useEmployees();

        onMounted(getEmployees);

        const searchQuery = ref('');

        const deleteEmployee = async(id) => {
            if(!window.confirm('Are you sure you?')) return;

            await destroyEmployee(id);
            await getEmployees();
        };

        async function refreshEmployees () {
            await getEmployees();
        }

        const searchedEmployees = computed(() => {
            if(searchQuery.value === '') return employees.value;

            else return employees.value.filter(
                obj => obj.first_name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                obj.last_name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
                obj.email.toLowerCase().includes(searchQuery.value.toLowerCase())
            );
        });

        return {
            employees,
            searchQuery,
            searchedEmployees,
            refreshEmployees,
            deleteEmployee
        }
    },

    methods: {
        addNewEmployee(){
            this.$emit('addNewEmployee');
        },
        editEmployee(id){
            this.$emit('editEmployee', id);
        }
    }
}
</script>
