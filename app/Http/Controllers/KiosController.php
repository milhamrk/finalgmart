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

    public function show($id)
    {
        return Kios::find($id);
    }

    public function store(Request $request)
    {
        $maps = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?&address='.urlencode($request->alamat).'&key=AIzaSyAruPOCL0ke9sDt5Dq7hUqJxoJpU4K5mfo');
        $json = json_decode($maps, true);
        if($json['status']!="ZERO_RESULTS"){
            $kios = new Kios;
            $kios->nama_pemilik = $request->nama_pemilik;
            $kios->nama_kios = $request->nama_kios;
            $kios->email = $request->email;
            $kios->no_hp = $request->no_hp;
            $kios->alamat = $request->alamat;
            $kios->status_buka = $request->status_buka;
            $kios->longitude = $json['results'][0]['geometry']['location']['lng'];
            $kios->latitude = $json['results'][0]['geometry']['location']['lat'];
            $kios->status_buka = $request->status_buka;
            $kios->id_city = $request->id_city;
            $kios->save();
            return $kios;
        }else{
            $kota = Kota::find($request->id_city);
            $kotas = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?&address='.urlencode($kota->city_name).'&key=AIzaSyAruPOCL0ke9sDt5Dq7hUqJxoJpU4K5mfo'), true);
            $kios = new Kios;
            $kios->nama_pemilik = $request->nama_pemilik;
            $kios->nama_kios = $request->nama_kios;
            $kios->email = $request->email;
            $kios->no_hp = $request->no_hp;
            $kios->alamat = $request->alamat;
            $kios->status_buka = $request->status_buka;
            $kios->longitude = $kotas['results'][0]['geometry']['location']['lng'];
            $kios->latitude = $kotas['results'][0]['geometry']['location']['lat'];
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
        $maps = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?&address='.urlencode($request->alamat).'&key=AIzaSyAruPOCL0ke9sDt5Dq7hUqJxoJpU4K5mfo');
        $json = json_decode($maps, true);
        if($json['status']!="ZERO_RESULTS"){
            $kios = Kios::find($id);
            $kios->nama_pemilik = $request->nama_pemilik;
            $kios->nama_kios = $request->nama_kios;
            $kios->email = $request->email;
            $kios->no_hp = $request->no_hp;
            $kios->alamat = $request->alamat;
            $kios->status_buka = $request->status_buka;
            $kios->longitude = $json['results'][0]['geometry']['location']['lng'];
            $kios->latitude = $json['results'][0]['geometry']['location']['lat'];
            $kios->status_buka = $request->status_buka;
            $kios->id_city = $request->id_city;
            $kios->save();
            return $kios;
        }else{
            $kota = Kota::find($request->id_city);
            $kotas = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?&address='.urlencode($kota->city_name).'&key=AIzaSyAruPOCL0ke9sDt5Dq7hUqJxoJpU4K5mfo'), true);
            $kios = Kios::find($id);
            $kios->nama_pemilik = $request->nama_pemilik;
            $kios->nama_kios = $request->nama_kios;
            $kios->email = $request->email;
            $kios->no_hp = $request->no_hp;
            $kios->alamat = $request->alamat;
            $kios->status_buka = $request->status_buka;
            $kios->longitude = $kotas['results'][0]['geometry']['location']['lng'];
            $kios->latitude = $kotas['results'][0]['geometry']['location']['lat'];
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
