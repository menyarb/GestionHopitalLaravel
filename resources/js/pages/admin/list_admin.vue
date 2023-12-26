<template>
  <div class="content">
    <NavbarHorizontale></NavbarHorizontale>
    <NavbarVertical>
    </NavbarVertical>
    <div class="container-fluid pt-4 px-4">
              <div class="row g-4">
    <div class="col-12">
                      <div class="bg-light rounded h-100 p-4">
                          <h6 class="mb-4">Liste admin Table</h6>
                          <div class="table-responsive">
                            <router-link  to="/add_admin"><button type="button" class="btn btn-outline-primary m-2 ms-auto"><i class="fa fa-home me-2"></i>add admin</button></router-link>

                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">First Name</th>
                                          <th scope="col">Email address</th>
                                          <th scope="col">role</th>
                                          <th scope="col">phone</th>
                                          <th scope="col">address</th>
                                          <th scope="col">birth_date</th>
                                          <th scope="col"></th>
                                          <th scope="col"></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <!-- Change from 'user' to 'users' in the v-for loop -->
                                      
<tr v-for="user in users" :key="user.id">
  <th scope="row">{{ user.id }}</th>
  <td>{{ user.name }}</td>
  <td>{{ user.email }}</td>
  <td>{{ user.role }}</td>
  <td>{{ user.phone }}</td>
  <td>{{ user.address }}</td>
  <td>{{ user.birth_date }}</td>

  
  <td>
  <RouterLink :to="{path:'/modify_admin/'+user.id+''}" class="btn btn-success m-2">Modify</RouterLink>
    
</td>

  <td><button type="button" class="btn btn-danger m-2" @click="deleteUser(user.id)">delete</button></td>
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
  const users = ref([]);
  const isLoading = ref(true);

  const getUsers = async () => {
    try {
      const response = await axios.get("http://localhost:8000/api/listAdmin");
      users.value = response.data;
      isLoading.value = false;
    } catch (error) {
      console.error(error);
    }
  };

  const getUserById = async (id) => {
    try {
      const response = await axios.get(`http://localhost:8000/api/getUser/${id}`);
      return response.data;
    } catch (error) {
      console.error(error);
    }
  };

  const modifyUser = async (id) => {
    try {
      const user = await getUserById(id);
      router.push({ name: 'modify_admin', params: { id: user.id } });
    } catch (error) {
      console.error(error);
    }
  };
 
  onMounted(() => {
    getUsers();
  });
  const deleteUser=async(id)=>{
    if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
    try {
await axios.delete(`http://localhost:8000/api/getUsers/${id}`)
getUsers()
    } catch (error) {
    console.log(error)
        
    }
}
}

  return {
    users,
      isLoading,
      modifyUser,
      deleteUser,
  };
},
};
</script>


