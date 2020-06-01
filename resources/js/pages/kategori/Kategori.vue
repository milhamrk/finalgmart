<template>
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <router-link v-if="role === '1'" :to="{ name: 'kategori.add' }" class="btn btn-info">Tambah</router-link>
                <div class="panel-body pt-0 row">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table display responsive product-overview mb-30" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th v-if="role === '1'">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="kategori in kategoris" :key="kategori.id">
                                        <td>{{kategori.nama_kategori}}</td>
                                        <td v-if="role === '1'"><router-link title="Edit" data-toggle="tooltip" class="text-inverse pr-10" :to="{ name: 'kategori.edit', params: {id: kategori.id_kategori} }"><i class="zmdi zmdi-edit txt-grey"></i></router-link><a href="#" v-on:click="deleteData(kategori.id_kategori)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete txt-grey"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <p v-if="kategoris.data"><i class="fa fa-bars"></i> {{ kategoris.data.length }} item dari {{ kategoris.meta.total }} total data</p>
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
      kategoris: [],
      role: ''
    };
  },
  created() {
    this.loadData();
    this.role = localStorage.getItem('role');
  },
  methods: {
    loadData() {
      $axios.get("http://localhost:8000/api/kategori").then(response => {
        this.kategoris = response.data;
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
                    $axios.delete("http://localhost:8000/api/kategori/" + id).then(response => {
                    this.loadData();
                  });
                }
            })
    }
  }
};
</script>
