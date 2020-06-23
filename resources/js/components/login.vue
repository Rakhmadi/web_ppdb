<template>
   <v-app id="inspire">
      <v-main>
        <v-container
          class="fill-height"
          fluid
        >
          <v-row
            align="center"
            justify="center"
          >
            <v-col
              cols="12"
              sm="8"
              md="4"
            >
              <v-card class="elevation-4">
                <v-toolbar
                   style="background: rgb(102,126,234);
background: linear-gradient(137deg, rgba(102,126,234,1) 0%, rgba(118,75,162,1) 100%);"
                  dark
                  flat
                >
                  <v-toolbar-title>Siswa Login</v-toolbar-title>
                  <v-spacer></v-spacer>
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                    </template>
                    <span>Source</span>
                  </v-tooltip>
                </v-toolbar>
                <v-card-text>
                  <v-form>
                    <v-text-field
                      label="Login"
                      name="login"
                      prepend-icon="mdi-account"
                      type="text"
                      v-model="names"
                    ></v-text-field>

                    <v-text-field
                      id="password"
                      label="Password"
                      name="password"
                      prepend-icon="mdi-lock"
                      type="password"
                      v-model="passwords"
                    ></v-text-field>
                  </v-form>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn @click="login()" color="primary">Login</v-btn>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </v-container>
      </v-main>
    </v-app>
</template>
<script>
import Ax from 'axios';
export default {
    data:()=>({
        names:'',
        passwords:'',
    }),
    methods: {
        login(){
            const t=this;
            Ax.post('api/login',{
                name:t.names,
                password:t.passwords
            }).then((resp)=>{
                localStorage.setItem("token",resp.data.token);
                this.$router.push({ path: '/Home'})
            }).catch((err)=>{
                alert('Error');
            })
        }
    },

}
</script>
