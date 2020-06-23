<template>
  <v-app id="inspire">

      <v-navigation-drawer
      v-model="drawer"
      app
      absolute
      temporary
    >
      <v-list dense>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item link>
          <v-list-item-action>
            <v-icon>mdi-email</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Contact</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>


    <v-app-bar
      app
      color="white"
    >
      <v-app-bar-nav-icon class="hidden-md-and-up" @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>PPDB</v-toolbar-title>
      <v-spacer></v-spacer>

           <v-btn @click="login()" class="ma-1" small outlined color="indigo">Login Siswa</v-btn>
            <v-btn @click="admin()" class="ma-1" small dark color="indigo">Login Admin</v-btn>
    </v-app-bar>


    <v-main>
      <v-container

        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col class="text-center">
            <v-tooltip left>
              <template v-slot:activator="{ on }">
                <v-btn
                  :href="source"
                  icon
                  large
                  target="_blank"
                  v-on="on"
                >
                  <v-icon large>mdi-code-tags</v-icon>
                </v-btn>
              </template>
              <span>Source</span>
            </v-tooltip>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
  export default {
    props: {
      source: String,
    },
    data: () => ({
      drawer: false,
    }),
    methods: {
        login(){
            this.$router.push({ path: '/login'})
        },
         admin(){
            this.$router.push({ path: '/adminlogin'})
        }
    },
  }
</script>
