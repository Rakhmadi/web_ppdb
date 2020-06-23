<template>
    <div>
        <v-row>
            <v-col cols="12" sm="6">
                <v-card>
                    <v-card-title primary-title>
                        Total User
                    </v-card-title>
                    <v-card-text>
                        <h1>{{user.total}}</h1>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" sm="6">
                <v-card>
                    <v-card-title primary-title>
                        Total User filled out the data
                    </v-card-title>
                    <v-card-text>
                        <h1>{{user.totalhas}}</h1>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col >
                <v-card>
                      <canvas id="my-chart" height="100vh" />
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script>
import Chart from 'chart.js';
import Ax from 'axios';
export default {
    data:()=>({
        label:'',
        datas:'',
        user:''
    }),
    mounted() {
          Ax.post('api/cekadmin',{
            token:localStorage.getItem('tokensysAdmin')
        }).then((resp)=>{
            console.log('logedchecked');
        }).catch((err)=>{
            this.$router.push({ path: 'adminlogin' })
        })
        Ax.get('api/dash').then((resp)=>{
            this.label=resp.data.map(list=>{
                return list.date
            });
            this.datas=resp.data.map(list=>{
                return list.totals
            });
            new Chart(document.getElementById('my-chart'), {
  type: 'line',
  data: {
    labels:this.label,
    datasets: [
      {
        label: 'User Data',
        data: this.datas,
         backgroundColor:'#6D3AD2',
         borderColor: '#6D3AD2'
      }
    ]
  }
});
        })

        Ax.get('api/totals').then((resp)=>{
            this.user=resp.data
        })
    },
}
</script>
