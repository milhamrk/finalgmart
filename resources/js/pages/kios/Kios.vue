<template>
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <router-link :to="{ name: 'kios.add' }" class="btn btn-info">Tambah</router-link>
                <div class="panel-body pt-0 row">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table display responsive product-overview mb-30" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Kios</th>
                                        <th>Pemilik</th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th>Rating</th>
                                        <th>Buka</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="kios in dKios" :key="kios.id_kios">
                                        <td class="txt-dark">{{kios.nama_kios}}</td>
                                        <td class="txt-dark">{{kios.nama_pemilik}}</td>
                                        <td>{{kios.email}}</td>
                                        <td>{{kios.no_hp}}</td>
                                        <td><svg xmlns="http://www.w3.org/2000/svg" fill="#ffff00" width="24" height="24" viewBox="0 0 24 24"><path d="M12 .288l2.833 8.718h9.167l-7.417 5.389 2.833 8.718-7.416-5.388-7.417 5.388 2.833-8.718-7.416-5.389h9.167z"/></svg><svg xmlns="http://www.w3.org/2000/svg" fill="#ffff00" width="24" height="24" viewBox="0 0 24 24"><path d="M12 .288l2.833 8.718h9.167l-7.417 5.389 2.833 8.718-7.416-5.388-7.417 5.388 2.833-8.718-7.416-5.389h9.167z"/></svg><svg xmlns="http://www.w3.org/2000/svg" fill="#ffff00" width="24" height="24" viewBox="0 0 24 24"><path d="M12 .288l2.833 8.718h9.167l-7.417 5.389 2.833 8.718-7.416-5.388-7.417 5.388 2.833-8.718-7.416-5.389h9.167z"/></svg><svg xmlns="http://www.w3.org/2000/svg" fill="#ffff00" width="24" height="24" viewBox="0 0 24 24"><path d="M12 .288l2.833 8.718h9.167l-7.417 5.389 2.833 8.718-7.416-5.388-7.417 5.388 2.833-8.718-7.416-5.389h9.167z"/></svg><svg xmlns="http://www.w3.org/2000/svg" fill="#ffff00" width="24" height="24" viewBox="0 0 24 24"><path d="M12 .288l2.833 8.718h9.167l-7.417 5.389 2.833 8.718-7.416-5.388-7.417 5.388 2.833-8.718-7.416-5.389h9.167z"/></svg></td>
                                        <td>
                                            <span v-if="kios.status_buka === 1" class="label label-success font-weight-100">Buka</span>
                                            <span v-else class="label label-danger font-weight-100">Tutup</span>
                                        </td>
                                        <td><router-link title="Edit" data-toggle="tooltip" class="text-inverse pr-10" :to="{ name: 'kios.edit', params: {id: kios.id_kios} }"><i class="zmdi zmdi-edit txt-grey"></i></router-link><a href="#" v-on:click="deleteData(kios.id_kios)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete txt-grey"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <p v-if="dKios.data"><i class="fa fa-bars"></i> {{ dKios.data.length }} item dari {{ dKios.meta.total }} total data</p>
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
      dKios: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      $axios.get("https://management.kiosrakyat.co.id/api/kios").then(response => {
        this.dKios = response.data;
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
                    $axios.delete("https://management.kiosrakyat.co.id/api/kios/" + id).then(response => {
                    this.loadData();
                  });
                }
            })
    }
  }
};
</script>
