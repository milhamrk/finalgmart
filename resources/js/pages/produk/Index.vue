<template>
    <div class="wrapper theme-2-active navbar-top-light">
        <!-- Top Menu Items -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="nav-wrap">
                <div class="mobile-only-brand pull-left">
                    <div class="nav-header pull-left">
                        <div class="logo-wrap">
                            <a href="#">
                                <img class="brand-img" src="/dist/img/logo.png" alt="brand"/>
                                <span class="brand-text"><img  src="/dist/img/brand.png" alt="brand"/></span>
                            </a>
                        </div>
                    </div>  
                    <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="ti-align-left"></i></a>
                    <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
                    <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="ti-more"></i></a>
                    <form id="search_form" role="search" class="top-nav-search collapse pull-left">
                        <div class="input-group">
                            <input type="text" name="example-input1-group2" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <div id="mobile_only_nav" class="mobile-only-nav pull-right">
                    <ul class="nav navbar-right top-nav pull-right">
                        
                        <li class="dropdown auth-drp">
                            <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="/dist/img/user.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
                            <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                                <li>
                                    <a href="profile.html"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-card"></i><span>my balance</span></a>
                                </li>
                                <li>
                                    <a href="inbox.html"><i class="zmdi zmdi-email"></i><span>Inbox</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
                                </li>
                                <li class="divider"></li>
                                <li class="sub-menu show-on-hover">
                                    <a href="#" class="dropdown-toggle pr-0 level-2-drp"><i class="zmdi zmdi-check text-success"></i> available</a>
                                    <ul class="dropdown-menu open-left-side">
                                        <li>
                                            <a href="#"><i class="zmdi zmdi-check text-success"></i><span>available</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="zmdi zmdi-circle-o text-warning"></i><span>busy</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="zmdi zmdi-minus-circle-outline text-danger"></i><span>offline</span></a>
                                        </li>
                                    </ul>   
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#" @click="logout"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>  
            </div>
        </nav>
        <!-- /Top Menu Items -->
        
        <!-- Left Sidebar Menu -->
        <div class="fixed-sidebar-left">
            <ul class="nav navbar-nav side-nav nicescroll-bar">
                <li class="navigation-header">
                    <span>Main</span> 
                    <hr/>
                </li>
                <li>
                    <router-link :to="{ name: 'home' }"><div class="pull-left"><i class="ti-dashboard mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'transaksi' }"><div class="pull-left"><i class="ti-shopping-cart mr-20"></i><span class="right-nav-text">Transaksi</span></div><div class="clearfix"></div></router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'chat' }"><div class="pull-left"><i class="ti-comment mr-20"></i><span class="right-nav-text">Chat</span></div><div class="clearfix"></div></router-link>
                </li>
                <li class="navigation-header mt-20">
                    <span>Manajemen</span> 
                    <hr/>
                </li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr"><div class="pull-left"><i class="ti-archive  mr-20"></i><span class="right-nav-text">Produk</span></div><div class="pull-right"><i class="ti-angle-down "></i></div><div class="clearfix"></div></a>
                    <ul id="ui_dr" class="collapse collapse-level-1 two-col-list">
                        <li>
                            <router-link :to="{ name: 'kategori.data' }">Kategori</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'barang.data' }">Barang</router-link>
                        </li>
                    </ul>
                </li>
                <li v-if="role !== '3'">
                    <router-link :to="{ name: 'kios.data' }"><div class="pull-left"><i class="ti-dropbox mr-20"></i><span class="right-nav-text">Kios</span></div><div class="clearfix"></div></router-link>
                </li>
                <li v-if="role !== '3'">
                    <router-link :to="{ name: 'konsumen.data' }"><div class="pull-left"><i class="ti-user mr-20"></i><span class="right-nav-text">Konsumen</span></div><div class="clearfix"></div></router-link>
                </li>
                <li v-if="role === '1'" class="navigation-header mt-20">
                    <span>admin</span> 
                    <hr/>
                </li>
                <li v-if="role === '1'">
                    <router-link :to="{ name: 'admin.data' }"><div class="pull-left"><i class="ti-book mr-20"></i><span class="right-nav-text">administrator</span></div><div class="clearfix"></div></router-link>
                </li>
            </ul>
        </div>
        <!-- /Left Sidebar Menu -->
        
        
        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container">
                <!-- Title -->
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                      <h5 class="txt-dark">List Produk</h5>
                    </div>
                    <breadcrumb></breadcrumb>
                </div>
                <!-- /Title -->
                
                <!-- Row -->
                <div class="row">
                    <router-view></router-view>
                </div>
                <!-- /Row -->
            </div>
            
            
            <!-- Footer -->
            <footer class="footer pl-30 pr-30">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>2020 &copy; G-Mart. All rights reserved.</p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <p>Made in <u>Yogyakarta</u> by PT. Karyanto</p>
                            <a href="https://linkedin.com/company/karyanto"><i class="fa fa-linkedin"></i></a>
                            <a href="https://karyanto.com"><i class="fa fa-globe"></i></a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- /Footer -->
            
        </div>
        <!-- /Main Content -->

    </div>
</template>
<script>
    import Breadcrumb from '../../components/Breadcrumb.vue'
    export default {
        name: 'IndexKategori',
        components: {
            'breadcrumb': Breadcrumb
        },
        data(){
            return{
                role: ''
            }
        },
        mounted(){
            this.role = localStorage.getItem('role');
        },
        methods: {
            logout() {
                return new Promise((resolve, reject) => {
                    localStorage.removeItem('token')
                    resolve()
                }).then(() => {
                    this.$store.state.token = localStorage.getItem('token')
                    this.$router.push('/login')
                })
            }
        }
    }
</script>