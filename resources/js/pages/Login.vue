<template>
    <div class="wrapper  pa-0">
        <header class="sp-header">
            <div class="sp-logo-wrap pull-left">
                <router-link :to="{ name: 'home' }">
                    <img class="brand-img mr-10" src="dist/img/logo.png" alt="brand"/>
                    <span class="brand-text"><img  src="dist/img/brand.png" alt="brand"/></span>
                </router-link>
            </div>
            <div class="form-group mb-0 pull-right">
                <span class="inline-block pr-10">Ready to sell?</span>
                <a class="inline-block btn btn-orange btn-rounded " href="#">Download our apps</a>
            </div>
            <div class="clearfix"></div>
        </header>
        
        <!-- Main Content -->
        <div class="page-wrapper pa-0 ma-0 auth-page">
            <div class="container">
                <!-- Row -->
                <div class="table-struct full-width full-height">
                    <div class="table-cell vertical-align-middle auth-form-wrap">
                        <div class="auth-form  ml-auto mr-auto no-float card-view pt-30 pb-30">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="mb-30">
                                        <h3 class="text-center txt-dark mb-10">Sign in</h3>
                                        <h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
                                    </div>  
                                    <div class="form-wrap">
                                        <form action="#">
                                            <div class="form-group" :class="{'has-error': errors.email}">
                                                <label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
                                                <input type="email" class="form-control" required="" id="exampleInputEmail_2" placeholder="Enter email" v-model="data.email">
                                                <p class="text-danger" v-if="errors.email">{{ errors.email[0] }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>
                                                <a class="capitalize-font txt-orange block mb-10 pull-right font-12" href="#">forgot password ?</a>
                                                <div class="clearfix"></div>
                                                <input type="password" class="form-control" required="" id="exampleInputpwd_2" placeholder="Enter pwd" v-model="data.password">
                                                <p class="text-danger" v-if="errors.password">{{ errors.password[0] }}</p>
                                            </div>
                                            <div class="alert alert-danger" v-if="errors.invalid">{{ errors.invalid }}</div>
                                            <div class="form-group">
                                                <div class="checkbox checkbox-primary pr-10 pull-left">
                                                    <input id="checkbox_2" required="" type="checkbox">
                                                    <label for="checkbox_2"> Keep me logged in</label>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-orange btn-rounded" @click.prevent="postLogin">sign in</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>  
                            </div>
                        </div>`
                    </div>
                </div>
                <!-- /Row -->   
            </div>
            
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
</template>

<!-- JAVASCRIPT SECTION -->
<script>
import { mapActions, mapMutations, mapGetters, mapState } from 'vuex';
export default {
    data() {
        return {
            data: {
                email: '',
                password: '',
                remember_me: false
            }
        }
    },
    created() {
        if (this.isAuth) {
            window.location = "/";
        }
    },
    computed: {
        ...mapGetters(['isAuth']),
      	...mapState(['errors'])
    },
    methods: {
        ...mapActions('auth', ['submit']),
        ...mapMutations(['CLEAR_ERRORS']),
      
        postLogin() {
            this.submit(this.data).then(() => {
                if (this.isAuth) {
                    this.CLEAR_ERRORS()
                    window.location = "/";
                }
            })
        }
    }
}
</script>