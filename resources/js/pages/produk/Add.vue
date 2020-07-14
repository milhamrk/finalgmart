<template>
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pt-0">
                    <div class="form-wrap">
                        <form @submit.prevent="addData()" enctype="multipart/form-data">
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
                                        <label class="control-label mb-10">Gambar</label>
                                        <input type="file" id="firstName" class="dropify" v-on:change="onImageChange" accept=".png, .jpg, .jpeg" required>
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
  mounted:function(){
     $('.dropify').dropify();
  },
  methods: {
    loadData() {
      $axios.get("http://localhost:8000/api/kategori").then(response => {
        this.kategoris = response.data;
      });
    },
    addData() {
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
        formData.append('gambar', this.form.image);

        axios.post('http://localhost:8000/api/produk', formData, config)
        .then(function (response) {
            router.push("/produk")
        })
        .catch(function (error) {
            currentObj.output = error;
        });
    },
    onImageChange(e){
        var fileName = e.target.value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            this.form.image = e.target.files[0];
        }else{
            alert("Maaf hanya gambar JPG, JPEG, dan PNG yang diizinkan!");
            this.form.image = "";
        }   
    },
  }
};
</script>
