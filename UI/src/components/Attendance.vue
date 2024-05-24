<template>
    <v-row >
        <v-col cols="2">
            <v-autocomplete style="margin-left:10px" auto-select-first label="Year"
                v-model="year" :items="[1, 2, 3, 4]"></v-autocomplete>
        </v-col>
        <v-col cols="3">
            <v-text-field  v-model="search" append-inner-icon="mdi-magnify" label="Search" single-line hide-details
            style=""></v-text-field></v-col>
    </v-row>
    <v-data-table :search="search" :sort-by="[{ key: 'roll', order: 'asc' }]" style="margin-left: 10px;"
        v-model:items-per-page="itemsPerPage" :headers="headers" :items="items" item-value="email" class="elevation-1">

        <template v-slot:item.isPresent="{ item }">
            <div class="center">
                <v-checkbox-btn color="primary" v-model="item.isPresent"></v-checkbox-btn>
            </div>
        </template>

    </v-data-table>
    <v-row style="justify-content: flex-end;margin-top: 10px;">
        <v-btn justify="space-around" color="blue-accent-2"
            style="display: flex;flex-direction: row-reverse; margin-left: 10px;margin-right: 10px;" class="me-4"
            @click="updateTable" v-if="role == 'Teacher'">
            Update

        </v-btn>
    </v-row>
</template>

<style></style>



<script>
import axios from 'axios'
import swal from 'sweetalert'
export default {
    data() {
        return {
            search: '',
            itemsPerPage: 10,
            items: [],
            role: localStorage.getItem('role'),
            year: 1,
            headers: [
                {
                    title: 'Email',
                    align: 'start',
                    key: 'email',
                },
                { title: 'Roll No', align: 'center', key: 'roll' },
                { title: 'Is Present', align: 'left', key: 'isPresent', sortable: false },
            ],
        }
    },
    watch: {
        year(newValue) {
            this.f1()
        }
    },
    methods: {
        f1() {
            axios
                .get('http://localhost:3003/getAttendanceData', { params: { department: localStorage.getItem('department'), year: this.year } })
                .then(response => {
                    this.info = response

                    this.items = response.data

                    console.log(this.items)
                })
        },

        updateTable() {
            axios
                .get('http://localhost:3003/UpdateAttendance', { params: { Students: this.items, department: localStorage.getItem('department'), year: this.year } })
                .then(response => {
                    this.info = response
                    if(response.data.bool==true)
                    swal("Records Updated.","The Student Attendance has been updated","success")
                    else
                    swal("OOPS!!","Something went wrong try again.","error")
                })
        }


    },
    mounted() {
        this.f1()
    },

}
</script>