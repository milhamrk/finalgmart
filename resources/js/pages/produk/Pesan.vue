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
                                        <label class="control-label mb-10">Barang</label>
                                        <select class="form-control select2" v-model="form.idBarang" required>
                                            <option disabled value="">Pilih Barang</option>
                                            <option :value="t.id_produkkoperasi" v-for="(t, i) in barangs" :key="i">{{ t.merk }} {{ t.nama_produk }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10">Jumlah</label>
                                        <input type="number" min="1" class="form-control" placeholder="Masukkan Jumlah Pesanan" v-model="form.stok" required>
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
        stok: '',
        idBarang: ''
      },
      barangs: []
    }
  },
  created() {
    this.loadData();
  },
  mounted:function(){
     var selectDropDown = $(".select2").select2();

    selectDropDown.on('select2:select select2:unselect', function (e) {
        var event = new Event('change');
        e.target.dispatchEvent(event);
    });
  },
  methods: {
    loadData() {
      $axios.get("/produk").then(response => {
        this.barangs = response.data;
        console.log(this.barangs[0].harga_koperasi);
      });
    },
    addData() {

        let formData = new FormData();
        formData.append('id_produkkoperasi', this.form.idBarang);
        formData.append('stok', this.form.stok);

        $axios.post('/pesan', formData)
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
