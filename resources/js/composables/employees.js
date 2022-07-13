import { ref } from 'vue';
import axios from 'axios';

export default function useEmployees(){
    const employees = ref([]);
    const employee = ref([]);

    const errors = ref('');

    const getEmployees = async () => {
        let response = await axios.get('/employees');
        employees.value = response.data.data;
    }

    const getEmployee = async (id) => {
        let response = await axios.get('/employees/' + id);
        employee.value = response.data.data;
    }


    const storeEmployee = async (data) => {
        errors.value = '';
        try {
            await axios.post('/employees/', data);
        } catch (e) {
            if(e.response.status === 422){
                for(const key in e.response.data.errors){
                    errors.value += e.response.data.errors[key][0] + '<br>';
                }
            }
        }

    }
    const updateEmployee = async (id) => {
            errors.value = '';
            try {
                await axios.put('/employees/' + id, employee.value);
            } catch (e) {
                if(e.response.status === 422){
                    for(const key in e.response.data.errors){
                        errors.value += e.response.data.errors[key][0] + '<br>';
                    }
                }
            }

        }

    const destroyEmployee = async (id) => {
        await axios.delete('/employees/' + id);
    }

    return {
        employees,
        employee,
        errors,
        getEmployees,
        getEmployee,
        storeEmployee,
        updateEmployee,
        destroyEmployee
    }
}
