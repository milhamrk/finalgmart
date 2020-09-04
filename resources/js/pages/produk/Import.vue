<template>
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pt-0">
                    <div class="form-wrap">
                        <form @submit.prevent="addData()" enctype="multipart/form-data" method="POST">
                            <h6 class="txt-dark flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-info-outline mr-10"></i>informasi</h6>
                            <hr class="light-grey-hr"/>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label mb-10">File Excel</label> <span><i>[Pastikan format file excel sesuai dengan format]</i></span>
                                        <input type="file" id="firstName" class="dropify" v-on:change="onFileChange" accept=".xls, .xlsx, .xlt" required>
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
        file: ''
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
      $axios.get("/kategori").then(response => {
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
        formData.append('file', this.form.file);
        $axios.post('/produkExcel', formData, config)
        .then(function (response) {
            router.push("/produk")
        })
        .catch(function (error) {
            currentObj.output = error;
        });
    },
    onFileChange(e){
        var fileName = e.target.value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="xls" || extFile=="xlsx" || extFile=="xlt"){
            this.form.file = e.target.files[0];
        }else{
            alert("Maaf hanya file excel yang diizinkan!");
            this.form.file = "";
        }   
    },
  }
};
</script>
