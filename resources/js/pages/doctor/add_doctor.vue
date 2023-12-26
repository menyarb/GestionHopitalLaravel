<template>
    <div class="content">
      <NavbarHorizontale></NavbarHorizontale>
      <NavbarVertical></NavbarVertical>
  
      <!-- Form Start -->
      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-15">
            <div class="bg-light rounded h-100 p-4">
              <h6 class="mb-4">Add Doctor</h6>
              <form @submit.prevent="addDoctor">
                <div class="mb-3">
                  <label for="exampleInputDeptName" class="form-label">Doctor Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputDeptName"
                    aria-describedby="deptNameHelp"
                    v-model="doctor.Name"
                  />
                </div>
  
                <div class="mb-3">
                  <label for="exampleInputDescription" class="form-label">Phone</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputDescription"
                    v-model="doctor.Phone"
                  />
                </div>
  
                <div class="mb-3">
                  <label for="exampleInputDeptName" class="form-label">Address</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputDeptName"
                    v-model="doctor.Address"
                  />
                </div>
  
                <div class="mb-3">
                  <label for="exampleInputDeptName" class="form-label">Gender</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputDeptName"
                    v-model="doctor.Gender"
                  />
                </div>
  
                <div class="col-md-6 ms-auto">
  <label for="scategorie" class="form-label">Department</label>
  <select class="form-control" v-model="doctor.DeptNo">
    <option v-for="de in departments" :key="de.id" :value="de.id">{{ de.DeptName }}</option>
  </select>
</div>


                <div class="mb-3">
                  <label for="exampleInputDeptName" class="form-label">ReputeIndex</label>
                  <input
                    type="number"
                    class="form-control"
                    id="exampleInputDeptName"
                    v-model="doctor.ReputeIndex"
                  />
                </div>
  
                <div class="mb-3">
                  <label for="exampleInputDeptName" class="form-label">Qualification</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputDeptName"
                    v-model="doctor.Qualification"
                  />
                </div>
  
                <div class="mb-3">
                  <label for="exampleInputDeptName" class="form-label">Specialization</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputDeptName"
                    v-model="doctor.Specialization"
                  />
                </div>
  
                <div class="mb-3">
                  <label for="exampleInputDeptName" class="form-label">Work_Experience</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputDeptName"
                    v-model="doctor.Work_Experience"
                  />
                </div>
  
                <div class="mb-3">
                  <label for="exampleInputDeptName" class="form-label">Status</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputDeptName"
                    v-model="doctor.Status"
                  />
                </div>
  
                <!-- FilePond for image upload -->
                <div class="form-group">
                  <file-pond
                    name="test"
                    ref="pond"
                    class-name="my-pond"
                    label-idle="Drop files here..."
                    allow-multiple="false"
                    accepted-file-types="image/jpeg, image/png"
                    v-bind:files="myFiles"
                    v-on:init="handleFilePondInit"
                    :server="serverOptions()"
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
  import { ref, onMounted } from "vue";
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  import vueFilePond from 'vue-filepond';
  import 'filepond/dist/filepond.min.css';
  import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
  import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
  
  // Create FilePond component
  const FilePond = vueFilePond(FilePondPluginImagePreview);
  const myFiles = ref([]);
  const doctor = ref({
    Name: "",
    Phone: "",
    Address: "",
    Gender: "",
    DeptNo: "",  // Set DeptNo to null initially
    ReputeIndex: null,
    Qualification: "",
    Specialization: "",
    Work_Experience: "",
    Status: "",
    img: "",
  });
  const DeptNo = ref([]);
  
  export default {
    components: {
      NavbarHorizontale,
      NavbarVertical,
      FilePond, // Use the correct component name here
    },
    setup() {
      const router = useRouter();
  
      const addDoctor = async () => {
        console.log('Doctor Object:', doctor.value);
        console.log('Selected DeptNo:', doctor.value.DeptNo);

  try {
    // Validate doctor object and set required fields
    if (!doctor.value.DeptNo) {
      throw new Error('The DeptNo field is required.');
    }

    const response = await axios.post("http://localhost:8000/api/AddDoctor", doctor.value);
    console.log(response.data);
    router.push({ name: 'List_doctor' });
  } catch (error) {
    console.error(error.message);
  }
};
const departments = ref([]);
const getDepartments=()=>{
          
          axios.get('http://localhost:8000/api/listDepartment').then(res => {
            departments.value =res.data;
            
                  }).catch(error => {
                      console.log(error)
                  });
      
               }

      const serverOptions = () => {
        console.log('server pond');
        return {
          process: (fieldName, file, metadata, load, error, progress, abort) => {
            const data = new FormData();
            data.append('file', file);
            data.append('upload_preset', 'GLID5IIT');
            data.append('cloud_name', 'esps');
            data.append('public_id', file.name);
            axios.post('https://api.cloudinary.com/v1_1/esps/upload', data)
              .then((response) => response.data)
              .then((data) => {
                console.log(data);
                doctor.value.img = data.url;
                load(data);
              })
              .catch((error) => {
                console.error('Error uploading file:', error);
                error('Upload failed');
                abort();
              });
          },
        };
      };
  
      onMounted(() => {
        getDepartments();


      });
  
      return {
        doctor,
        myFiles,
        addDoctor,
        serverOptions,
        departments,
        //isLoading,
      };
    },
  };
  </script>
  