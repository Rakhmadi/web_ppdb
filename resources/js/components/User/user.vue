<template>

  <div>
      <v-alert dismissible type="success" :value="alert">
      Data Tersimpan
    </v-alert>
    <v-alert dismissible :value="alert2" type="info">
      Semua Data Sudah Terisi
    </v-alert>
        <v-stepper v-model="e6" vertical>
    <v-stepper-step :complete="e6 > 1" step="1">

      Data Diri
    </v-stepper-step>

    <v-stepper-content step="1">
        <h2>Lengkapi Data Diri</h2>
        <v-row>
            <v-col cols="12" sm="6">
          <v-text-field
          name="name"
          label="Nama Lengkap"
           v-bind:value="datan.namalengkap"
          v-model="namalengkap"

      ></v-text-field>

      <v-text-field
          name="name"
          label="NISN"
          v-model="nisn"

      ></v-text-field>
      <v-text-field
          name="name"
          label="Tempat Lahir"

          v-model="tempatlahir"
      ></v-text-field>
      <v-menu
          v-model="menu2"
          :close-on-content-click="false"
          :nudge-right="40"
          transition="scale-transition"
          offset-y
          full-width
          min-width="290px"
        >
          <template v-slot:activator="{ on }">
            <v-text-field
              v-model="tgllahir"
              label="Tanggal Lahir"
              prepend-icon="mdi-calendar"
              readonly
              v-on="on"
            ></v-text-field>

          </template>
          <v-date-picker v-model="tgllahir" @input="menu2 = false"></v-date-picker>
        </v-menu>
          <v-select
                v-bind:items="agama"
                v-model="agamas"
                label="Agama"
            ></v-select>
            <v-select
                :items="items"
                v-model="jenklamin"
                label="Jenis Kelamin"
            ></v-select>
            <v-text-field
                name="name"
                label="Asal Sekolah"
                v-model="asalsek"

            ></v-text-field>
             <v-text-field
                name="name"
                label="NoTelp / Wa"
                v-model="nophone"

            ></v-text-field>
             <v-text-field
                name="name"
                label="Alamat"
                v-model="alamat"

            ></v-text-field>

      </v-col>
        </v-row>
      <v-btn color="primary" @click="e6 = 2">Next</v-btn>

    </v-stepper-content>

    <v-stepper-step  :complete="e6 > 2" step="2">
        Upload Berkas
    </v-stepper-step>

    <v-stepper-content step="2">

              <v-row>
                  <v-col cols="12" sm="6">
                              <v-img :src="`image/${datan.upload_kk}`"></v-img>
                      <v-file-input v-model="file1" label="Upload KK"></v-file-input>
                                 <v-img :src="`image/${datan.akte}`" ></v-img>
                      <v-file-input v-model="file2" label="Upload Akte"></v-file-input>
                  </v-col>
              </v-row>


      <v-btn color="primary" @click="e6 = 3">Next</v-btn>

    </v-stepper-content>

    <v-stepper-step :complete="e6 > 3" step="3">
       Pilihan Kompetensi Keahlian
    </v-stepper-step>

    <v-stepper-content step="3">
          <h1 color="error">{{val}}</h1>
       <v-row>

           <v-col cols="12" sm="6">
                <v-select
                v-bind:items="jur"
                v-model="jur_1"
                label="Jurusan yang di minati"
                @change="hal"
            ></v-select>
            <v-select
                v-bind:items="jur2"
                v-model="jur_2"
                label="Pilih jurusan ke dua"
                @change="hal"
            ></v-select>
           </v-col>
       </v-row>



    </v-stepper-content>

  </v-stepper>
  <v-row>
        <v-col>
            <v-btn @click="save()" color="primary"><v-icon>mdi-content-save</v-icon></v-btn>
            <v-btn  @click="df"  color="primary"><v-icon>mdi-pencil</v-icon></v-btn>
        </v-col>
   </v-row>
  </div>

</template>
<script>
import Ax from 'axios';
  export default {
    data () {
      return {
        e6: 1,
        date: new Date().toISOString().substr(0, 10),
    menu: false,
    modal: false,
    menu2: false,
     agama: [
        'Islam',
        'Kristen',
        'Katolik',
        'Hindu',
        'Budha',
      ],
       items: [
        'Laki-laki',
        'prempuan'
      ],
      jur: [
        'TKJ',
        'TITL',
        'TKR',
        'TP',
        'TAV'
      ],
       jur2: [
        'TKJ',
        'TITL',
        'TKR',
        'TP',
        'TAV'
      ],
      alert:false,
      alert2:false,
      jur_1:'',
      jur_2:'',
      val:'',
      datan:'',

      namalengkap:'',
      nisn:'',
      tempatlahir:'',
      tgllahir: null,
      agamas:'',
      jenklamin:'',
      asalsek:'',
      nophone:'',
      file1:[],
      file2:[],
      jurusan1:'',
      jurusan2:'',
      alamat:'',
      si:''



      }
    },methods: {
        hal(){

             if (this.jur_1 == '' || this.jur_2=='') {
                    this.val='Data harus di isi'
                }
                else{
                     if (this.jur_1 == this.jur_2) {
                this.val='Tidak boleh sama'
            }else{
                this.val=''

            }
                }

        },
        df(){
            this.e6 =1
        },
        save(){
            const fd=new FormData();
            fd.append('namalengkap',this.namalengkap);
            fd.append('nisn',this.nisn);
            fd.append('tmplahir',this.tempatlahir);
            fd.append('tgllahir',this.tgllahir);
            fd.append('agama',this.agamas);
            fd.append('jeniskelamin',this.jenklamin);
            fd.append('asalsekolah',this.asalsek);
            fd.append('alamat',this.alamat);
            fd.append('no_hp',this.nophone);
            fd.append('upload_kk',this.file1,);
            fd.append('akte',this.file2);
            fd.append('prod',this.jur_1);
            fd.append('prod1',this.jur_2);
             fd.append('token',localStorage.getItem('token'));
            Ax.post('api/lengkapidata',fd,{
               headers: {
                    'Content-Type': 'multipart/form-data'
                }}).then(resp=>{
                    this.alert=true;
                    this.ff()
                alert('sucess');
            }).catch(err=>{
                alert(err);
            })



        },
        ff(){
             Ax.post('api/cek',{
             token:localStorage.getItem('token')
        }).then(resp=>{
            if (resp.data.msg == true) {
                this.alert2=true;
            } else {
                 this.alert2=false;

            }
        })
        }




    },
    mounted() {

        Ax.post('api/usershow',{
             token:localStorage.getItem('token')
        }).then(resp=>{
            this.datan=resp.data
             this.namalengkap=resp.data.namalengkap
             this.nisn=resp.data.nisn
             this.tempatlahir=resp.data.tmplahir
             this.tgllahir=resp.data.tgllahir
             this.agamas=resp.data.agama
             this.jenklamin=resp.data.jeniskelamin
             this.asalsek=resp.data.asalsekolah
             this.alamat=resp.data.alamat
             this.nophone=resp.data.no_hp
             this.jur_1=resp.data.prod
             this.jur_2=resp.data.prod1
        })
        this.ff()

    }
  }
</script>
