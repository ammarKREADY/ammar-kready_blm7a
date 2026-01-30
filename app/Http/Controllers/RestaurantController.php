<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class RestaurantController extends Controller
{
    function index() {
        $restaurant=Restaurant::with("image","city")->get();
        $city=City::get();
        return view("admin.restaurant",compact("restaurant","city"));
    }
    function store(Request $request){
        $restaurant=Restaurant::create($request->all());
        $restaurant->addMediaFromRequest("image")
        ->sanitizingFileName(function ($fileName) {
            return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
        })
        ->toMediaCollection();
    toastr()->success('تمت اضافة مطعم بنجاح');
    return redirect()->back();

        return redirect()->back();
        
    }
    function edit(Request $request) {
        // Retrieve the restaurant by ID
        $restaurant = Restaurant::find($request->id);
    
        // Update the restaurant name
        $restaurant->update($request->only("name","address","city_id"));
    
        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
            // Check if an existing image is associated with the restaurant
            if ($restaurant->image) {
               $image= Media::find($restaurant->image->id);
               $image->delete();
            }
    
            // Add the new image to the media collection
            $restaurant->addMediaFromRequest("image")
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection();
        }
        toastr()->success('تمت تعديل مطعم بنجاح');
    
        // Redirect back to the previous page
        return redirect()->back();
    }
    
    function delete() {
        $restaurant=Restaurant::find(request()->id);
        $restaurant->delete();
    toastr()->success('تمت حذف حذف بنجاح');

        return redirect()->back();

    }
}
