// routes.js
import Register from '/resources/js/components/register.vue';
import Login from '/resources/js/components/login.vue';
import home from '/resources/js/components/home.vue'; // Add this line
import Acc from '/resources/js/components/acc.vue'; // Add this line
import Add_admin from '/resources/js/pages/admin/add_admin.vue'; // Add this line
import List_admin from '/resources/js/pages/admin/list_admin.vue'; // Add this line
import Modify_admin from '/resources/js/pages/admin/modify_admin.vue'; // Add this line
import add_department from './pages/departments/add_department.vue'; // Add this line
import List_department from './pages/departments/list_department.vue'; // Add this line
import Modify_department from './pages/departments/modify_department.vue'; // Add this line
import Add_doctor from '/resources/js/pages/doctor/add_doctor.vue'; // Add this line
import List_doctor from '/resources/js/pages/doctor/List_doctor.vue'; // Add this line
import Modify_doctor from '/resources/js/pages/doctor/modify_doctor.vue'; 
import Add_user from '/resources/js/pages/user/add_user.vue'; // Add this line
import List_user from '/resources/js/pages/user/list_user.vue'; // Add this line
import Modify_user from '/resources/js/pages/user/modify_user.vue'; // Add this line
import Add_staff from '/resources/js/pages/staff/add_staff.vue'; // Add this line
import List_staff from '/resources/js/pages/staff/list_staff.vue'; // Add this line
import { createRouter, createWebHistory } from 'vue-router';


const routes = [
  {
    path: '/home',
    name: 'home',
    component: home,
    //meta: { requiresAuth: true, roles: ['admin'] },
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
    //meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/add_admin',
    name: 'Add_admin',
    component: Add_admin,
  //  meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/list_admin',
    name: 'List_admin',
    component: List_admin,
  //  meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/modify_admin/:id',
    name: 'Modify_admin',
    component: Modify_admin,
    
//    meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/department/add_department',
    name: 'add_department',
    component: add_department,
    
//    meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/department/list_department',
    name: 'List_department',
    component:List_department,
    
//    meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/modify_department/:id',
    name: 'Modify_department',
    component: Modify_department,
    
//    meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/doctor/add_doctor',
    name: 'Add_doctor',
    component: Add_doctor,
  //  meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/doctor/list_doctor',
    name: 'List_doctor',
    component: List_doctor,
  //  meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/doctor/modify_doctor/:id',
    name: 'Modify_doctor',
    component: Modify_doctor,
    
//    meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/add_user',
    name: 'Add_user',
    component: Add_user,
  //  meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/list_user',
    name: 'List_user',
    component: List_user,
  //  meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/modify_user/:id',
    name: 'Modify_user',
    component: Modify_user,
    
//    meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/add_staff',
    name: 'Add_staff',
    component: Add_staff,
  //  meta: { requiresAuth: true, roles: ['admin'] },
  },
  {
    path: '/list_staff',
    name: 'List_staff',
    component: List_staff,
  //  meta: { requiresAuth: true, roles: ['admin'] },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});


export default router;
