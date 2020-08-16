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
                                        <label class="control-label mb-10">Produk</label>
                                        <input type="text" min="1" class="form-control" required readonly="" :value="`${this.form.merk} ${this.form.nama_produk}`">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10">Harga Beli</label>
                                        <input type="number" min="1" class="form-control" placeholder="Masukkan Harga Jual" v-model="form.hargaBeli" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10">Harga Jual</label>
                                        <input type="number" min="1" class="form-control" placeholder="Masukkan Harga Jual" v-model="form.harga" required>
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

export default {
  data(){
    return{
      form:{
        harga: '',
        hargaBeli: '',
        nama_produk: '',
        merk: '',
        idBarang: ''
      }
    }
  },
  created() {
    this.loadData();
  },
  mounted:function(){
  },
  methods: {
    loadData() {
      $axios.get("/api/produk/" + this.$route.params.id).then(response => {
        this.form.harga = response.data.harga_jual;
        this.form.hargaBeli = response.data.harga_koperasi;
        this.form.nama_produk = response.data.nama_produk;
        this.form.merk = response.data.merk;
        this.form.idBarang = response.data.id_produkkoperasi;
      });
    },
    addData() {

        let formData = new FormData();
        formData.append('id_produkkoperasi', this.form.idBarang);
        formData.append('harga_koperasi', this.form.harga);

        $axios.post('/api/harga/', formData)
        .then(function (response) {
            router.push("/produk")
        });
    },
    onImageChange(e){
        this.form.image = e.target.files[0];
    },
  }
};
</script>
