<template>
  <div class="content">
    <NavbarHorizontale></NavbarHorizontale>
    <NavbarVertical></NavbarVertical>

    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
      <div class="row g-4">
        <div class="col-sm-12 col-xl-15">
          <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Add Department</h6>
            <form @submit.prevent="addDepartment">
              <div class="mb-3">
                <label for="exampleInputDeptName" class="form-label">Department Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputDeptName"
                  aria-describedby="deptNameHelp"
                  v-model="department.DeptName"
                />
              </div>

              <div class="mb-3">
                <label for="exampleInputDescription" class="form-label">Description</label>
                <textarea
                  class="form-control"
                  id="exampleInputDescription"
                  rows="3"
                  v-model="department.Description"
                ></textarea>
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
    <!-- Form End -->
  </div>
</template>

<script>
import NavbarVertical from '../../layout/navbar_vertical.vue';
import NavbarHorizontale from '../../layout/navbar_horizontale.vue';
import { ref } from "vue";
import { useRouter } from 'vue-router';
import axios from 'axios';
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);

export default {
  components: {
    NavbarHorizontale,
    NavbarVertical,
    FilePond, // Use the correct component name here
  },
  setup() {
    const router = useRouter();
    const department = ref({
      DeptName: "",
      Description: "",
      img: "",
    });

    const myFiles = ref([]);


    const addDepartment = async () => {
  try {
    const response = await axios.post("http://localhost:8000/api/AddDepartment", department.value);
    console.log(response.data);
    router.push({  name: 'List_department' }); // Updated route name
  } catch (error) {
    console.error(error.response.data.message);
  }
};

    const serverOptions = () => { console.log('server pond');
return {
process: (fieldName, file, metadata, load, error, progress, abort) => {
const data = new FormData();
data.append('file', file);
data.append('upload_preset', 'GLID5IIT');
data.append('cloud_name', 'esps');
data.append('public_id', file.name);
axios.post('https://api.cloudinary.com/v1_1/esps/upload',data)
.then((response) => response.data)
.then((data) => {
console.log(data);

department.value.img = data.url;
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


    return {
      department,
      myFiles,
      addDepartment,
      serverOptions,
    };
  },
};
</script>

