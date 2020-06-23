<template>
<v-app>
     <div>
        <v-row>
            <v-col>
                <v-card>
                   <v-card-text>
                      <div >
                           <v-row id="tt">
                           <v-col >
                               <v-card  >
                               <v-card-text>
                                   <center> <h1>Data peserta</h1> </center>
                                   <br>
                                      <v-simple-table dense>
    <template v-slot:default>
      <thead>

      </thead>
      <tbody>
        <tr>
          <td>Nama Lengkap</td>
          <td>{{datas.namalengkap}}</td>
        </tr>
          <tr>
          <td>Nisn</td>
          <td>{{datas.nisn}}</td>
        </tr>
         <tr>
          <td>Noreg</td>
          <td>{{datas.noreg}}</td>
        </tr>


         <tr>
           <td>Tempat tgl Lahir</td>
          <td>{{datas.tmplahir}},{{datas.tgllahir}}</td>
        </tr>
         <tr>
           <td>Agama</td>
          <td>{{datas.agama}}</td>
        </tr>
         <tr>
           <td>Jenis kelamin</td>
          <td>{{datas.jeniskelamin}}</td>
        </tr>
         <tr>
           <td>Asal Sekolah</td>
          <td>{{datas.asalsekolah}}</td>
        </tr>
         <tr>
           <td>Alamat</td>
          <td>{{datas.alamat}}</td>
        </tr>
         <tr>
           <td>No Hp</td>
          <td>{{datas.no_hp}}</td>
        </tr>

         <tr>
           <td>Jurusan 1</td>
          <td>{{datas.prod}}</td>
        </tr>
         <tr>
           <td>jurusan 2</td>
          <td>{{datas.prod1}}</td>
        </tr>


      </tbody>
    </template>
  </v-simple-table>


                               </v-card-text>
                           </v-card>
                           </v-col>
                       </v-row>
                      </div>
                   </v-card-text>
                   <v-card-actions>
                       <v-btn @click="printDiv" flat icon color="primary" >
                           <v-icon>mdi-printer</v-icon>
                       </v-btn>
                   </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </div>
</v-app>

</template>
<script>
import Ax from 'axios';

export default {
    mounted() {
        const y=this
        const t=localStorage.getItem('token')
         Ax.post(`api/cetak2`,{
             token:t
         }).then(resp=>{
                this.datas=resp.data
                console.log(resp.data.namalengkap)
            })
    },
    data:()=>({
        datas:'',
        noreg:''
    }),
    methods: {
        rr(){


        },
        printDiv() {
     window.print();

}
    },
}
</script>
<style>
              @media print {
    body * {
      visibility: hidden;
      margin: 0;
      padding:0;
    }
    #tt, #tt * {
      visibility: visible;
      width: 100%;
      box-shadow: none;
    }
    #nav,#navbar{

        visibility: hidden;

    }
    #tt {
      position: absolute;
      left: 0;
      top: 0;
    }
  }
</style>
