// Composables
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    component: () => import('@/layouts/default/Default.vue'),
    children: [
      {
        path: '/',
        name: 'Login',
        
        component: () => import(/* webpackChunkName: "home" */ '@/views/LoginPage.vue'),
      },
      {
        path: '/home',
        name: 'Home',

        component: () => import(/* webpackChunkName: "home" */ '@/views/HomePage.vue'),
      },
      {
        path: '/userData',
        name: 'User Data',
        
        component: () => import(/* webpackChunkName: "home" */ '@/views/MyData.vue'),
      },
      {
        path: '/Attendance',
        name: 'Attendance',
        
        component: () => import(/* webpackChunkName: "home" */ '@/views/Attendance.vue'),

      },

      {
        path: '/PresentAttendance',
        name: 'Present Attendance',
        
        component: () => import(/* webpackChunkName: "home" */ '@/views/PresentAttendance.vue'),
      },
      {
        path: '/addStudent',
        name: 'Add User',
        
        component: () => import(/* webpackChunkName: "home" */ '@/views/addStudent.vue'),
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
})

export default router
