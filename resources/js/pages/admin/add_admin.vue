<template>
  <div class="content">
    <NavbarHorizontale></NavbarHorizontale>
    <NavbarVertical></NavbarVertical>

    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
      <div class="row g-4">
        <div class="col-sm-12 col-xl-15">
          <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Add Admin </h6>
            <form @submit.prevent="addadmin">
              <div class="mb-3">
                <label for="exampleInputname" class="form-label">name</label>
                <input
                  type="name"
                  class="form-control"
                  id="exampleInputname"
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
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="exampleInputPassword1"
                  v-model="user.password"
                />
              </div>

              <button type="submit" class="btn btn-primary">Save</button>
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
import { ref } from "vue";
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
components: {
  NavbarHorizontale,
  NavbarVertical,
},
setup() {
  const router = useRouter();
  const user = ref({
    name: "",
    email: "",
    password: "",
    role:"",
    phone: '', // Add these lines
    address: '', // Add these lines
    birth_date: '', // Add these lines
  });


  const addadmin = async () => {
  user.value.role = "admin";

  try {
      const response = await axios.post("http://localhost:8000/api/AddAdmin", user.value);
      // Traiter la réponse, afficher un message de succès, etc.
      console.log(response.data);
      router.push({ name: 'List_admin' });
  } catch (error) {
      // Afficher un message d'erreur en fonction de la réponse de l'API
      console.error(error.response.data.message);
  }
};


  return {
    user,
    addadmin,
  };
},
};
</script>
