<template>
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <router-link v-if="role === '1'" :to="{ name: 'barang.add' }" class="btn btn-info">Tambah</router-link>
                <a href="/produk/export" class="btn btn-info">Export</a>
                <router-link v-if="role === '1'" :to="{ name: 'barang.add' }" class="btn btn-info">Import</router-link>
                <router-link v-else :to="{ name: 'barang.pesan' }" class="btn btn-info">Pesan Produk</router-link>
                <div class="panel-body pt-0 row">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table display responsive product-overview mb-30" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Kategori</th>
                                        <th>Merk</th>
                                        <th>Varian/Gr</th>
                                        <th v-if="role !== '1'">Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th v-if="role === '1'">Actions</th>
                                        <th v-else>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="produk in produks" :key="produk.id_produkkoperasi">
                                        <td><img v-bind:src="`https://gmart.vokasidev.com/api/images/produk/${produk.gambar}`" alt="`${produk.nama_produk}`" height="80"></td>
                                        <td>{{produk.nama_kategori}}</td>
                                        <td>{{produk.merk}}</td>
                                        <td>{{produk.nama_produk}}</td>
                                        <td>Rp {{produk.harga_koperasi}}</td>
                                        <td v-if="(produk.stok !== null && role === '2') || (produk.stok !== null && role=='3')">Rp {{ produk.harga_jual }} <router-link title="Edit" data-toggle="tooltip" class="text-inverse pr-10" :to="{ name: 'barang.harga', params: {id: produk.id_produkkoperasi} }"><i class="zmdi zmdi-edit txt-grey"></i></router-link></td>
                                        <td v-if="produk.stok === null & role !== 1">Rp 0</td>
                                        <td v-if="role === '1'"><router-link title="Edit" data-toggle="tooltip" class="text-inverse pr-10" :to="{ name: 'barang.edit', params: {id: produk.id_produkkoperasi} }"><i class="zmdi zmdi-edit txt-grey"></i></router-link><a href="#" v-on:click="deleteData(produk.id_produkkoperasi)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="zmdi zmdi-delete txt-grey"></i></a></td>
                                        <td v-else-if="produk.stok !== null">{{produk.stok}}</td>
                                        <td v-else>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <p v-if="produks.data"><i class="fa fa-bars"></i> {{ produks.data.length }} item dari {{ produks.meta.total }} total data</p>
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
      produks: [],
      role: ''
    };
  },
  created() {
    this.loadData();
    this.role = localStorage.getItem('role');
  },
  methods: {
    loadData() {
      $axios.get("/produk").then(response => {
        this.produks = response.data;
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
                    $axios.delete("/produk/" + id).then(response => {
                    this.loadData();
                  });
                }
            })
    }
  }
};
</script>
