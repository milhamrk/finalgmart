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
                                        <label class="control-label mb-10">Password <span style="color:red;">* kosongkan bila tidak merubah password</span></label>
                                        <input type="password" class="form-control" placeholder="Masukkan password" v-model="form.password">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-10">Kota</label>
                                        <select 
                                        v-model="form.idKota" class="select2 form-control">
                                            <option disabled value="">Pilih</option>
                                            <option :value="t.id_city" v-for="(t, i) in kota" :key="i">{{ t.city_name }}</option>
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

export default {
  data(){
    return{
      form:{
        nama: '',
        email: '',
        password: '',
        idKota: '',
        role: ''
      },
      kota: [],
      kotaPilih: ''
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
      $axios.get("/kota").then(response => {
        this.kota = response.data;
      });
      $axios.get("/admin/" + this.$route.params.id).then(response => {
        this.form.nama = response.data.name;
        this.form.email = response.data.email;
        this.form.idKota = response.data.province_id;
      });
    },
    addData() {
      $axios
        .put("/admin/" + this.$route.params.id, {
          name: this.form.nama,
          email: this.form.email,
          password: this.form.password,
          role: '2',
          province_id: this.form.idKota,
        })
        .then(response => {
          this.$router.push("/admin");
        });
    }
  }
};
</script>
