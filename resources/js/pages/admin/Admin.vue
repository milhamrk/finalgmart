<template>
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <router-link :to="{ name: 'admin.add' }" class="btn btn-info">Tambah</router-link>
                <div class="panel-body pt-0 row">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table display responsive product-overview mb-30" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Kota</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="admin in admins" :key="admin.id">
                                        <td>{{admin.name}}</td>
                                        <td>{{admin.email}}</td>
                                        <td>{{admin.city_name}}</td>
                                        <td><router-link title="Edit" data-toggle="tooltip" class="text-inverse pr-10" :to="{ name: 'admin.edit', params: {id: admin.id} }"><i class="zmdi zmdi-edit txt-grey"></i></router-link><a href="#" v-on:click="deleteData(admin.id)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete txt-grey"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <p v-if="admins.data"><i class="fa fa-bars"></i> {{ admins.data.length }} item dari {{ admins.meta.total }} total data</p>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right">
                                
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
   
</template>

<script>
import { mapActions, mapState } from 'vuex'
import $axios from '../../api.js'

export default {
  data() {
    return {
      admins: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      $axios.get("/admin").then(response => {
        this.admins = response.data;
      });
    },
    deleteData(id) {
        this.$swal({
                title: 'Kamu Yakin?',
                text: "Tindakan ini akan menghapus secara permanent!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, Lanjutkan!'
            }).then((result) => {
                if (result.value) {
                    $axios.delete("/admin/" + id).then(response => {
                    this.loadData();
                  });
                }
            })
    }
  }
};
</script>
