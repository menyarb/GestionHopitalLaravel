// main.js
import { createApp } from 'vue';
import { createWebHashHistory, createRouter } from 'vue-router';
import router from './routes'; // Adjust the path based on your actual file structure
// Import Bootstrap 5 CSS
import 'bootstrap/dist/css/bootstrap.min.css';

// Import Bootstrap 5 JavaScript (you may need to include Popper.js as well)
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import '/resources/css/app.css';
import '/resources/css/lib/owlcarousel/assets/owl.carousel.min.css';
import '/resources/css/lib/owlcarousel/assets/owl.carousel.css';
//import '/resources/css/lib/owlcarousel/owl.carousel.js';
//import '/resources/css/lib/owlcarousel/owl.carousel.min.js';


import '/resources/css/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css';
import App from '/resources/js/App.vue';

const app = createApp(App);
app.use(router);
app.mount('#app');

