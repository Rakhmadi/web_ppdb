<template>
    <div>
         <v-app id="inspire">

    <v-navigation-drawer
      v-model="drawer"
      app
      clipped

      id="nav"
    >

      <v-list dense >
        <v-list-item link  to="/dashboard">
          <v-list-item-action>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>

        </v-list-item>

        <v-list-item link  to="/userlist">
          <v-list-item-action>
            <v-icon>mdi-account-multiple</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Data Peserta</v-list-item-title>
          </v-list-item-content>

        </v-list-item>

        <v-list-item link  to="/cpeng">
          <v-list-item-action>
            <v-icon>mdi-information-variant</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Buat Pengumuman</v-list-item-title>
          </v-list-item-content>

        </v-list-item>

         <v-list-item link  to="/userpass">
          <v-list-item-action>

          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Lihat pass User</v-list-item-title>
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
      <v-toolbar-title>PPDB Admin</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn @click="dialog = true" icon>
        <v-icon>mdi-account</v-icon>
      </v-btn>
  </v-app-bar>
    <v-main>
      <v-container>
       <router-view></router-view>
      </v-container>

       <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
      <v-card>
        <v-toolbar  rounded="false" dark style="background: rgb(102,126,234);
background: linear-gradient(137deg, rgba(102,126,234,1) 0%, rgba(118,75,162,1) 100%);
box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
          <v-btn icon dark @click="dialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>Management User</v-toolbar-title>
          <v-spacer></v-spacer>
            <v-btn @click="logout" icon> <v-icon color="danger">mdi-logout</v-icon></v-btn>
        </v-toolbar>
        <v-card-title primary-title>

        </v-card-title>
        <v-card-text>

              <v-row>
                  <v-col cols="12" sm="6">
                      <h2>Create New Admin</h2>
                  <v-text-field v-model="namead"  label="Username">
                  </v-text-field>
                  <v-text-field v-model="pasad" type="password"  label="Password">
                  </v-text-field>
                  <v-btn @click="addadmin()" color="primary">Create</v-btn>
             </v-col>
             <v-col cols="12" sm="6">
                 <h2>Create New User</h2>
                 <v-form>
                      <v-text-field
                     name="name"
                     label="Username"
                     v-model="user"
                     id="id"
                     :rules="required"
                     required
                 ></v-text-field>
                 <v-btn  @click="createduser" color="primary">Create</v-btn>
                 <v-row>
                     <v-col>
                         <h3>User :{{userresp.nama}}</h3>
                         <br>
                        <h3>pass :{{userresp.password}}</h3>
                         <br>
                        <h3>Noreg :{{userresp.noreg}}</h3>
                     </v-col>
                 </v-row>
                 </v-form>
             </v-col>
              </v-row>

        </v-card-text>
      </v-card>
    </v-dialog>

    </v-main>
  </v-app>
    </div>
</template>
<script>
import Ax from 'axios'
export default {
     mounted() {
        Ax.post('api/cekadmin',{
            token:localStorage.getItem('tokensysAdmin')
        }).then((resp)=>{
            console.log('logedchecked');
        }).catch((err)=>{
            this.$router.push({ path: 'adminlogin' })
        })
    },
    data: () => ({
      drawer: null,
      cartc:'',
       dialog: false,
        notifications: false,
        sound: true,
        widgets: false,
        userresp:'',
        user:'',
        namead:'',
        pasad:'',
        required: [
        v => !!v || 'is required',
      ],

    }),
    methods: {
        createduser(){
            Ax.post('api/adduser',{
                token:localStorage.getItem('tokensysAdmin'),
                name:this.user
            }).then(resp=>{
                this.userresp=resp.data
            }).catch(err=>{
                alert(err);
            })

        },
        addadmin(){
            if (true) {

            }
                Ax.post('api/addadmin',{
                    nama:this.namead,
                    password:this.pasad,
                }).then(resp=>{
                    alert('success');
                }).catch(resp=>{
                    alert(err);
                })
        },
        logout(){
            Ax.post('api/logoutadmin',{
                token:localStorage.getItem('tokensysAdmin'),
            }).then(resp=>{
                alert('Success')
                localStorage.removeItem('tokensysAdmin');
                this.$router.push({ path: '/adminlogin'})
            }).catch(err=>{
                alert(err)
            })
        }

    },
}
</script>
