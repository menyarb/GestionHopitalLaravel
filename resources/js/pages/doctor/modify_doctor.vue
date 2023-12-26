<template>
    <div class="content">
      <NavbarHorizontale></NavbarHorizontale>
      <NavbarVertical></NavbarVertical>
      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-15">
            <div class="bg-light rounded h-100 p-4">
              <h6 class="mb-4">Edit Doctor</h6>
              <form  @submit.prevent="modifydoctor">
                <div class="mb-3">
                  <label for="exampleInputname" class="form-label">Doctor Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                    v-model="doctor.Name"
                  />
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Phone</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    v-model="doctor.Phone"
                  />
                </div>
                <div class="mb-3">
                  <label for="exampleInputname" class="form-label">Address</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                    v-model="doctor.Address"
                  />
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Gender</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
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
                  <label for="exampleInputname" class="form-label">ReputeIndex</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                    v-model="doctor.ReputeIndex"
                  />
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Qualification</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    v-model="doctor.Qualification"
                  />
                </div>
                <div class="mb-3">
                  <label for="exampleInputname" class="form-label">Specialization</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                    v-model="doctor.Specialization"
                  />
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Work_Experience</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    v-model="doctor.Work_Experience"
                  />
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Status</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    v-model="doctor.Status"
                  />
                </div>
<!-- FilePond pour le téléchargement d'images -->
<div class="form-group">
<div>
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
import { useRoute, useRouter } from 'vue-router';
import { ref, onMounted } from 'vue';
import NavbarVertical from '../../layout/navbar_vertical.vue';
import NavbarHorizontale from '../../layout/navbar_horizontale.vue';
import axios from 'axios';
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginImagePreview);

export default {
  name: 'editdoctor',
  components: {
    NavbarHorizontale,
    NavbarVertical,
    FilePond,
  },

  setup() {
    const route = useRoute();
    const router = useRouter();

    const doctor = ref({
      Name: '',
      Phone: '',
      Address: '',
      Gender: '',
      DeptNo: null,
      ReputeIndex: null,
      Qualification: '',
      Specialization: '',
      Work_Experience: '',
      Status: '',
      img: '',
    });

    const myFiles = ref([]);

    const fetchdoctor = async () => {
      await axios
        .get(`http://localhost:8000/api/updateDoctor/${route.params.id}`)
        .then((res) => {
          doctor.value = res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    };

    const modifydoctor = async () => {
      axios
        .put(`http://localhost:8000/api/updateDoctor/${route.params.id}`, doctor.value)
        .then(() => {
          router.push('/doctor/list_doctor');
        })
        .catch((error) => {
          console.error('There was an error!', error);
        });
    };

    const departments = ref([]);
    const getDepartments = () => {
      axios
        .get('http://localhost:8000/api/listDepartment')
        .then((res) => {
          departments.value = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    };

    const serverOptions = () => {
      return {
        process: (fieldName, file, metadata, load, error, progress, abort) => {
          const data = new FormData();
          data.append('file', file);
          data.append('upload_preset', 'GLID5IIT');
          data.append('cloud_name', 'esps');
          data.append('public_id', file.name);

          axios
            .post('https://api.cloudinary.com/v1_1/esps/upload', data)
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
      fetchdoctor();
      getDepartments();
    });

    return {
      doctor,
      modifydoctor,
      myFiles,
      serverOptions,
      departments,
        //isLoading,
    };
  },
};
</script>
  
  
  