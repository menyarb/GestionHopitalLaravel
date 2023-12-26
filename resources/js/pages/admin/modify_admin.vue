<template>
  <div class="content">
    <NavbarHorizontale></NavbarHorizontale>
    <NavbarVertical></NavbarVertical>
    <div class="container-fluid pt-4 px-4">
      <div class="row g-4">
        <div class="col-sm-12 col-xl-15">
          <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Edit Admin</h6>
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
  <label for="exampleInputPhone" class="form-label">Phone</label>
  <input
    type="text"
    class="form-control"
    id="phone"
    aria-describedby="phoneHelp"
    v-model="user.phone"
  />
</div>
<div class="mb-3">
  <label for="exampleInputAddress" class="form-label">Address</label>
  <input
    type="text"
    class="form-control"
    id="address"
    aria-describedby="addressHelp"
    v-model="user.address"
  />
</div>
<div class="mb-3">
  <label for="exampleInputBirthDate" class="form-label">Birth Date</label>
  <input
    type="text"
    class="form-control"
    id="birthDate"
    aria-describedby="birthDateHelp"
    v-model="user.birth_date"
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
  name: 'editadmin',
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
      password: '',
      phone: '',       // Add these lines
      address: '',     // Add these lines
      birth_date: '',  // Add these lines
      },
    };
  },
  setup() {
    const route = useRoute(); // Import the useRoute function
    const router = useRouter(); // Import the useRouter function
const user = ref({});
    const fetchuser= async()=> {
  await axios.get(`http://localhost:8000/api/updateAdmin/${route.params.id}`).then((res) => {
                    user.value = res.data;
                    })
                .catch((err) => {console.error(err)})  
                }
  
    const modifyUser = async () => {
    
         axios.put(`http://localhost:8000/api/updateAdmin/${route.params.id}`, user.value)
         .then(() => {
                router.push('/list_admin')})
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


