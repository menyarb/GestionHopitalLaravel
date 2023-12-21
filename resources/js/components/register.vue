<template>
  <div class="card " style="width: 600px; margin: auto; margin-top: 50px;">
    <div class="card-header bg-primary text-white">
      Register Form
    </div>
    <div class="card-body">
      <form @submit.prevent="saveData">
        <div class="mb-3">
          <label for="name" class="form-label">First Name</label>
          <input type="text" v-model="student.name" name="name" id="name" class="form-control" required />
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" v-model="student.email" name="email" id="email" class="form-control" required />
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" v-model="student.password" name="password" id="password" class="form-control" required />
        </div>

        <button type="submit" class="btn btn-success">Save</button>
      </form>
    </div>
    <div class="card-footer bg-primary text-white text-center">
            <div class="decorative-design">
              <!-- Your decorative design here -->
              <svg height="50" width="50">
                
              </svg>
            </div>
          </div>
  </div>
</template>

       <script setup>
       
       import axios from 'axios';
       
       const student = {
         name: '',
         email: '',
         password: ''
       };
       
       const saveData = async () => {
         try {
           const { data } = await axios.post("http://127.0.0.1:8000/api/register", student);
           console.log(data);
           alert("Saved successfully");
         } catch (error) {
           console.error(error);
           alert("Failed to save");
         }
       };
       </script>
       
         
    