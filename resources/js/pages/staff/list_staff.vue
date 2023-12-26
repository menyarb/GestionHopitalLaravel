<!-- ListStaff.vue -->

<template>
    <div class="content">
      <NavbarHorizontale></NavbarHorizontale>
      <NavbarVertical></NavbarVertical>
  
      <!-- List Start -->
      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-15">
            <div class="bg-light rounded h-100 p-4">
              <h6 class="mb-4">Staff List</h6>
              <!-- Display loading or error message -->
          <div v-if="isLoading">Loading...</div>
          <div v-else-if="errorMessage">{{ errorMessage }}</div>
         
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Highest Qualification</th>
                    <th scope="col">Salary</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="staff in staffs" :key="staff.StaffID">
                    <th scope="row">{{ staff.StaffID }}</th>
                    <td>{{ staff.name }}</td>
                    <td>{{ staff.email }}</td>
                    <td>{{ staff.designation }}</td>
                    <td>{{ staff.highestQualification }}</td>
                    <td>{{ staff.salary }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- List End -->
    </div>
  </template>
  
  <script>
  import NavbarVertical from '../../layout/navbar_vertical.vue';
  import NavbarHorizontale from '../../layout/navbar_horizontale.vue';
  import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router'; // Import the useRouter function

  export default {
    components: {
      NavbarHorizontale,
      NavbarVertical,
    },
  
    setup() {
      const staffs = ref([]);
      const isLoading = ref(false);
      const errorMessage = ref(null);
      const router = useRouter(); // Use the useRouter function to get the router object

      const getStaffList = async () => {
  try {
    isLoading.value = true;
    const response = await axios.get('http:localhost:8000/api/getAllStaf');
    staffs.value = response.data;
  } catch (error) {
    console.error('Error fetching staff list:', error);
    errorMessage.value =
      error.message || 'Error fetching staff list. Please try again.';
    // Log the entire error object for more details
    console.log('Full error object:', error);
  } finally {
    isLoading.value = false;
  }
};

 
  
      onMounted(() => {
        getStaffList();
      });
  
      return {
        staffs,
        isLoading,
        errorMessage,
      };
    },
  };
  </script>
  