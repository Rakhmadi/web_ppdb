<template>
    <v-card>
    <v-card-title>
      User List
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="datan"
      :search="search"
    >


    </v-data-table>
  </v-card>
</template>
<script>
import Ax from 'axios'
export default {
    mounted() {
        Ax.post('api/usrc',{
             token:localStorage.getItem('tokensysAdmin'),
        }).then((resp)=>{
            this.datan=resp.data;
        })
    },
    data:()=>({
        search: '',
        headers: [

          { text: 'Nama', value: 'name' },
          { text: 'pass', value: 'pass' },
          { text: 'noreg', value: 'noreg' },
          { text: 'Created', value: 'created_at' },
          { text: 'Updated', value: 'updated_at' },

        ],
        datan:[]
    }),methods: {
        print(noreg){
             this.$router.push({ path: `cetak/${noreg}`})

        }
    },
}
</script>
