<template>
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <router-link :to="{ name: 'konsumen.add' }" class="btn btn-info">Tambah</router-link>
                <div class="panel-body pt-0 row">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table display responsive product-overview mb-30" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="kons in konsumen" :key="kons.id">
                                        <td>{{kons.nama}}</td>
                                        <td>{{kons.email}}</td>
                                        <td>{{kons.no_hp}}</td>
                                        <td><router-link title="Edit" data-toggle="tooltip" class="text-inverse pr-10" :to="{ name: 'konsumen.edit', params: {id: kons.id_konsumen} }"><i class="zmdi zmdi-edit txt-grey"></i></router-link><a href="#" v-on:click="deleteData(kons.id_konsumen)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete txt-grey"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <p v-if="konsumen.data"><i class="fa fa-bars"></i> {{ konsumen.data.length }} item dari {{ konsumen.meta.total }} total data</p>
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
      konsumen: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      $axios.get("http://localhost:8000/api/konsumen").then(response => {
        this.konsumen = response.data;
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
                    $axios.delete("http://localhost:8000/api/konsumen/" + id).then(response => {
                    this.loadData();
                  });
                }
            })
    }
  }
};
</script>
