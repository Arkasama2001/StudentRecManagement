<template>
  <v-navigation-drawer color="primary" expand-on-hover rail>
    <v-list density="compact" nav>
      <v-list-item prepend-icon="mdi-home" title="Home" @click="goToHome" value="home"></v-list-item>
      <v-list-item prepend-icon="mdi-database" @click="goToMyData" title="User Data" value="My Data">
        
      </v-list-item>
      <v-list-item prepend-icon="mdi-human-greeting" @click="goToAttendance" title="Attendance Sheet" v-if="role == 'Teacher'">
        
      </v-list-item>
      <v-list-item prepend-icon="mdi-history" @click="goToPresentAttendance" title="Present Attendance" v-if="role == 'Teacher'">
        
      </v-list-item>
      <v-list-item prepend-icon="mdi-account-plus-outline" @click="goToAddStudent" title="Add User" v-if="role == 'Admin'">
        
      </v-list-item>
      
      <v-list-item  prepend-icon="mdi-forum" title="About" @click="snackbar=true" value="about"></v-list-item>
      

      
      <v-list-item  prepend-icon="mdi-account" title="Account">

      <v-menu activator="parent">
        <v-list>
          <v-list-item prepend-avatar="https://cdn.vuetifyjs.com/images/john.png" :title=name :subtitle=email>
          </v-list-item>

          <v-list-item @click="logout">
            Log-out
          </v-list-item>
        </v-list>
      </v-menu>

  </v-list-item>
    </v-list>
  </v-navigation-drawer>

  <v-snackbar
      v-model="snackbar"
      title="Student Record Management System"
    >
      Student Record Management System
      <br>
      <br>

      Contacts: Arka Samaddar
      <br>
      Phone: +91 7980184074

      <template v-slot:actions>
        <v-btn
          color="blue-accent-2"
          variant="text"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>

  <v-app-bar :title="pageName" class="overflow-hidden" scroll-behavior="hide" scroll-threshold="20">
  </v-app-bar>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      snackbar:false,
      pageName:this.$route.name,
      role: localStorage.getItem('role'),
      name: localStorage.getItem('name'),
      email: localStorage.getItem('email')
    }

  },
  methods: {
    goToAddStudent() {
      this.$router.push({ name: 'Add User' })
    },
    goToPresentAttendance() {
      this.$router.push({ name: 'Present Attendance' })
    },
    goToHome() {
      this.$router.push({ name: 'Home' })
    },
    logout() {
      localStorage.clear()
      this.$router.push({ name: 'Login' })
    },
    goToAttendance() {
      this.$router.push({ name: 'Attendance' })
    },
    goToMyData() {
      this.$router.push({ name: 'User Data' })
    },
  },
  mounted() {
    if (!localStorage.getItem('loggedIn')) {
      this.$router.push({ path: '/' })
    }
  }
};
</script>
<script setup>
import router from '@/router';


// var login=true 
</script>
