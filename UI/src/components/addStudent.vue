<template>
    <v-container>

        <v-form ref="form">
        <v-row>
            <v-col cols="3">
                <p>Name</p>
            </v-col>
            <v-col cols="4">
                <v-text-field class="text-field-transparent" label="First Name" v-model="stdata.fName"></v-text-field>
            </v-col>
            <v-col cols="4">
                <v-text-field class="text-field-transparent" label="Last Name" v-model="stdata.lName"></v-text-field>
            </v-col>
            <v-col cols="3">
                <p>Roll no</p>
            </v-col>
            <v-col cols="9">
                <v-text-field class="text-field-transparent" :rules="rollRule" label="Roll no" v-model="stdata.rollno"></v-text-field>
            </v-col>
            <v-col cols="3">
                <p>Year</p>
            </v-col>
            <v-col cols="9">
                <v-text-field class="text-field-transparent" :rules="yearRules" label="Year" v-model="stdata.year"></v-text-field>
            </v-col>
            <v-col cols="3">
                <p>Department</p>
            </v-col>
            <v-col cols="9">
                <v-text-field class="text-field-transparent" label="Department" hint="MCA,BTECH,Administration"
                    v-model="stdata.Department"></v-text-field>
            </v-col>
            <v-col cols="3">
                <p>Date of Birth</p>
            </v-col>
            <v-col cols="9">
                <v-text-field class="text-field-transparent" :rules="dateRule" label="Date of Birth" hint="dd-mm-yyyy" required
                    v-model="stdata.Date_of_Birth"></v-text-field>
            </v-col>
            <v-col cols="3">
                <p>Address</p>
            </v-col>
            <v-col cols="4">
                <v-text-field class="text-field-transparent" label="City" v-model="stdata.city"></v-text-field>
            </v-col>
            <v-col cols="4">
                <v-text-field class="text-field-transparent" label="State" v-model="stdata.state"></v-text-field>
            </v-col>
            <v-col cols="3">
                <p>Fee Status</p>
            </v-col>
            <v-col cols="9">
                <v-text-field class="text-field-transparent" hint="TRUE, FALSE" :rules="statusRule" label="Fee-Status" v-model="stdata.fee_status"></v-text-field>
            </v-col>
            <v-col cols="3">
                <p>Email</p>
            </v-col>
            <v-col cols="9">
                <v-text-field class="text-field-transparent" :rules="emailRules" label="Email"
                    v-model="stdata.email"></v-text-field>
            </v-col>
            <v-col cols="3">
                <p>Phone no</p>
            </v-col>
            <v-col cols="9">
                <v-text-field class="text-field-transparent" :rules="phoneRules" label="Phone no" v-model="stdata.phone"></v-text-field>
            </v-col>
            <v-col cols="3">
                <p>Password</p>
            </v-col>
            <v-col cols="9">
                <v-text-field class="text-field-transparent" required :rules="passwRule" label="Password" v-model="stdata.password"></v-text-field>
            </v-col>
            <v-col cols="3">
                <p>Role</p>
            </v-col>
            <v-col cols="9">
                <v-text-field class="text-field-transparent" hint="Teacher, Student, Admin" :rules="roleRule" label="Role" v-model="stdata.role"></v-text-field>
            </v-col>
        </v-row>
        <v-btn class="e-4" @click="validate">Submit</v-btn>
    </v-form>
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
export default {
    data() {
        return {
            stdata:{
            fName: '',
            lName: '',
            rollno: '',
            year: '',
            Department: '',
            Date_of_Birth: '',
            city: '',
            state: '',
            fee_status: '',
            email: '',
            phone: '',
            password:'',
            role:'',
            },
            passwRule:[
                v=>{
                    if(!v)
                    return "Field cannot be empty"
                    else if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(v))
                    return true
                    else
                    return "Password must contain atleast 1 lowercase, uppercase, number and special character"
                }
            ],
            roleRule:[
                v=>{
                    if(v=="Student" || v=="Teacher" || v=="Admin")
                    return true
                    return 'Field must contain values Teacher,Student or Admin'
                return true
                }
            ],
            rule:[
                v=>{
                    if(!v)
                    return "Field cannot be empty"
                }
            ],
            rollRule:[
                v=>{
                    if(/^[0-9]\d{0,5}$/.test(v)||!v)
                        return true
                    return 'Enter a valid roll'
                    
                }
            ],
            dateRule:[v=>{
                    if(/^([0-9]{2})\-([0-9]{2})\-([0-9]{4})$/.test(v))
                        return true
                    return 'Enter a valid Day'
                    
                }],
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
            emailRules: [
                v => {
                    if (!v) {
                        return 'Email cannot be blank'
                    }
                    if (/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v))
                        return true
                    return 'Enter a valid email'
                }
            ],
        }
    },
    methods: {
        async validate () {
        const { valid } = await this.$refs.form.validate()

        if (valid) this.addStudent()
      },
        addStudent() {
            var that=this
            axios
            .get('http://localhost:3003/addStudent', { params: { Student: this.stdata } })
                .then(response => {
                    this.info = response
                    if(response.data.bool==true)
                    {
                    swal("User added")
                    that.$refs.form.reset()
                    }
                    else{
                        swal("User addition failed....Roll no may be pre-existent")
                    }
                })
        }
    },
    mounted(){
        console.log(localStorage.getItem('loggedIn'))
    }

}
</script>