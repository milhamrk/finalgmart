<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\produk_koperasi as Produk;
use App\Stok;
use App\produk_kios;
use File;
use Storage;
use app\Admin;
use App\Exports\ProdukKoperasiExport;
use App\Imports\ProdukKoperasiImport;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Client;

class ProdukKontroller extends Controller
{
    public function all()
    {
        if(auth('admin-api')->check() && auth('admin-api')->user()->role==2){
            $id = auth('admin-api')->user()->id;
            return Produk::join('kategori','kategori.id_kategori','=','produk_koperasi.id_kategori')
                    ->leftJoin('stok', function($join) use ($id)
                     {
                         $join->on('stok.id_produkkoperasi', '=', 'produk_koperasi.id_produkkoperasi');
                         $join->where('stok.id_admin', '=', $id);
                     })
                    ->select('produk_koperasi.*','stok.stok','kategori.nama_kategori', 'stok.harga_koperasi as harga_jual')
                    ->get();
        }
        elseif(auth('admin-api')->check() && auth('admin-api')->user()->role==1){
            return Produk::join('kategori','kategori.id_kategori','=','produk_koperasi.id_kategori')->get();
        }else{
            $id = auth('kios-api')->user()->id_kios;
            $city = Admin::where('province_id',auth('kios-api')->user()->id_city)->first();
            return Produk::join('kategori','kategori.id_kategori','=','produk_koperasi.id_kategori')
                    ->leftJoin('produk_kios', function($join) use ($id)
                     {
                         $join->on('produk_kios.id_produkkoperasi', '=', 'produk_koperasi.id_produkkoperasi');
                         $join->where('produk_kios.id_kios', '=', $id);
                     })
                    ->leftJoin('stok', function($join) use ($city)
                     {
                         $join->on('stok.id_produkkoperasi', '=', 'produk_koperasi.id_produkkoperasi');
                         $join->where('stok.id_admin', '=', $city->id);
                     })
                    ->select('produk_koperasi.nama_produk','produk_koperasi.id_produkkoperasi','produk_koperasi.merk','produk_koperasi.gambar','produk_kios.stok','kategori.nama_kategori', 'produk_kios.harga as harga_jual', 'stok.harga_koperasi as harga_koperasi')
                    ->get();
        }
        
    }

    public function export()
    {
        return Excel::download(new ProdukKoperasiExport, 'produk.xlsx');
    }

    public function storeExcel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = $file->hashName();

        $path = $file->storeAs('public/excel/',$nama_file);

        $import = Excel::import(new ProdukKoperasiImport(), storage_path('app/public/excel/'.$nama_file));

        Storage::delete($path);

        if($import) {
            return "success";
        } else {
            return "failed";
        }
    }

    public function show($id)
    {
        if(auth('admin-api')->user() && auth('admin-api')->user()->role==2){
            $ids = auth('admin-api')->user()->id;
            return Produk::join('kategori','kategori.id_kategori','=','produk_koperasi.id_kategori')
                    ->leftJoin('stok', function($join) use ($ids)
                     {
                         $join->on('stok.id_produkkoperasi', '=', 'produk_koperasi.id_produkkoperasi');
                         $join->where('stok.id_admin', '=', $ids);
                     })
                    ->select('produk_koperasi.*','stok.stok','kategori.nama_kategori', 'stok.harga_koperasi as harga_jual')
                    ->where('produk_koperasi.id_produkkoperasi','=',$id)
                    ->first();
        }
        elseif(auth('admin-api')->user() && auth('admin-api')->user()->role==1){
            return Produk::find($id);
        }else{
            $ids = auth('kios-api')->user()->id_kios;
            return Produk::join('kategori','kategori.id_kategori','=','produk_koperasi.id_kategori')
                    ->leftJoin('produk_kios', function($join) use ($ids)
                     {
                         $join->on('produk_kios.id_produkkoperasi', '=', 'produk_koperasi.id_produkkoperasi');
                         $join->where('produk_kios.id_kios', '=', $ids);
                     })
                    ->select('produk_koperasi.*','produk_kios.stok','kategori.nama_kategori', 'produk_kios.harga as harga_jual')
                    ->where('produk_koperasi.id_produkkoperasi','=',$id)
                    ->first();
        }
    }

    public function store(Request $request)
    {
        $id = time();
        $imageName = $id.'.'.$request->gambar->getClientOriginalExtension();
        $request->gambar->move(public_path('images'), $imageName);
        $client = new Client();
        $res = $client->request('POST', 'https://gmart.vokasidev.com/api/t0.php', [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => file_get_contents(public_path('images')."/".$imageName),
                    'filename' => $imageName
                ]
            ]
        ]);
        $produk = Produk::create([
            'id_produkkoperasi' => $id,
            'gambar' => $res->getBody(),  
            'merk' => $request->merk,     
            'harga_koperasi' => $request->harga_koperasi,     
            'nama_produk' => $request->nama_produk,     
            'id_kategori' => $request->id_kategori,     
        ]);
        return $produk;
    }

    public function pesan(Request $request)
    {
        if(auth('admin-api')->user() && auth('admin-api')->user()->role!=1){
            $data = Stok::where('id_admin', auth('admin-api')->user()->id)
            ->where('id_produkkoperasi', $request->id_produkkoperasi)
            ->get();
            if($data->isEmpty()){
                $init = new Stok;
                $produk = Produk::find($request->id_produkkoperasi);
                $init->id_admin = auth('admin-api')->user()->id;
                $init->id_produkkoperasi = $request->id_produkkoperasi;
                $init->stok = $request->stok;
                $init->harga_koperasi = $produk->harga_koperasi;
                $init->save();
                return $init;
            }else{
                $init = Stok::where('id_admin', auth('admin-api')->user()->id)
                ->where('id_produkkoperasi', $request->id_produkkoperasi)
                ->first();
                $init->stok = $init->stok+$request->stok;
                $init->save();
                return $init;
            }
        }else{
            $data = produk_kios::where('id_kios', auth('kios-api')->user()->id_kios)
            ->where('id_produkkoperasi', $request->id_produkkoperasi)
            ->get();
            if($data->isEmpty()){
                $init = new produk_kios;
                $produk = Produk::find($request->id_produkkoperasi);
                $init->id_kios = auth('kios-api')->user()->id_kios;
                $init->id_produkkoperasi = $request->id_produkkoperasi;
                $init->stok = $request->stok;
                $init->harga = $produk->harga_koperasi;
                $init->save();
                return $init;
            }else{
                $init = produk_kios::where('id_kios', auth('kios-api')->user()->id_kios)
                ->where('id_produkkoperasi', $request->id_produkkoperasi)
                ->first();
                $init->stok = $init->stok+$request->stok;
                $init->save();
                return $init;
            }
        }
    }

    public function harga(Request $request)
    {
        if(auth('admin-api')->user() && auth('admin-api')->user()->role!=1){
            $init = Stok::where('id_admin', auth('admin-api')->user()->id)
            ->where('id_produkkoperasi', $request->id_produkkoperasi)
            ->first();
            $init->harga_koperasi = $request->harga_koperasi;
            $init->save();
            return $init;
        }else{
            $init = produk_kios::where('id_kios', auth('kios-api')->user()->id_kios)
            ->where('id_produkkoperasi', $request->id_produkkoperasi)
            ->first();
            $init->harga = $request->harga_koperasi;
            $init->save();
            return $init;
        }
    }

    public function update($id, Request $request)
    {
        $produk = Produk::find($id);
        $imageName = $produk->gambar;
        if(isset($request->gambar) || !empty($request->gambar)){
            $image_path = "/images/".$produk->gambar;
            if(File::exists($image_path)) {
                File::delete($image_path);
                $imageName = $id.'.'.$request->gambar->getClientOriginalExtension();
                $request->gambar->move(public_path('images'), $imageName);
            }
        }
        $produk->gambar = $imageName;
        $produk->merk = $request->merk;
        $produk->harga_koperasi = $request->harga_koperasi;
        $produk->nama_produk = $request->nama_produk;
        $produk->id_kategori = $request->id_kategori;
        $produk->save();
        return $produk;
    }

    public function delete($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return 204;
    }
}