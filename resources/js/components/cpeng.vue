<template>
    <div>
        <v-row>
            <v-col>
                <v-card>
                    <v-card-title primary-title>
                        Buat Pengumuman
                    </v-card-title>
                    <v-card-text>
                       <v-col>
                             <v-textarea
                             v-model="pengs"
                               label="Isi"
                             ></v-textarea>
                            <v-btn flat  @click="add" small color="primary">Save</v-btn>
                       </v-col>

                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row  v-for="gg in peng" :key="gg.id">
            <v-col>

                    <v-card >
                        <v-card-text>
                            {{gg.isi}}
                        </v-card-text>
                        <v-card-actions>
                            <v-btn icon @click="del(gg.id)" color="error"><v-icon>mdi-delete</v-icon></v-btn>
                        </v-card-actions>
                    </v-card>

            </v-col>
        </v-row>
    </div>
</template>
<script>
import Ax from 'axios';
export default {
    data:()=>({
        peng:'',
        pengs:''

    }),
    mounted() {
        this.kk()



    },
    methods: {
        add(){
            Ax.post('api/addpengumuman',{
                isi:this.pengs

            }).then(resp=>{
                alert('success');
                this.kk()
            }).catch(err=>{
                alert(err);
            })
        },
        del(id){
            Ax.delete(`api/deletepengumuman/${id}`).then(resp=>{
                alert('success');
                this.kk();
            }).catch(err=>{
                alert(err)
            })

        },
        kk(){
             Ax.get('api/pengumuman').then(resp=>{
            this.peng=resp.data
        })
        },


    },
}
</script>
