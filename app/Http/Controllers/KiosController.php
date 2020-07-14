<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kios;
use App\Kota;
use App\Admin;

class KiosController extends Controller
{
    public function all()
    {
        return Kios::all();
    }

    public function kota()
    {
        return Kota::all();
    }

    public function kotaAdmin()
    {
        return Kota::whereNotIn('id_city',function($query) {
            $query->select('province_id as id_city')->from('admins');
        })->get();
    }

    public function show($id)
    {
        return Kios::find($id);
    }

    public function store(Request $request)
    {
        $maps = file_get_contents('http://api.positionstack.com/v1/forward?query='.urlencode($request->alamat).'&access_key=2ccde9534b05e1884f500fe30aba0c53');
        $json = json_decode($maps, true);
        if(empty($json['data'])){
            $kios = new Kios;
            $kios->nama_pemilik = $request->nama_pemilik;
            $kios->nama_kios = $request->nama_kios;
            $kios->email = $request->email;
            $kios->no_hp = $request->no_hp;
            $kios->alamat = $request->alamat;
            $kios->status_buka = $request->status_buka;
            $kios->longitude = $json['data'][0]['latitude'];
            $kios->latitude = $json['data'][0]['longitude'];
            $kios->status_buka = $request->status_buka;
            $kios->id_city = $request->id_city;
            $kios->save();
            return $kios;
        }else{
            $kota = Kota::find($request->id_city);
            $kotas = json_decode(file_get_contents('http://api.positionstack.com/v1/forward?query='.urlencode($request->alamat).'&access_key=2ccde9534b05e1884f500fe30aba0c53'), true);
            $kios = new Kios;
            $kios->nama_pemilik = $request->nama_pemilik;
            $kios->nama_kios = $request->nama_kios;
            $kios->email = $request->email;
            $kios->no_hp = $request->no_hp;
            $kios->alamat = $request->alamat;
            $kios->status_buka = $request->status_buka;
            $kios->longitude = $json['data'][0]['latitude'];
            $kios->latitude = $json['data'][0]['longitude'];
            $kios->status_buka = $request->status_buka;
            $kios->id_city = $request->id_city;
            $kios->save();
            return $kios;
        }
    }

    public function adminUser($id){
        $data = Admin::where('province_id', '=', $id)->first();
        return $data->email;
    }

    public function update($id, Request $request)
    {
        $maps = file_get_contents('http://api.positionstack.com/v1/forward?query='.urlencode($request->alamat).'&access_key=2ccde9534b05e1884f500fe30aba0c53');
        $json = json_decode($maps, true);
        if(empty($json['data'])){
            $kios = Kios::find($id);
            $kios->nama_pemilik = $request->nama_pemilik;
            $kios->nama_kios = $request->nama_kios;
            $kios->email = $request->email;
            $kios->no_hp = $request->no_hp;
            $kios->alamat = $request->alamat;
            $kios->status_buka = $request->status_buka;
            $kios->longitude = $json['data'][0]['latitude'];
            $kios->latitude = $json['data'][0]['longitude'];
            $kios->status_buka = $request->status_buka;
            $kios->id_city = $request->id_city;
            $kios->save();
            return $kios;
        }else{
            $kota = Kota::find($request->id_city);
            $kotas = json_decode(file_get_contents('http://api.positionstack.com/v1/forward?query='.urlencode($request->alamat).'&access_key=2ccde9534b05e1884f500fe30aba0c53'), true);
            $kios = Kios::find($id);
            $kios->nama_pemilik = $request->nama_pemilik;
            $kios->nama_kios = $request->nama_kios;
            $kios->email = $request->email;
            $kios->no_hp = $request->no_hp;
            $kios->alamat = $request->alamat;
            $kios->status_buka = $request->status_buka;
            $kios->longitude = $json['data'][0]['latitude'];
            $kios->latitude = $json['data'][0]['longitude'];
            $kios->status_buka = $request->status_buka;
            $kios->id_city = $request->id_city;
            $kios->save();
            return $kios;
        }
    }

    public function delete($id)
    {
        $kios = Kios::find($id);
        $kios->delete();
        return 204;
    }
}
