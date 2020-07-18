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
                                        <label class="control-label mb-10">Nama</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Nama" v-model="form.nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10">Email</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Email" v-model="form.email" required>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Nomor Handphone</label>
                                        <input type="number" min="0" class="form-control" placeholder="08xxxxxx" v-model="form.noHp" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10">Password</label>
                                        <input type="password" class="form-control" placeholder="Masukkan password" v-model="form.password" required>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Alamat</label>
                                        <textarea class="form-control" placeholder="Masukkan Alamat" v-model="form.alamat" required />
                                    </div>
                                </div>
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

export default {
  data(){
    return{
      form:{
        nama: '',
        email: '',
        noHp: '',
        password: '',
        alamat: ''
      }
    }
  },
  methods: {
    addData() {
      $axios
        .post("https://management.kiosrakyat.co.id/api/konsumen", {
          nama: this.form.nama,
          email: this.form.email,
          no_hp: this.form.noHp,
          password: this.form.password,
          alamat: this.form.alamat,
        })
        .then(response => {
          this.$router.push("/konsumen");
        });
    }
  }
};
</script>
