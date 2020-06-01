<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin;

class AdminController extends Controller
{
    public function all()
    {
        return Admin::where('role','!=','1')->
        join('list_city','list_city.id_city','=','admins.province_id')
        ->get();
    }

    public function show($id)
    {
        return Admin::find($id);
    }

    public function store(Request $request)
    {
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->role = $request->role;
        $admin->province_id = $request->province_id;
        $admin->save();
        return $admin;
    }

    public function update($id, Request $request)
    {
        if($request->password!="" || !empty($request->password)){
            $admin = Admin::find($id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);
            $admin->role = $request->role;
            $admin->province_id = $request->province_id;
            $admin->save();
            return $admin;
        }else{
            $admin = Admin::find($id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->role = $request->role;
            $admin->province_id = $request->province_id;
            $admin->save();
            return $admin;
        }
    }

    public function delete($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return 204;
    }
}
