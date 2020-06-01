<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Order;
use App\Kios;
use App\produk_terjual;

use DB;

class TransaksiController extends Controller
{
    function trx(){
        if(auth('admin-api')->check()){
            if(auth('admin-api')->user()->role==1){
                $data = Order::
                join('kios','kios.id_kios','=','order.id_kios')
                ->join('konsumen','konsumen.id_konsumen','=','order.id_konsumen')
                ->join('produk_terjual','produk_terjual.id_order','=','order.id_order')
                ->join('produk_kios','produk_kios.id_produkkios','=','produk_terjual.id_produkkios')
                ->join('produk_koperasi','produk_kios.id_produkkoperasi','=','produk_koperasi.id_produkkoperasi')
                ->join('pembayaran','order.id_pembayaran','=','pembayaran.id_pembayaran')
                ->join('pengiriman','order.id_pengiriman','=','pengiriman.id_pengiriman')
                ->select('*', 'order.created_at as tanggal')
                ->get();
                return $data;
            }else if(auth('admin-api')->user()->role==2){
                $city = auth('admin-api')->user()->province_id;
                $data = Order::
                join('kios','kios.id_kios','=','order.id_kios')
                ->join('konsumen','konsumen.id_konsumen','=','order.id_konsumen')
                ->join('produk_terjual','produk_terjual.id_order','=','order.id_order')
                ->join('produk_kios','produk_kios.id_produkkios','=','produk_terjual.id_produkkios')
                ->join('produk_koperasi','produk_kios.id_produkkoperasi','=','produk_koperasi.id_produkkoperasi')
                ->join('pembayaran','order.id_pembayaran','=','pembayaran.id_pembayaran')
                ->join('pengiriman','order.id_pengiriman','=','pengiriman.id_pengiriman')
                ->select('*', 'order.created_at as tanggal')
                ->where('kios.id_city', '=', $city)
                ->get();
                return $data;
            }
        }else if(auth('kios-api')->check()){
            $kios = auth('kios-api')->user()->id_kios;
            $data = Order::
            join('kios','kios.id_kios','=','order.id_kios')
            ->join('konsumen','konsumen.id_konsumen','=','order.id_konsumen')
            ->join('produk_terjual','produk_terjual.id_order','=','order.id_order')
            ->join('produk_kios','produk_kios.id_produkkios','=','produk_terjual.id_produkkios')
            ->join('produk_koperasi','produk_kios.id_produkkoperasi','=','produk_koperasi.id_produkkoperasi')
            ->join('pembayaran','order.id_pembayaran','=','pembayaran.id_pembayaran')
            ->join('pengiriman','order.id_pengiriman','=','pengiriman.id_pengiriman')
            ->select('*', 'order.created_at as tanggal')
            ->where('kios.id_kios', '=', $kios)
            ->get();
            return $data;
        }
    }

    function grafis(){
        $data = Order::select(DB::raw('count(*) as jumlah, CAST(created_at AS date) as tanggal'))
                ->groupBy('created_at')
                ->get();
        return $data;
    }

    function transaksiCount(){
        if(auth('admin-api')->check()){
            if(auth('admin-api')->user()->role==1){
                $data = Order::count();
                return response()->json([['id' => 0, 'count' => $data]], 200);
            }else if(auth('admin-api')->user()->role==2){
                $city = auth('admin-api')->user()->province_id;
                $data = Order::join('kios','kios.id_kios','=','order.id_kios')
                ->where('id_city','=',$city)
                ->count();
                return response()->json([['id' => 0, 'count' => $data]], 200);
            }
        }else if(auth('kios-api')->check()){
            $kios = auth('kios-api')->user()->id_kios;
            $data = Order::where('id_kios', '=', $kios)->count();
            return response()->json([['id' => 0, 'count' => $data]], 200);
        }
    }

    function kiosCount(){
       if(auth('admin-api')->check()){
            if(auth('admin-api')->user()->role==1){
                $data = Kios::count();
                return response()->json([['id' => 0, 'count' => $data]], 200);
            }else if(auth('admin-api')->user()->role==2){
                $city = auth('admin-api')->user()->province_id;
                $data = Kios::where('id_city','=',$city)
                ->count();
                return response()->json([['id' => 0, 'count' => $data]], 200);
            }
        }else if(auth('kios-api')->check()){
            $kios = auth('kios-api')->user()->id_kios;
            $getData = produk_terjual::select(DB::raw('sum(total_harga_beli) as pendapatan'))
                ->where('id_kios','=',$kios)
                ->groupBy('id_kios')
                ->first();
                $data = $getData->pendapatan;
            return response()->json([['id' => 0, 'count' => $data]], 200);
        }
    }

    function dashboard(){
        if(auth('admin-api')->check()){
            if(auth('admin-api')->user()->role==1){
                $data = Order::
                join('kios','kios.id_kios','=','order.id_kios')
                ->join('konsumen','konsumen.id_konsumen','=','order.id_konsumen')
                ->join('produk_terjual','produk_terjual.id_order','=','order.id_order')
                ->join('produk_kios','produk_kios.id_produkkios','=','produk_terjual.id_produkkios')
                ->join('produk_koperasi','produk_kios.id_produkkoperasi','=','produk_koperasi.id_produkkoperasi')
                ->join('pembayaran','order.id_pembayaran','=','pembayaran.id_pembayaran')
                ->join('pengiriman','order.id_pengiriman','=','pengiriman.id_pengiriman')
                ->select('*', 'order.created_at as tanggal')
                ->count();
                return response()->json(['status' => 'success', 'data' => $data], 200);
            }else if(auth('admin-api')->user()->role==2){
                $city = auth('admin-api')->user()->province_id;
                $data = Order::
                join('kios','kios.id_kios','=','order.id_kios')
                ->join('konsumen','konsumen.id_konsumen','=','order.id_konsumen')
                ->join('produk_terjual','produk_terjual.id_order','=','order.id_order')
                ->join('produk_kios','produk_kios.id_produkkios','=','produk_terjual.id_produkkios')
                ->join('produk_koperasi','produk_kios.id_produkkoperasi','=','produk_koperasi.id_produkkoperasi')
                ->join('pembayaran','order.id_pembayaran','=','pembayaran.id_pembayaran')
                ->join('pengiriman','order.id_pengiriman','=','pengiriman.id_pengiriman')
                ->select('*', 'order.created_at as tanggal')
                ->where('kios.id_city', '=', $city)
                ->count();
                return response()->json(['status' => 'success', 'data' => $data], 200);
            }
        }else if(auth('kios-api')->check()){
            $kios = auth('kios-api')->user()->id_kios;
            $data = Order::
            join('kios','kios.id_kios','=','order.id_kios')
            ->join('konsumen','konsumen.id_konsumen','=','order.id_konsumen')
            ->join('produk_terjual','produk_terjual.id_order','=','order.id_order')
            ->join('produk_kios','produk_kios.id_produkkios','=','produk_terjual.id_produkkios')
            ->join('produk_koperasi','produk_kios.id_produkkoperasi','=','produk_koperasi.id_produkkoperasi')
            ->join('pembayaran','order.id_pembayaran','=','pembayaran.id_pembayaran')
            ->join('pengiriman','order.id_pengiriman','=','pengiriman.id_pengiriman')
            ->select('*', 'order.created_at as tanggal')
            ->where('kios.id_kios', '=', $kios)
            ->count();
            return response()->json(['status' => 'success', 'data' => $data], 200);
        }
    }
}
