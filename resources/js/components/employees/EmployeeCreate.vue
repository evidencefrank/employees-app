<template>
    <div class="flex flex-col items-start justify-start py-4 px-6 h-full">
        <div @click="closeForm" class="w-10 h-10 text-gray-600 flex items-center justify-center absolute top-0 right-0 mt-2 mr-12">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </div>
        <div class="mb-4">
            <h1 class="text-md font-semibold">New Employee</h1>
        </div>

        <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
            <p v-html="errors"></p>
        </div>
        <div class="mt-2 mb-6 text-sm text-green-600" v-if="successStatus !== ''">
            <p v-html="successStatus"></p>
        </div>

        <div class="overflow-scroll h-5/6">
            <form @submit.prevent="saveEmployee">

                <div>
                    <label class="text-sm font-semibold text-purple-400" for="">Basic Info</label>
                </div>
                <div class="flex flex-col items-start justify-center gap-2 mb-6">
                    <div class="flex flex-row items-center justify-between gap-4">
                        <div class="basis-48">
                            <label for="first_name" class="text-sm font-semibold">First Name</label>
                            <input type="text" v-model="form.first_name" name="first_name" id="first_name" class="w-full rounded-lg grow">
                        </div>
                        <div>
                            <label for="last_name" class="text-sm font-semibold">Last Name</label>
                            <input type="text" v-model="form.last_name" name="last_name" id="last_name" class="w-full rounded-lg grow">
                        </div>
                    </div>
                    <div class="flex flex-row items-center justify-between w-full">
                        <div class="w-full">
                            <label for="contact_number" class="text-sm font-semibold">Contact Number</label>
                            <input type="text" v-model="form.contact_number" name="contact_number" id="contact_number" class="w-full rounded-lg grow">
                        </div>
                    </div>
                    <div class="flex flex-row items-center justify-between w-full">
                        <div class="w-full">
                            <label for="email" class="text-sm font-semibold">Email</label>
                            <input type="text" v-model="form.email" name="email" id="email"  class="w-full rounded-lg grow">
                        </div>
                    </div>

                    <div class="flex flex-row items-center justify-between w-2/5">
                        <div class="w-full">
                            <label for="email" class="text-sm font-semibold">Date of Birth</label>
                            <input type="date" v-model="form.date_of_birth" name="date_of_birth" id="date_of_birth" class="w-full rounded-lg grow">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="text-sm font-semibold text-purple-400" for="">Address Info</label>
                </div>
                <div class="flex flex-col items-start justify-center gap-2 mb-6">
                    <div class="flex flex-row items-center justify-between gap-8 w-full">
                        <div class="w-full">
                            <label for="address" class="text-sm font-semibold">Address Street</label>
                            <input type="text" v-model="form.address" name="address" id="address"  class="w-full rounded-lg grow">
                        </div>
                    </div>
                    <div class="flex flex-row items-center justify-between gap-2 w-full">
                        <div class="w-full">
                            <label for="city" class="text-sm font-semibold">City</label>
                            <input type="text" v-model="form.city" name="city" id="city" class="w-full rounded-lg grow">
                        </div>
                        <div class="w-full">
                            <label for="postal_code" class="text-sm font-semibold">Postal Code</label>
                            <input type="text" v-model="form.postal_code" name="postal_code" id="postal_code"  class="w-full rounded-lg grow">
                        </div>
                        <div class="w-full">
                            <label for="country" class="text-sm font-semibold">Country</label>
                            <input type="text" v-model="form.country" name="country" id="country" class="w-full rounded-lg grow">
                        </div>

                    </div>
                </div>

                <div>
                    <label class="text-sm font-semibold text-purple-400" for="">Skills</label>
                </div>

                <div class="flex flex-col items-start justify-center gap-2 mb-6 w-full">
                    <div class="flex flex-row items-center justify-between gap-4 w-full">
                        <div class="w-2/6">
                            <label for="skill_name" class="text-sm font-semibold">Skill</label>
                        </div>
                        <div class="w-1/6">
                            <label for="skill_level" class="text-sm font-semibold">Yrs Exp</label>
                        </div>
                        <div class="w-2/6">
                            <label for="skill_level" class="text-sm font-semibold">Seniority Rating</label>
                        </div>
                        <div class="w-1/6">
                            &nbsp;
                        </div>
                    </div>
                    <div class="flex flex-row items-center justify-between gap-4 w-full" v-for="(skill, index) in form.skills" :key="index">
                        <div class="w-2/6">
                            <input type="text" v-model="skill.name" name="name" id="name" class="w-full rounded-lg grow">
                        </div>
                        <div class="w-1/6">
                            <input type="text" v-model="skill.years_of_experience" name="years_of_experience" id="years_of_experience" class="w-full rounded-lg grow">
                        </div>
                        <div class="w-2/6">
                            <select class="rounded-xl p-0 pl-2" id="rating" v-model="skill.rating">
                                <option>Beginner</option>
                                <option>Expert</option>
                            </select>
                        </div>
                        <div @click="removeSkill(skill.index)" class="w-1/6 text-right">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </div>
                    </div>
                    <button type="button" @click="AddField" class="w-full bg-gray-400 rounded-lg h-9">
                        + Add New Skill
                    </button>
                </div>

                <div class="absolute bottom-4 right-6">
                    <button type="submit" class="rounded-3xl bg-purple-400 h-12 w-36 p-4 flex items-center text-white hover:bg-purple-600 text-sm w-auto">
                        <svg class="w-6 h-6 pr-1 fill-white stroke-purple-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Save and Add Employee</span>
                    </button>
                </div>

            </form>

        </div>


    </div>
</template>

<script>
import { reactive, ref} from 'vue';
import useEmployees from "../../composables/employees";
export default {
    name: 'EmployeeCreate',
    setup(props, {emit}) {
        const initialState = {
            first_name: '',
            last_name: '',
            email: '',
            date_of_birth: '',
            address: '',
            contact_number: '',
            city: '',
            postal_code: '',
            country: '',
            skills: [{
                index: 1,
                name: '',
                years_of_experience: '',
                rating: ''
            }]
        };


        const count = ref(2);

        const form = reactive({...initialState});

        function resetForm() {
            Object.assign(form, initialState);
            form.skills = [{
                index: 1,
                name: '',
                years_of_experience: '',
                rating: ''
            }];
        }

        const {errors, successStatus, storeEmployee, getEmployees } = useEmployees();

        const saveEmployee = async () => {
            await storeEmployee({...form});
            await getEmployees();
        };

        const closeForm = () => {
            resetForm();
            emit('closeForm');
        };

        return {
            form,
            count,
            errors,
            successStatus,
            closeForm,
            saveEmployee
        }
    },

    methods: {
        AddField(){
            this.form.skills.push({
                index: this.count++,
                name: '',
                years_of_experience: '',
                rating: ''
            });
        },

        removeSkill(index){
            this.form.skills = this.form.skills.filter(skill => skill.index !== index);
        },
    }
}
</script>
