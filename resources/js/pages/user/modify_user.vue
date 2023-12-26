<template>
    <div class="content">
      <NavbarHorizontale></NavbarHorizontale>
      <NavbarVertical></NavbarVertical>
      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-15">
            <div class="bg-light rounded h-100 p-4">
              <h6 class="mb-4">Edit User</h6>
              <form  @submit.prevent="modifyUser">
                <div class="mb-3">
                  <label for="exampleInputname" class="form-label">Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                    v-model="user.name"
                  />
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input
                    type="email"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    v-model="user.email"
                  />
                </div>
                <div class="mb-3">
                <label for="exampleInputname" class="form-label">birth_date</label>
                <input
                  type="date"
                  class="form-control"
                  id="exampleInputname"
                  aria-describedby="nameHelp"
                  v-model="user.birth_date"
                />
              </div>
              <div class="mb-3">
                <label for="exampleInputname" class="form-label">address</label>
                <input
                  type="address"
                  class="form-control"
                  id="exampleInputname"
                  aria-describedby="nameHelp"
                  v-model="user.address"
                />
              </div>
              <div class="mb-3">
                <label for="exampleInputname" class="form-label">phone</label>
                <input
                  type="phone"
                  class="form-control"
                  id="exampleInputname"
                  aria-describedby="nameHelp"
                  v-model="user.phone"
                />
              </div>
  
  
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { useRoute, useRouter } from 'vue-router';  // Import useRoute and useRouter from vue-router package
  import { ref,onMounted } from "vue"
  import NavbarVertical from '../../layout/navbar_vertical.vue';
  import NavbarHorizontale from '../../layout/navbar_horizontale.vue';
  import axios from 'axios';
  
  export default {
    name: 'edituser',
    components: {
      NavbarHorizontale,
      NavbarVertical,
    },
    data() {
      return {
        user: {
            id: '',
        name: '',
        email: '',
        phone: '',
        address: '',
        birth_date: '',
        },
      };
    },
    setup() {
      const route = useRoute(); // Import the useRoute function
      const router = useRouter(); // Import the useRouter function
  const user = ref({});
      const fetchuser= async()=> {
    await axios.get(`http://localhost:8000/api/updateUser/${route.params.id}`).then((res) => {
                      user.value = res.data;
                      })
                  .catch((err) => {console.error(err)})  
                  }
    
      const modifyUser = async () => {
      
           axios.put(`http://localhost:8000/api/updateUser/${route.params.id}`, user.value)
           .then(() => {
                  router.push('/list_user')})
            .catch(error => {
               console.error("There was an error!", error);})
          
      
      };
      onMounted(() => {
        fetchuser();
        
  
    });
  
      return {
        user,
        modifyUser,
      };
    },
  };
  </script>
  
  
  