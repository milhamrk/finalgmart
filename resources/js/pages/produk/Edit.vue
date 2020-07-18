<template>
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pt-0">
                    <div class="form-wrap">
                        <form @submit.prevent="updateData()" enctype="multipart/form-data">
                            <h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline mr-10"></i>informasi</h6>
                            <hr class="light-grey-hr"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Merk</label>
                                        <input type="text" id="firstName" class="form-control" placeholder="Masukkan Merk" v-model="form.merk" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10">Varian</label>
                                        <input type="text" id="firstName" class="form-control" placeholder="Masukkan Varian" v-model="form.varian" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Harga</label>
                                        <input type="number" id="firstName" class="form-control" placeholder="Harga Produk" min="0" v-model="form.harga" required>
                                    </div>
                                    <div class="form-group">

                                        <label class="control-label mb-10">Gambar <span style="color:red;">* kosongkan apabila tidak ingin merubah gambar</span></label>
                                        <input type="file" id="firstName" class="form-control" placeholder="Nama Kategori" v-on:change="onImageChange">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>

                            <h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-shopping-cart mr-10"></i>kategori</h6>
                            <hr class="light-grey-hr"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Produk kategori</label>
                                        <select class="form-control" v-model="form.kategori" required>
                                            <option :value="t.id_kategori" v-for="(t, i) in kategoris" :key="i">{{ t.nama_kategori }}</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            
                            <div class="form-actions">
                                <button class="btn btn-orange btn-icon left-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>Simpan</span></button>
                                <button type="reset" class="btn btn-default pull-left">Batal</button>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</template>

<script>
import { mapActions, mapState } from 'vuex'
import $axios from '../../api.js'
import router from '../../router.js'
import axios from 'axios'

export default {
  data(){
    return{
      form:{
        merk: '',
        varian: '',
        kategori: '',
        harga: '',
        image: ''
      },
      kategoris: []
    }
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      $axios.get("https://management.kiosrakyat.co.id/api/produk/" + this.$route.params.id).then(response => {
        this.form.merk = response.data.merk;
        this.form.varian = response.data.nama_produk;
        this.form.harga = response.data.harga_koperasi;
        this.form.kategori = response.data.id_kategori;
      });
      $axios.get("https://management.kiosrakyat.co.id/api/kategori").then(response => {
        this.kategoris = response.data;
      });
    },
    updateData() {
        let currentObj = this;

        const config = {
            headers: {
            Authorization: localStorage.getItem('token') != 'null' ? 'Bearer ' + localStorage.getItem('token'):'','Content-Type': 'multipart/form-data'
            }
        }

        let formData = new FormData();
        formData.append('merk', this.form.merk);
        formData.append('nama_produk', this.form.varian);
        formData.append('harga_koperasi', this.form.harga);
        formData.append('id_kategori', this.form.kategori);
        if(this.form.gambar || this.form.gambar != ''){
          formData.append('gambar', this.form.image);
        }

        axios.post('https://management.kiosrakyat.co.id/api/produk/' + this.$route.params.id, formData, config)
        .then(function (response) {
            router.push("/produk")
        })
        .catch(function (error) {
            currentObj.output = error;
        });
    },
    onImageChange(e){
        this.form.image = e.target.files[0];
    },
  }
};
</script>
