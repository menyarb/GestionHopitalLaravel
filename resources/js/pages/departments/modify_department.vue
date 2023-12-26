<template>
    <div class="content">
      <NavbarHorizontale></NavbarHorizontale>
      <NavbarVertical></NavbarVertical>
      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-xl-15">
            <div class="bg-light rounded h-100 p-4">
              <h6 class="mb-4">Edit Department</h6>
              <form  @submit.prevent="modifydepartment">
                <div class="mb-3">
                  <label for="exampleInputname" class="form-label">Department Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                    v-model="department.DeptName"
                  />
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Description</label>
                  <input
                    type="text"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    v-model="department.Description"
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
  import { useRoute, useRouter } from 'vue-router';  // Import useRoute and useRouter from vue-router package
  import { ref,onMounted } from "vue"
  import NavbarVertical from '../../layout/navbar_vertical.vue';
  import NavbarHorizontale from '../../layout/navbar_horizontale.vue';
  import axios from 'axios';
  import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);

  export default {
    name: 'editdepartment',
    components: {
      NavbarHorizontale,
      NavbarVertical,
          FilePond, // Use the correct component name here
    },
    
    data() {
      return {
        department: {
          id: '',
          DeptName: '',
          Description: '',
          img:'',
          
        },
      };
    },
    setup() {
      const route = useRoute(); // Import the useRoute function
      const router = useRouter(); // Import the useRouter function
  const department = ref({});
  const myFiles = ref([]);

      const fetchdepartment= async()=> {
    await axios.get(`http://localhost:8000/api/updateDepartment/${route.params.id}`).then((res) => {
                      department.value = res.data;
                      })
                  .catch((err) => {console.error(err)})  
                  }
    
      const modifydepartment = async () => {
      
           axios.put(`http://localhost:8000/api/updateDepartment/${route.params.id}`, department.value)
           .then(() => {
                  router.push('/department/list_department')})
            .catch(error => {
               console.error("There was an error!", error);})
          
      
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
      onMounted(() => {
        fetchdepartment();
        
  
    });
  
      return {
        department,
        modifydepartment,
        myFiles,
      serverOptions,
      };
    },
  };
  const handleFilePondInit = async() => { 
    if (article.value.imageart) { 
    myFiles.value = [ 
    { 
    source: article.value.imageart, 
    options: { type: 'local' } 
    } 
    ] 
    } 
    } 
    const serverOptions = () => { console.log('server pond'); return { 
    load: (source, load, error, progress, abort, headers) => { var myRequest = new Request(source); 
    fetch(myRequest).then(function(response) { 
    response.blob().then(function(myBlob) { 
    load(myBlob); 
    }); 
    }); 
    }, 
    process: (fieldName, file, metadata, load, error, progress, abort) => { const data = new FormData(); 
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
  </script>
  
  
  