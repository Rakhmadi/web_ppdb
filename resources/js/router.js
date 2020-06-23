import Vue from "vue";
import vRouter from 'vue-router'
import panel from './components/panel'
import sistem from './components/sistem'
import dash from './components/dash'
import login from './components/login'
import adminlogin from './components/adminlogin'
import userlist from './components/userlist'
import cpeng from './components/cpeng'
import cetak from './components/pagecetak'
import c from './components/userpass'
import layusr from './components/User/user_layout'
import homeuser from './components/User/user'
import pagepeng from './components/User/pagepeng'
import pageprint from './components/User/pageprint'
Vue.use(vRouter);

export default new vRouter({
    routes:[
        {
            path:'/',
            name:'homes',
            component:panel,
        },
        {
            path:'/login',
            name:'login',
            component:login,
        },
        {
            path:'/adminlogin',
            name:'adminlogin',
            component:adminlogin,
        },
        {
            path:'/cetak/:noreg',
            name:'cetak',
            component:cetak,
            props: true
           },
           {
            path:'/cetak2',
            name:'pageprint',
            component:pageprint,

           },
        {
            path:'/sistem',
            name:'sistem',
            component:sistem,
            children:[
               {
                path:'/dashboard',
                name:'dash  ',
                component:dash,
               },
               {
                path:'/userlist',
                name:'userlist',
                component:userlist,
               },
               {
                path:'/cpeng',
                name:'cpeng',
                component:cpeng,
               },

               {
                path:'/userpass',
                name:'userpass',
                component:c,
               }
               ]
            },
            {
                path:'/User_management',
                name:'User',
                component:layusr,
                children:[
                   {
                    path:'/home',
                    name:'homeusr',
                    component:homeuser,
                   },
                   {
                    path:'/pagepeng',
                    name:'pagepeng',
                    component:pagepeng,
                   }
                   ]
                }
        ]
})
