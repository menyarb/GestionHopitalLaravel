<template>
    <div class="content">
      <NavbarHorizontale></NavbarHorizontale>
      <NavbarVertical>
      </NavbarVertical>
      <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
      <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Liste Department Table</h6>
                            <div class="table-responsive">
                              <router-link  to="/department/add_department"><button type="button" class="btn btn-outline-primary m-2 ms-auto"><i class="fa fa-home me-2"></i>add department</button></router-link>
  
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Department Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Image</th>
                                          
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Change from 'user' to 'users' in the v-for loop -->
                                        
  <tr v-for="department in departments" :key="department.id">
    <th scope="row">{{ department.id }}</th>
    <td>{{ department.DeptName }}</td>
    <td>{{ department.Description }}</td>
    <td><img :src="department.img" width="70"
    
    height="80"/></td>
  
  
    
    <td>
    <RouterLink :to="{path:'/modify_department/'+department.id+''}" class="btn btn-success m-2">Modify</RouterLink>
      
  </td>
  
    <td><button type="button" class="btn btn-danger m-2" @click="deletedepartment(department.id)">delete</button></td>
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
    const departments = ref([]);
    const isLoading = ref(true);
  
    const getdepartments = async () => {
      try {
        const response = await axios.get("http://localhost:8000/api/listDepartment");
        departments.value = response.data;
        isLoading.value = false;
      } catch (error) {
        console.error(error);
      }
    };
  

  
    const modifydepartment = async (id) => {
      try {
        const department = await getdepartmentById(id);
        router.push({ name: 'modify_department', params: { id: department.id } });
      } catch (error) {
        console.error(error);
      }
    };
   
    onMounted(() => {
      getdepartments();
    });
    const deletedepartment=async(id)=>{
      if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
      try {
  await axios.delete(`http://localhost:8000/api/getDepartments/${id}`)
  getdepartments()
      } catch (error) {
      console.log(error)
          
      }
  }
  }
  
    return {
      departments,
        isLoading,
        modifydepartment,
        deletedepartment,
    };
  },
  };
  </script>
  
  
  