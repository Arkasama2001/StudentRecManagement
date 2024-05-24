<template id="StudData">
    <v-container>
      <v-text-field prepend-icon="mdi-magnify" v-model="email" :disabled="role=='Student'"></v-text-field>
            <v-btn v-if="role!='Student'" @click="getData">Get User Data</v-btn>
            <v-divider></v-divider>
            <br>
            <br>
            Data:
            <br>
            <br>
            
            <v-row>
              <v-divider></v-divider>
              <v-col cols="2">
            <p>Name</p>
            </v-col>
            <v-col cols="8">
            <v-text-field class="text-field-transparent" @click.prevent readonly :label="stdata.first_name+' ' + stdata.last_name"></v-text-field>
            </v-col>
            <v-divider></v-divider>


            <v-col cols="2">
            <p >Roll no</p>
            </v-col>
            <v-col cols="8">
            <v-text-field class="text-field-transparent" readonly v-model="stdata.rollno"></v-text-field>
            </v-col>
            
            <v-divider></v-divider>
            <v-col cols="2">
            <p >Year</p>
            </v-col>
            <v-col cols="8">
            <v-text-field class="text-field-transparent" :rules="yearRules" :readonly="stdata.role!='Student'" v-model="stdata.year"></v-text-field>
            </v-col>
            
            <v-divider></v-divider>
            <v-col cols="2">
            <p>Department</p>
            </v-col>
            <v-col cols="8">
            <v-text-field class="text-field-transparent" readonly v-model="stdata.Department"></v-text-field>
            </v-col>
            
            <v-divider></v-divider>
            <v-col cols="2">
            <p>Date of Birth</p>
            </v-col>
            <v-col cols="8">
            <v-text-field class="text-field-transparent"  readonly v-model="stdata.Date_of_Birth"></v-text-field>
            </v-col>
            
            <v-divider></v-divider>
            <v-col cols="2">
            <p>Address</p>
            </v-col>
            <v-col cols="8">
            <v-text-field class="text-field-transparent"  readonly :label="stdata.city+' ' + stdata.state"></v-text-field>
            </v-col>
            
            <v-divider></v-divider>
            <v-col cols="2">
            <p >Fee Status</p>
            </v-col>
            <v-col cols="8">
            <v-text-field class="text-field-transparent" :rules="statusRule" :readonly="stdata.role!='Student'" v-model="stdata.fee_status"></v-text-field>
            </v-col>
            
            <v-divider></v-divider>
            <v-col cols="2">
            <p>Email</p>
            </v-col>
            <v-col cols="8">
            <v-text-field class="text-field-transparent"  readonly v-model="stdata.email"></v-text-field>
            </v-col>

            <v-divider></v-divider>
            <v-col cols="2">
            <p>Phone no</p>
            </v-col>
            <v-col cols="8">
            <v-text-field class="text-field-transparent" :rules="phoneRules"  :readonly="stdata.role!='Student'" v-model="stdata.phone"></v-text-field>
            </v-col>

            <v-divider></v-divider>
            <v-col cols="2">
            <p>Role</p>
            </v-col>
            <v-col cols="8">
            <v-text-field class="text-field-transparent"  readonly v-model="stdata.role"></v-text-field>
            </v-col>
            </v-row>
            <v-btn v-if="role=='Admin'&& stdata.role=='Student'" @click="updateData">Update</v-btn>
    </v-container>
</template>

<style>
p{
  margin-top: 20px;
}

</style>

<script>
import axios from 'axios'
import swal from 'sweetalert'
    export default{
        data(){
          return{
            yearRules:[v=>{
                    if(/^[1-4]{1}$/.test(v) ||!v)
                        return true
                    return 'Enter a valid year'
                    
                }],
            statusRule:[
                v=>{
                    if(v=="TRUE" || v== "FALSE" ||!v)
                    return true
                    return 'Not a valid Status'
                }
            ],
            phoneRules:[
                v=>{
                    if(/^[1-9]\d{9}$/.test(v))
                        return true
                    return 'Enter a valid phone'
                    
                }
            ],
            role:localStorage.getItem('role'),
            email:localStorage.getItem('email'),
            stdata:{fee_status:'',phone:'',year:''},
            stdataName:''
          }
        },
        methods:{
          updateData(){
            axios
        .get('http://localhost:3003/updateStData', { params: { stdata: this.stdata } })
        .then(response => {this.info = response
          console.log(response.data)
          if(response.data.bool==true)
          swal('Data Updated',"Student data has been updated","success")
          else
          swal("OOPS!!","Something went wrong","error")
          console.log(this.stdata)
        })
          },
          getData(){
            axios
        .get('http://localhost:3003/getStData', { params: { email: this.email } })
        .then(response => {this.info = response
          if(response.data.year==0)
          response.data.year=''
          this.stdata=response.data
          
          console.log(this.stdata)
        })
            
          }
        },
        mounted(){
          this.role=localStorage.getItem('role'),
          this.email=localStorage.getItem('email'),
          axios
        .get('http://localhost:3003/getStData', { params: { email: this.email } })
        .then(response => {this.info = response
          if(response.data.year==0)
          response.data.year=''
          this.stdata=response.data
          this.stdataName=this.stdata.first_name+this.stdata.last_name
          console.log(this.stdata)
        })
        }
    }
</script>