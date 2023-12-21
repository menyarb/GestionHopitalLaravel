// routes.js
import Register from '/resources/js/components/register.vue';
import Login from '/resources/js/components/login.vue';
import home from '/resources/js/components/home.vue'; // Add this line
import Acc from '/resources/js/components/acc.vue'; // Add this line
import Add_admin from '/resources/js/pages/admin/add_admin.vue'; // Add this line
import List_admin from '/resources/js/pages/admin/list_admin.vue'; // Add this line
import Modify_admin from '/resources/js/pages/admin/modify_admin.vue'; // Add this line


import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  {
    path: '/home',
    name: 'home',
    component: home,
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/acc',
    name: 'Acc',
    component: Acc,
  },
  {
    path: '/add_admin',
    name: 'Add_admin',
    component: Add_admin,
  },
  {
    path: '/list_admin',
    name: 'List_admin',
    component: List_admin,
  },
  {
    path: '/modify_admin',
    name: 'Modify_admin',
    component: Modify_admin,
  },
 
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
