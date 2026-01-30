<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FoodController extends Controller
{
    function index() {
        $food=Food::with("image","restaurant","category")->get();
        $resturant=Restaurant::get();
        $category=Category::get();
        return view("admin.food",compact("resturant","food","category"));
    }
    function store(Request $request){
        $Food=Food::create($request->all());
        $Food->addMediaFromRequest("image")
        ->sanitizingFileName(function ($fileName) {
            return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
        })
        ->toMediaCollection();
    toastr()->success('تمت اضافة طعام بنجاح');
    return redirect()->back();

        return redirect()->back();
        
    }
    function edit(Request $request) {
        // Retrieve the Food by ID
        $Food = Food::find($request->id);
    
        // Update the Food name
        $Food->update($request->only("name","restaurant_id","category_id","description","price"));
    
        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
            // Check if an existing image is associated with the Food
            if ($Food->image) {
               $image= Media::find($Food->image->id);
               $image->delete();
            }
    
            // Add the new image to the media collection
            $Food->addMediaFromRequest("image")
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection();
        }
        toastr()->success('تمت تعديل طعام بنجاح');
    
        // Redirect back to the previous page
        return redirect()->back();
    }
    
    function delete() {
        $Food=Food::find(request()->id);
        $Food->delete();
    toastr()->success('تمت حذف طعام بنجاح');

        return redirect()->back();

    }
}