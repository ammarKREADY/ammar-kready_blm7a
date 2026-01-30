<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    function index() {
    
        $driver=Driver::with("user","city")->get();
        return view("admin.driver.driver",compact("driver"));
    }
    function create()  {
        $city=City::get();
        return view("admin.driver.createDriver",compact("city"));
    }
    function store(Request $request){
        $request->validate([
            'name'=>"required|string|unique:users,name,except,id",
            'phone'=>"required|string",
            'email'=>"required|email|unique:users,email,except,id",
        ]);
        $data=json_decode($request);
        $user=User::create([
            "usertype"=>"driver",
            "name"=>$request->name,
            "phone"=>$request->phone,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
        ]);
        $Driver=Driver::create(array_merge($request->all(),["user_id"=>$user->id]));
    toastr()->success('تمت اضافة Driver بنجاح');
        return redirect()->route("admin.driver");
    }
    function edit($id,Request $request) {
        $driver=Driver::where("id",$id)->with("city","user")->first();
        $city=City::get();
        return view("admin.driver.editDrive",compact("driver","city"));
    }
    function update($id, Request $request) {
        $driver=Driver::find($id);
        $driver->user->name=$request->name??$driver->user->name;
        $driver->user->phone=$request->phone??$driver->user->phone;
        $driver->user->email=$request->email??$driver->user->email;
        if ($request->password) {
            $driver->user->password=Hash::make($request->password);
        }
        $driver->user->save();
        $driver->update($request->all());
        toastr()->success('تمت تعديل Driver بنجاح');
        return redirect()->route("admin.driver");
    }
    function delete() {
        $Driver=Driver::find(request()->id);
        $Driver->delete();
        toastr()->success('تمت حذف Driver بنجاح');
        return redirect()->back();

    }
}
