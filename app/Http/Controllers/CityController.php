<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    function index() {
        $city=City::get();
        return view("admin.city",compact("city"));
    }
    function store(Request $request){
        $city=City::create($request->all());
    toastr()->success('تمت اضافة المدينة بنجاح');
        return redirect()->back();
    }
    function edit(Request $request) {
        $city=City::find(request()->id);
        $city->update($request->all());
        toastr()->success('تمت تعديل المدينة بنجاح');
        return redirect()->back();
    }
    function delete() {
        $city=City::find(request()->id);
        $city->delete();
        toastr()->success('تمت حذف المدينة بنجاح');
        return redirect()->back();

    }
}
