<template>
    <div>
        <v-row>
            <v-col>
                <v-alert v-for="iu in datans" :key="iu.id"
      icon="mdi-information"
      prominent
      text
      type="info"
    >
      {{iu.isi}}
    </v-alert>
            </v-col>
        </v-row>
    </div>
</template>
<script>
import Ax from 'axios';
export default {
    mounted(){
        Ax.get("api/pengumuman").then(resp=>{
            this.datans=resp.data

        })

    },
    data:()=>({
        datans:'',

    }),

}
</script>
