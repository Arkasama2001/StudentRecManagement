<template>
    <v-row style="margin-top: 10px;">
        <v-col cols="2"><v-autocomplete auto-select-first label="Year" v-model="year"
                :items="[1, 2, 3, 4]"></v-autocomplete></v-col>
        <v-col cols="2">

            <v-dialog width="500" v-model="dialogOpen">
                <template v-slot:activator="{ props }">
                    <v-text-field v-bind="props" label="Select Start Date" v-model="date2" readonly></v-text-field>
                </template>

                <template v-slot:default="{ isActive }">
                    <v-date-picker v-model="date1" justify="space-around" @click:cancel="dialogOpen = false"
                        @click:save="f1"></v-date-picker>
                </template>
            </v-dialog>
        </v-col>
    <v-col>
    <v-btn color="blue-accent-2" style="margin-top: 10px;" class="me-4" @click="Submit" text="Search"></v-btn>
    </v-col>
    </v-row>
    


    <v-text-field
        v-model="search"
        append-inner-icon="mdi-magnify"
        label="Search"
        single-line
        hint="Search true for present students"
        hide-details
        style="margin-left: 10px;width: 500px;"
      ></v-text-field>

    <v-data-table :search="search" :sort-by="[{ key: 'roll', order: 'asc' }]" style="margin-left: 10px;" v-model:items-per-page="itemsPerPage" :headers="headers" :items="items" item-value="roll"
        class="elevation-1">
    
    </v-data-table>
</template>

<script>
import axios from 'axios'
export default {

    data() {
        return {
            itemsPerPage:10,
            search:'',
            headers:[{
                    title: 'Roll No',
                    align: 'start',
                    key: 'roll',
                },
                { title: 'Days Present', align: 'center', key: 'cnt' },
                ],
            date2: '',
            dialogOpen: false,
            Active: true,
            items: [],
            department: localStorage.getItem['department'],
            role: localStorage.getItem['role'],
            year: 1,
            date1: '2000-1-25',
        }
    },
    methods: {
        f1() {
            this.$nextTick(() => {
                const date = new Date(this.date1);

                // Get day, month, and year components
                const year = date.getFullYear();
const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is zero-based, so add 1
const day = String(date.getDate()).padStart(2, '0');

                // Format components as "d-m-Y"
                this.date2 = `${year}-${month}-${day}`;
                this.dialogOpen = false
            })


        },
        
        Submit() {
            axios
                .get('http://localhost:3003/PresentAttendance', { params: { department: localStorage.getItem('department'), year: this.year, date: this.date2 } })
                .then(response => {
                    this.info = response

                    this.items = response.data

                    console.log(this.items)
                })
        }
    }

}

</script>