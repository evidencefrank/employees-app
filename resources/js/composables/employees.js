import { ref } from 'vue';
import axios from 'axios';

export default function useEmployees(){
    const employees = ref([]);

    const getEmployees = async () => {
        let response = await axios.get('/employees');
        employees.value = response.data.data;
    }

    const destroyEmployee = async (id) => {
        await axios.delete('/employees/' + id);
    }

    return {
        employees,
        getEmployees,
        destroyEmployee
    }
}
