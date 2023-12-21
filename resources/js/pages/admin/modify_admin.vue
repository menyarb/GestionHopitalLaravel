<template>
    <div class="content">
      <NavbarHorizontale></NavbarHorizontale>
      <NavbarVertical>
      </NavbarVertical>
      <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-15">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Modify Admin </h6>
                            <form >
                                <div class="mb-3">
                                    <label for="exampleInputname" class="form-label">name</label>
                                    <input type="name" class="form-control" id="exampleInputname"
                                        aria-describedby="nameHelp">
                                  
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1">
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
  import NavbarVertical from '../../layout/navbar_vertical.vue';
  import NavbarHorizontale from '../../layout/navbar_horizontale.vue';
  
  
   // Home.vue
  export default {
    
      components: {
        NavbarHorizontale,
      NavbarVertical,
      
    }
  };
  
    </script>