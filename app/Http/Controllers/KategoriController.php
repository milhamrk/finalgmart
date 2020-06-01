<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Kategori;

class KategoriController extends Controller
{
    public function all()
    {
        return Kategori::all();
    }

    public function show($id)
    {
        return Kategori::find($id);
    }

    public function store(Request $request)
    {
        return Kategori::create($request->all());
    }

    public function update($id, Request $request)
    {
        $kategori = Kategori::find($id);
        $kategori->update($request->all());
        return $kategori;
    }

    public function delete($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return 204;
    }
}
