<template>
  <v-container>
  <v-sheet max-width="300" class="mx-auto">
    <form style="margin-top: 150px; border: 2px solid rgba(46, 36, 36, 0.226);elevation: 2px ;border-radius: 10px; box-shadow: 20px 20px 10px grey; padding: 15px;">
      <h1>Login</h1>
      <br>
      <v-text-field autofocus v-model="email" required label="Email" :rules="emailRules"></v-text-field>
      <v-text-field
            v-model="password"
            @click:append-inner="show2=!show2"
            :append-inner-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="rules"
            :type="show2 ? 'text' : 'password'"
            name="input-10-2"
            label="Password"
            class="input-group--focused"
          ></v-text-field>
<!-- 
      <v-select v-model="state.select" :items="items" :error-messages="v$.select.$errors.map(e => e.$message)"
        label="Item" required @change="v$.select.$touch" @blur="v$.select.$touch"></v-select> -->

        <v-text-field v-model="OTP" label="OTP" :rules="rules"></v-text-field>

      <v-btn class="me-4" @click="sendOTP" :disabled="!(email)">
        Send OTP
      </v-btn>

      <v-btn class="me-4" @click="verifyOTP" :disabled="!(email&&password&&OTP)">
        Submit
      </v-btn>
      
      <br>
      <br>
      <v-btn @click="clear">
        clear
      </v-btn>
    </form>

  </v-sheet>

  
  <v-dialog width="500">
  <template style="display: flex; justify-items: center;" v-slot:activator="{ props }">
    <div style="padding-top: 70px;" class="center">
    <v-btn class="new" style="justify-self: center;" v-bind="props" text="Forgot Password"> </v-btn>
  </div>
  </template>

 
  <template v-slot:default="{ isActive }">
    <v-card title="Change Password">
      <v-form>
      <v-text-field style="padding-left: 10px; padding-right: 10px;" autofocus v-model="email" required label="Email" :rules="emailRules"></v-text-field>

      <v-text-field style="padding-left: 10px; padding-right: 10px;" v-model="OTP" label="OTP" :rules="rules"></v-text-field>
      <div class="center">
      <v-btn width="100px" style="margin-bottom: 50px;" class="me-4" @click="sendOTP" :disabled="!(email)">
        Send OTP
      </v-btn>
    </div>
      <v-text-field
      style="padding-left: 10px; padding-right: 10px;"
            v-model="newPassword"
            @click:append-inner="show2=!show2"
            :append-inner-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="rules"
            :type="show2 ? 'text' : 'password'"
            
            label="New Password"
            class="input-group--focused"
          ></v-text-field>

          <v-text-field
          style="padding-left: 10px; padding-right: 10px;"
            v-model="confirmPassword"
            @click:append-inner="show2=!show2"
            :append-inner-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="rules"
            :type="show2 ? 'text' : 'password'"
            
            label="Confirm Password"
            class="input-group--focused"
          ></v-text-field>
          
      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn
          text="Confirm"
          @click="verifyPassOTP"
        ></v-btn>
        

        <v-btn
          text="Close Dialog"
          @click="isActive.value = false"
        ></v-btn>
      </v-card-actions>
    </v-form>
    </v-card>
    
  </template>
</v-dialog>

</v-container>


</template>


<style>
.center{
  display: flex;
  justify-content: center;
}
</style>
<script>
import swal from 'sweetalert'
export default {
  props: {

  },
  data() {
    return {
      newPassword:'',
      confirmPassword:'',
      isActive:{value:false},
      show2:false,
      OTP:'',
      password:'',
      email:'',
      passwVerified:false,
      OTPverified:false,
      rules: [
        value => {
          if (value) return true

          return 'It cannot be blank'
        },
      ],
      emailRules: [ 
        v => {if(!v){
              return 'Email cannot be blank'
              }
              if(/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v)) 
              return true
              return 'Enter a valid email'
            }
      ],
    }
  },
  methods: {
    clear(){
      this.OTP=this.password=this.email='';
    },
    login() {
      let that = this
      console.log(this.email)
      axios
        .get('http://localhost:3003/logIN', { params: { email: that.email,password:that.password } })
        .then((response) => {
          // this.info = response
          if(response.data.passwVerified)
            { localStorage.setItem('loggedIn',true)
              localStorage.setItem('role',response.data.role)
              localStorage.setItem('email',that.email)
              localStorage.setItem('name',response.data.name)
              localStorage.setItem('department',response.data.department)
              this.$router.push({name: 'Home',params:{email:that.email}}) }
              else{
                swal("OOPS!!","Wrong Mail or Password","error")
              }
        }).catch((e)=>{
          swal("OOPS!!","Login failed. Something went wrong","error")
        })
        
    },

    passChange(){
      let that = this
      axios
        .get('http://localhost:3003/passChange', { params: { email: that.email,password:that.newPassword } })
        .then((response) => {
          if(response.data.state){
          swal("Password changed.")
          }
        }).catch((e)=>{
          swal("OOPS!!"," Something went wrong","error")
        })
    },
    verifyPassOTP(){

      let that=this
      axios
        .get('http://localhost:3003/verifyOTP', { params: { email: that.email,OTP:that.OTP } })
        .then((response) => {
          console.log(response.data.OTPVerified)
          if(response.data.OTPVerified){

            this.passChange(that)
          }
          else
            swal("OTP mismatch","Enter the correct OTP and try again","error")
        }).catch((e)=>{
          swal("OOPS. Something went wrong")
        })

    },


    sendOTP() {
      
      axios
        .get('http://localhost:3003/generateOTP', { params: { email: this.email } })
        .then(response => {this.info = response
          swal("OTP sent to "+this.email)
        }).catch((e)=>{
          swal("OTP Send Failed")
        })
    },
    verifyOTP() {
      let that=this
      axios
        .get('http://localhost:3003/verifyOTP', { params: { email: that.email,OTP:that.OTP } })
        .then((response) => {
          console.log(response.data.OTPVerified)
          if(response.data.OTPVerified){

            this.login(that)
          }
          else
          swal("OTP mismatch","Enter the correct OTP and try again","error")
        }).catch((e)=>{
          swal("Login failed."," Something went wrong","error")
        })
    }

  },
  mounted(){
    if(localStorage.getItem('loggedIn'))
      this.$router.push({name:'Home'})
  }
}
</script>
<style>
.login {
  box-sizing: border-box;
  width: 500px;
  border: 1px solid black;
}
</style>
<script setup>
import router from '@/router';
import axios from 'axios'

</script>
