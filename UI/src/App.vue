<template>
  <router-view />
</template>

<script setup>

//
</script>

<script>

export default {
  name: "app",
  mounted() { 
    console.log(localStorage.getItem("loggedIn"))
    if(localStorage.getItem("loggedIn"))
    this.$router.push({name:'Home',params:{username: localStorage.getItem("email")}})
    else
    this.$router.push({name:"Login"})
  },
};
</script>
