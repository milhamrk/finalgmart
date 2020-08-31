<template>
	<div class="wrapper theme-2-active navbar-top-light">
		<!-- Top Menu Items -->
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="nav-wrap">
				<div class="mobile-only-brand pull-left">
					<div class="nav-header pull-left">
						<div class="logo-wrap">
							<a href="/">
								<img class="brand-img" src="dist/img/logo.png" alt="brand"/>
								<span class="brand-text"><img  src="dist/img/brand.png" alt="brand"/></span>
							</a>
						</div>
					</div>	
					<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="#"><i class="ti-align-left"></i></a>
					<a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="#"><i class="zmdi zmdi-search"></i></a>
					<a id="toggle_mobile_nav" class="mobile-only-view" href="#"><i class="ti-more"></i></a>
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
							<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="dist/img/user.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
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
            <div class="container pt-30">
				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6 col-xs-12">
								<div class="panel panel-default card-view pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-0">
											<div class="sm-data-box">
												<div class="container-fluid">
													<div class="row">
														<div v-for="tc in transaksiCount" :key="tc.id" class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
															<span class="txt-dark block counter"><span class="counter-anim">{{ tc.count }}</span></span>
															<span class="capitalize-font block">Transaksi</span>
														</div>
														<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
															<i class="icon-basket data-right-rep-icon"></i>
														</div>
													</div>
													<div class="progress-anim">
														<div class="progress">
															<div class="progress-bar progress-bar-orange
															wow animated progress-animated" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<div class="panel panel-default card-view pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body pa-0">
											<div class="sm-data-box">
												<div class="container-fluid">
													<div v-if="role == 3" class="row">
														<div v-for="kc in kiosCount" :key="kc.id" class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
															<span class="txt-dark block counter"><span class="counter-anim">Rp {{ kc.count.toLocaleString() }}</span></span>
															<span class="capitalize-font block">Pendapatan</span>
														</div>
														<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
															<i class="icon-social-dropbox  data-right-rep-icon"></i>
														</div>
													</div>
													<div v-else class="row">
														<div v-for="kc in kiosCount" :key="kc.id" class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
															<span class="txt-dark block counter"><span class="counter-anim">{{ kc.count }}</span></span>
															<span class="capitalize-font block">Kios</span>
														</div>
														<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
															<i class="icon-social-dropbox  data-right-rep-icon"></i>
														</div>
													</div>
													<div class="progress-anim">
														<div class="progress">
															<div class="progress-bar progress-bar-orange
															wow animated progress-animated" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xs-12">
								<div class="panel panel-default border-panel card-view panel-refresh">
									<div class="refresh-container">
										<div class="la-anim-1"></div>
									</div>
									<div class="panel-heading">
										<div class="pull-left">
											<h6 class="panel-title txt-dark">Transaksi</h6>
										</div>
										<div class="pull-right">
											<a href="#" class="pull-left inline-block refresh mr-15">
												<i class="zmdi zmdi-replay"></i>
											</a>
											<a href="#" class="pull-left inline-block full-screen mr-15">
												<i class="zmdi zmdi-fullscreen"></i>
											</a>
											<div class="pull-left inline-block dropdown">
												<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
												<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
													<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Devices</a></li>
													<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>General</a></li>
													<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>Referral</a></li>
												</ul>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<div id="ct_chart_2" class="" style="height:326px;"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="row">
							
							
						</div>
					</div>
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
    import { mapActions, mapState } from 'vuex'
    import $axios from '../api.js'
	export default {
			data() {
		    return {
		      graph: [],
		      role: '',
		      kios: [],
		      kiosCount: [],
		      transaksiCount: []
		    };
		  },
	    mounted:function(){
	    	
	    },
	    created(){
	    	this.loadData();
	    },
	    watch: {
	      graph(val){
	      	this.role = localStorage.getItem('role');
	      	if($('#ct_chart_2').length > 0) {
			// Area Chart
			var data= this.graph;
			var areaChart = Morris.Area({
					element: 'ct_chart_2',
					data: data,
					xkey: 'tanggal',
					ykeys: ['jumlah'],
					labels: ['Jumlah Transaksi'],
					pointSize: 3,
					lineWidth: 2,
					pointStrokeColors:['#ff6028'],
					pointFillColors:['#ffffff'],
					behaveLikeLine: true,
					gridLineColor: 'rgba(33,33,33,0.1)',
					smooth: false,
					hideHover: 'auto',
					lineColors: ['#ff6028'],
					resize: true,
					gridTextColor:'#878787',
					gridTextFamily:"Roboto",
					parseTime: false,
					fillOpacity:0.2
				});	
			}
	      }
	    },
	    methods: {
	    	loadData() {
		      $axios.get("/grafis").then(response => {
		        this.graph = response.data;
		      });
		      $axios.get("/kios").then(response => {
		        this.kios = response.data;
		      });
		      $axios.get("/kiosCount").then(response => {
		        this.kiosCount = response.data;
		      });
		      $axios.get("/transaksiCount").then(response => {
		        this.transaksiCount = response.data;
		      });
		    },
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
