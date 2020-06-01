<template>
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pt-0">
                    <div class="form-wrap">
                        <form @submit.prevent="addData()">
                            <h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline mr-10"></i>informasi</h6>
                            <hr class="light-grey-hr"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Nama Kios</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Nama" v-model="form.namaKios" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10">Status Buka</label>
                                        <select v-model="form.statusBuka" class="form-control" required>
                                            <option disabled value="">Pilih</option>
                                            <option value="0">Tutup</option>
                                            <option value="1">Buka</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Alamat</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Alamat" v-model="form.alamat" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10">Kota</label>
                                        <select v-model="form.kotaId" class="select2 form-control">
                                            <option disabled value="">Pilih</option>
                                            <option :value="t.id_city" v-for="(t, i) in kota" :key="i">{{ t.city_name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>

                            <h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-account mr-10"></i>pemilik</h6>
                            <hr class="light-grey-hr"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Nama Pemilik</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Nama" v-model="form.namaPemilik" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10">Email</label>
                                        <input type="email" class="form-control" placeholder="Masukkan Email" v-model="form.email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Nomor Handphone</label>
                                        <input type="number" min="0" class="form-control" placeholder="08xxxxx" v-model="form.noHp" required>
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
import axios from 'axios'

export default {
  data(){
    return{
      form:{
        namaKios: '',
        statusBuka: '',
        alamat: '',
        kotaId: '',
        selectId: '',
        namaPemilik: '',
        noHp: '',
        email: ''
      },
      kota: []
    }
  },
  created() {
    this.loadData();
  },
  mounted:function(){
    //  $(".select2").on("change", function (e) { 
    //     this.form.selectId = $(this).val();
    //     alert(this.form.selectId);
    // })
  },
  methods: {
    loadData() {
      $axios.get("http://localhost:8000/api/kota").then(response => {
        this.kota = response.data;
      });
      $axios.get("http://localhost:8000/api/kios/" + this.$route.params.id).then(response => {
        this.form.namaKios = response.data.nama_kios;
        this.form.statusBuka = response.data.status_buka;
        this.form.alamat = response.data.alamat;
        this.form.kotaId = response.data.id_city;
        this.form.namaPemilik = response.data.nama_pemilik;
        this.form.noHp = response.data.no_hp;
        this.form.email = response.data.email;
      });
    },
    addData() {
      $axios
        .put("http://localhost:8000/api/kios/" + this.$route.params.id, {
          nama_kios: this.form.namaKios,
          nama_pemilik: this.form.namaPemilik,
          status_buka: this.form.statusBuka,
          email: this.form.email,
          no_hp: this.form.noHp,
          alamat: this.form.alamat,
          id_city: this.form.kotaId
        })
        .then(response => {
          this.$router.push("/kios");
        });
    }
  }
};
</script>