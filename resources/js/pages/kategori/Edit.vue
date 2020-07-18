<template>
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pt-0">
                    <div class="form-wrap">
                        <form @submit.prevent="updateData()">
                            <h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline mr-10"></i>informasi</h6>
                            <hr class="light-grey-hr"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Produk kategori</label>
                                        <input type="text" id="firstName" class="form-control" placeholder="Nama Kategori" v-model="form.namaKategori" required>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            
                            <div class="form-actions">
                                <button class="btn btn-orange btn-icon left-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>Simpan</span></button>
                                <button type="button" class="btn btn-default pull-left">Batal</button>
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

export default {
  data() {
    return {
      form: {
        namaKategori: ""
      }
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      $axios
        .get("https://management.kiosrakyat.co.id/api/kategori/" + this.$route.params.id)
        .then(response => {
          this.form.namaKategori = response.data.nama_kategori;
        });
    },
    updateData() {
      $axios
        .put("https://management.kiosrakyat.co.id/api/kategori/" + this.$route.params.id, {
          nama_kategori: this.form.namaKategori,
        })
        .then(response => {
          this.$router.push("/kategori");
        });
    }
  }
};
</script>
