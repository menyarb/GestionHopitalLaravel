<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card border-primary mb-4">
          <div class="card-header bg-primary text-white">
            <h2 class="text-center">Login</h2>
          </div>
          <div class="card-body p-4">
            <!-- Your form content here -->
            <form @submit.prevent="LoginData">
              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" v-model="student.email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" v-model="student.password" class="form-control" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-success mt-3">Login</button>
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
      </div>
    </div>
  </div>
</template>

<style scoped>
.decorative-design {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}


</style>






   
<script>
import axios from 'axios';

export default {
  name: 'Registration',
  data() {
    return {
      result: {},
      student: {
        email: '',
        password: ''
      }
    };
  },
  created() {},
  mounted() {
    console.log('mounted() called.......');
  },
  methods: {
  LoginData() {
    axios.post('http://127.0.0.1:8000/api/login', this.student)
      .then(({ data }) => {
        console.log(data);
        if (data.status === true) {
          alert('Login Successfully');
          // Make sure the route name 'home' matches your router configuration
          this.$router.push({ name: 'home' }).catch(() => {});
        } else {
          alert('Login failed');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Error, please try again');
      });
  }
}

};
</script>


     
