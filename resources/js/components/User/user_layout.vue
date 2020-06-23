<template>
    <div>
         <v-app id="inspire">

    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
      dark
    >

      <v-list dense >
        <v-list-item link  to="/home">
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>

        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar
      app
      clipped-left
    id="navbar"
    dark
    style="background: rgb(102,126,234);
background: linear-gradient(137deg, rgba(102,126,234,1) 0%, rgba(118,75,162,1) 100%);
box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);"
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>PPDB</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn @click="ffd()"  icon color="" >
          <v-icon>mdi-printer</v-icon>
      </v-btn>
      <v-btn @click="uu"  icon >
          <v-badge
          dot
          color="error">
            <v-icon>mdi-information-variant</v-icon>
          </v-badge>

      </v-btn>
      <v-btn @click="logout" icon>

        <v-icon>mdi-logout</v-icon>
      </v-btn>
  </v-app-bar>
    <v-main>
      <v-container>
       <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
    </div>
</template>
<script>
import Ax from 'axios'
export default {
    created(){
           console.log('Hellocompoonents');
    },
    mounted() {
         const y=this
        const t=localStorage.getItem('token')
         Ax.get(`api/cetak2/${t}`).then(resp=>{
                this.datas=resp.data
                console.log(resp.data.namalengkap)
            })


        Ax.post('api/logincek',{
            token:localStorage.getItem('token')
        }).then((resp)=>{
            console.log('logedchecked');
        }).catch((err)=>{
            this.$router.push({ path: 'login' })
        })
    },
    data: () => ({
      drawer: null,
      cartc:'',
       dialog: false,
        notifications: false,
        sound: true,
        widgets: false,
    }),methods: {
        uu(){
            this.$router.push({ path: 'pagepeng' })
        },logout(){
            Ax.post('api/logout',{
                token:localStorage.getItem('token')
            }).then(resp=>{
                alert('success')
                localStorage.removeItem('token');
                 this.$router.push({ path: 'login' })
            })
        }, ffd(){
            this.$router.push({ path: 'cetak2' })
        },
    },
}
</script>
