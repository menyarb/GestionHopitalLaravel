<template>
    <div class="content">
      <NavbarHorizontale></NavbarHorizontale>
      <NavbarVertical>
      </NavbarVertical>
      <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
      <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Liste Doctor Table</h6>
                            <div class="table-responsive">
                              <router-link  to="/doctor/add_doctor"><button type="button" class="btn btn-outline-primary m-2 ms-auto"><i class="fa fa-home me-2"></i>add doctor</button></router-link>
  
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Doctore Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Department name</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">ReputeIndex</th>
                                            <th scope="col">Qualification</th>
                                            <th scope="col">Specialization</th>
                                            <th scope="col">Work_Experience</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Image</th>
                                          
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Change from 'user' to 'users' in the v-for loop -->
                                        
  <tr v-for="doctor in doctors" :key="doctor.DoctorID">
    <th scope="row">{{ doctor.DoctorID }}</th>
    <td>{{ doctor.Name }}</td>
    <td>{{ doctor.Phone }}</td>
    <td>{{ doctor.Address }}</td>
    <td>{{ getDepartmentName(doctor.DeptNo) }}</td> 
    <td>{{ doctor.Gender }}</td>
    <td>{{ doctor.ReputeIndex }}</td>
    <td>{{ doctor.Qualification }}</td>
    <td>{{ doctor.Specialization }}</td>
    <td>{{ doctor.Work_Experience }}</td>
    <td>{{ doctor.Status }}</td>
    <td><img :src="doctor.img" width="70"
    
    height="80"/></td>
  
  
    
    <td>
    <RouterLink :to="{path:'/doctor/modify_doctor/'+doctor.DoctorID+''}" class="btn btn-success m-2">Modify</RouterLink>
    
      
  </td>
  
    <td><button type="button" class="btn btn-danger m-2" @click="deletedoctor(doctor.DoctorID)">delete</button></td>
  </tr>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div></div>
       
                  
  
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router'; // Import the useRouter function
  
  import NavbarVertical from '../../layout/navbar_vertical.vue';
  import NavbarHorizontale from '../../layout/navbar_horizontale.vue';
  
  export default {
  components: {
    NavbarHorizontale,
    NavbarVertical,
  },
  setup() {
    const router = useRouter(); // Use the useRouter function to get the router object
    const doctors = ref([]);
    const departments = ref([]); // Add this line

    const isLoading = ref(true);
  
    const getdoctors = async () => {
      try {
        const response = await axios.get("http://localhost:8000/api/listDoctor");
        doctors.value = response.data;
        isLoading.value = false;
      } catch (error) {
        console.error(error);
      }
    };
  

  
    const modifydoctor = async (id) => {
      try {
        const doctor = await getdoctorById(id);
        router.push({ name: 'modify_doctor', params: { id: doctor.id } });
      } catch (error) {
        console.error(error);
      }
    };
   
    onMounted(() => {
      getdoctors();
    });
    const deletedoctor=async(id)=>{
      if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
      try {
  await axios.delete(`http://localhost:8000/api/getDoctor/${id}`)
  getdoctors()
      } catch (error) {
      console.log(error)
          
      }
  }
  }
  const getDepartmentName = (deptNo) => {
      const department = departments.value.find((dept) => dept.DeptName === deptNo);
      return department ? department.DeptName : 'Unknown Department';
    };
  
    return {
        doctors,
        isLoading,
        modifydoctor,
        deletedoctor,
        getDepartmentName,
    };
  },
  };
  </script>
  
  
  