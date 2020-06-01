import Vue from 'vue'
import Router from 'vue-router'

import VueAxios from 'vue-axios';
import Axios from 'axios';

Vue.use(VueAxios,Axios);

import Home from './pages/Home.vue'
import Transaksi from './pages/Transaksi.vue'
import Chat from './pages/Chat.vue'
import ChatBox from './pages/ChatBox.vue'
import Login from './pages/Login.vue'
import store from './store.js'

// Kategori
import IndexKategori from './pages/kategori/Index.vue'
import DataKategori from './pages/kategori/Kategori.vue'
import AddKategori from './pages/kategori/Add.vue'
import EditKategori from './pages/kategori/Edit.vue'

// Produk
import IndexProduk from './pages/produk/Index.vue'
import DataProduk from './pages/produk/Produk.vue'
import AddProduk from './pages/produk/Add.vue'
import PesanProduk from './pages/produk/Pesan.vue'
import EditProduk from './pages/produk/Edit.vue'
import HargaProduk from './pages/produk/Harga.vue'

// Kios
import IndexKios from './pages/kios/Index.vue'
import DataKios from './pages/kios/Kios.vue'
import AddKios from './pages/kios/Add.vue'
import EditKios from './pages/kios/Edit.vue'

// Konsumen
import IndexKonsumen from './pages/konsumen/Index.vue'
import DataKonsumen from './pages/konsumen/Konsumen.vue'
import AddKonsumen from './pages/konsumen/Add.vue'
import EditKonsumen from './pages/konsumen/Edit.vue'

// Admin
import IndexAdmin from './pages/admin/Index.vue'
import DataAdmin from './pages/admin/Admin.vue'
import AddAdmin from './pages/admin/Add.vue'
import EditAdmin from './pages/admin/Edit.vue'


Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: { requiresAuth: true }
        },
        {
            path: '/transaksi',
            name: 'transaksi',
            component: Transaksi,
            meta: { requiresAuth: true }
        },{
            path: '/chat',
            name: 'chat',
            component: Chat,
            meta: { requiresAuth: true }
        },{
            path: '/chat/:id',
            name: 'chat.id',
            component: ChatBox,
            meta: { requiresAuth: true }
        },{
            path: '/login',
            name: 'login',
            component: Login
        },{
        path: '/kategori',
        component: IndexKategori,
        children: [
                {
                    path: '',
                    name: 'kategori.data',
                    component: DataKategori,
                    meta: { title: 'Manage kategori' }
                },
                {
                    path: 'add',
                    name: 'kategori.add',
                    component: AddKategori,
                    meta: { title: 'Add New Kategori' }
                },
                {
                    path: 'edit/:id',
                    name: 'kategori.edit',
                    component: EditKategori,
                    meta: { title: 'Edit Kategori' }
                }
            ]
        },
        {
        path: '/produk',
        component: IndexProduk,
        children: [
                {
                    path: '',
                    name: 'barang.data',
                    component: DataProduk,
                    meta: { title: 'Manage Produk' }
                },
                {
                    path: 'add',
                    name: 'barang.add',
                    component: AddProduk,
                    meta: { title: 'Add New Produk' }
                },
                {
                    path: 'edit/:id',
                    name: 'barang.edit',
                    component: EditProduk,
                    meta: { title: 'Edit Produk' }
                },
                {
                    path: 'pesan',
                    name: 'barang.pesan',
                    component: PesanProduk,
                    meta: { title: 'Pesan Produk' }
                },
                {
                    path: 'harga/:id',
                    name: 'barang.harga',
                    component: HargaProduk,
                    meta: { title: 'Harga Produk' }
                }
            ]
        },{
        path: '/kios',
        component: IndexKios,
        children: [
                {
                    path: '',
                    name: 'kios.data',
                    component: DataKios,
                    meta: { title: 'Manage Kios' }
                },
                {
                    path: 'add',
                    name: 'kios.add',
                    component: AddKios,
                    meta: { title: 'Add New Kios' }
                },
                {
                    path: 'edit/:id',
                    name: 'kios.edit',
                    component: EditKios,
                    meta: { title: 'Edit Kios' }
                }
            ]
        },{
        path: '/konsumen',
        component: IndexKonsumen,
        children: [
                {
                    path: '',
                    name: 'konsumen.data',
                    component: DataKonsumen,
                    meta: { title: 'Manage Konsumen' }
                },
                {
                    path: 'add',
                    name: 'konsumen.add',
                    component: AddKonsumen,
                    meta: { title: 'Add New Konsumen' }
                },
                {
                    path: 'edit/:id',
                    name: 'konsumen.edit',
                    component: EditKonsumen,
                    meta: { title: 'Edit Konsumen' }
                }
            ]
        },{
        path: '/admin',
        component: IndexAdmin,
        children: [
                {
                    path: '',
                    name: 'admin.data',
                    component: DataAdmin,
                    meta: { title: 'Manage Admin' }
                },
                {
                    path: 'add',
                    name: 'admin.add',
                    component: AddAdmin,
                    meta: { title: 'Add New Admin' }
                },
                {
                    path: 'edit/:id',
                    name: 'admin.edit',
                    component: EditAdmin,
                    meta: { title: 'Edit Admin' }
                }
            ]
        }
    ]
});

router.beforeEach((to, from, next) => {
    store.commit('CLEAR_ERRORS') 
    if (to.matched.some(record => record.meta.requiresAuth)) {
        let auth = store.getters.isAuth
        if (!auth) {
            next({ name: 'login' })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router;