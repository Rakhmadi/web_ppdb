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
   <template v-slot:item="row">
          <tr>
            <td>{{row.item.name}}</td>
            <td>{{row.item.noreg}}</td>
             <td>{{row.item.admin_input}}</td>
              <td>{{row.item.created_at}}</td>
               <td>{{row.item.updated_at}}</td>
            <td>
                <v-btn class="mx-2" icon dark color="primary" @click="print(row.item.noreg)">
                    <v-icon dark>mdi-printer</v-icon>
                </v-btn>
            </td>
          </tr>
      </template>

    </v-data-table>
  </v-card>
</template>
<script>
import Ax from 'axios'
export default {
    mounted() {
        Ax.get('api/alluser').then((resp)=>{
            this.datan=resp.data;
        })
    },
    data:()=>({
        search: '',
        headers: [

          { text: 'Nama', value: 'name' },
          { text: 'Noreg', value: 'noreg' },
          { text: 'Admin', value: 'admin_input' },
          { text: 'Created', value: 'created_at' },
          { text: 'Updated', value: 'updated_at' },
          { text: 'Print', value: 'id' },
        ],
        datan:[]
    }),methods: {
        print(noreg){
             this.$router.push({ path: `cetak/${noreg}`})

        }
    },
}
</script>
