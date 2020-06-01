<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Konsumen;

class KonsumenKontroller extends Controller
{
    public function all()
    {
        return Konsumen::all();
    }

    public function show($id)
    {
        return Konsumen::find($id);
    }

    public function store(Request $request)
    {
        return Konsumen::create($request->all());
    }

    public function update($id, Request $request)
    {
        $konsumen = Konsumen::find($id);
        $konsumen->update($request->all());
        return $konsumen;
    }

    public function delete($id)
    {
        $konsumen = Konsumen::find($id);
        $konsumen->delete();
        return 204;
    }
}
