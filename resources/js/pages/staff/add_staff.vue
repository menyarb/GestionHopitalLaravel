<!-- addStaff.vue -->

<template>
    <div class="content">
      <NavbarHorizontale></NavbarHorizontale>
      <NavbarVertical></NavbarVertical>
  
      <!-- Form Start -->
      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-15">
            <div class="bg-light rounded h-100 p-4">
              <h6 class="mb-4">Add Staff</h6>
              <form @submit.prevent="addStaff">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    v-model="user.name"
                    required
                  />
                </div>
  
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    v-model="user.email"
                    required
                  />
                </div>
  
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone</label>
                  <input
                    type="text"
                    class="form-control"
                    id="phone"
                    v-model="user.phone"
                    required
                  />
                </div>
  
                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input
                    type="text"
                    class="form-control"
                    id="address"
                    v-model="user.address"
                    required
                  />
                </div>
  
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="password"
                    v-model="user.password"
                    required
                  />
                </div>

                <div class="col-md-6 ms-auto">
                <label for="DoctorID" class="form-label">Doctor</label>
                <select class="form-control" v-model="staff.DoctorID">
                  <option v-for="doc in doctors" :key="doc.DoctorID" :value="doc.DoctorID">{{ doc.Name }}</option>
                </select>
              </div>
                <!-- Staff Details -->
                <div class="mb-3">
                  <label for="Designation" class="form-label">Designation</label>
                  <input
                    type="text"
                    class="form-control"
                    id="Designation"
                    v-model="staff.Designation"
                    required
                  />
                </div>
  
                <div class="mb-3">
                  <label for="Highest_Qualification" class="form-label">Highest Qualification</label>
                  <input
                    type="text"
                    class="form-control"
                    id="Highest_Qualification"
                    v-model="staff.Highest_Qualification"
                    required
                  />
                </div>
  
                <div class="mb-3">
                  <label for="Salary" class="form-label">Salary</label>
                  <input
                    type="text"
                    class="form-control"
                    id="Salary"
                    v-model="staff.Salary"
                    required
                  />
                </div>
  
                <button
    type="submit"
    class="btn btn-primary"
    :disabled="isLoading"
  >
    {{ isLoading ? 'Adding Staff...' : 'Add Staff' }}
  </button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Form End -->
    </div>
  </template>
  
  <script>
import NavbarVertical from '../../layout/navbar_vertical.vue';
import NavbarHorizontale from '../../layout/navbar_horizontale.vue';
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
  components: {
    NavbarHorizontale,
    NavbarVertical,
  },
  
  setup() {
    const isLoading = ref(false);
    const errorMessage = ref(null);
    const router = useRouter();

    const user = ref({
      name: "",
      email: "",
      password: "",
      role: "",
      phone: '',
      address: '',
    });

    const staff = ref({
      Designation: '',
      Highest_Qualification: '',
      Salary: '',
      DoctorID: null, // Add DoctorID
    });

    const doctors = ref([]);

    const getDoctors = async () => {
      try {
        const response = await axios.get('http://localhost:8000/api/listDoctor');
        doctors.value = response.data;
      } catch (error) {
        console.error('Error fetching doctors:', error);
        errorMessage.value = 'Error fetching doctors. Please try again.';
      }
    };

    const addStaff = async () => {
      user.value.role = "secretary";
      try {
    isLoading.value = true;
    const response = await axios.post('localhost:8000/api/AddStaff', { user: user.value, staff: staff.value });
    console.log({ user: user.value, staff: staff.value }); // Corrected with a semicolon
    console.log(response.data);
    router.push('/List_admin');
  } catch (error) {
    console.error('Error adding staff:', error);
    errorMessage.value = 'Error adding staff. Please try again.';
  } finally {
    isLoading.value = false;
  }
    };

    onMounted(() => {
      getDoctors();
    });

    return {
      isLoading,
      errorMessage,
      user,
      staff,
      addStaff,
      doctors,
    };
  },
};
</script>
  

  