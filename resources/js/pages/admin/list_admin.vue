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
                                           
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in user" :key="user.id">
                                            <th scope="row">{{ user.id }}</th>
                                            <td>{{ user.name }}</td>
                                            <td>{{ user.email }}</td>
                                            
                                            <td> <router-link  to="/modify_admin"><button type="button" class="btn btn-success m-2"> modify</button></router-link></td>
                                            <td><button class="btn btn-outline-danger mx-02" @click="deletearticle(art.id)">
    
    <i class="fa-solid fa-trash-can"></i>
    Delete
    </button></td>
                                            <td><button type="button" class="btn btn-danger m-2">delete</button></td>
                                            
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
import NavbarVertical from '../../layout/navbar_vertical.vue';
import NavbarHorizontale from '../../layout/navbar_horizontale.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  components: {
    NavbarHorizontale,
    NavbarVertical,
  },
  setup() {
    const user = ref([]);
    const isLoading = ref(true);

    const getuser = async () => {
      try {
        const response = await axios.get("http://localhost:8000/api/user");
        user.value = response.data;
        isLoading.value = false;
      } catch (error) {
        console.error(error);
      }
    };

    const deleteuser = async (id) => {
      if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
        try {
          await axios.delete(`http://localhost:8000/api/user/${id}`);
          getuser();
        } catch (error) {
          console.log(error);
        }
      }
    };

    onMounted(() => {
      getuser();
    });

    return {
      user,
      isLoading,
      deleteuser,
    };
  },
};
</script>
