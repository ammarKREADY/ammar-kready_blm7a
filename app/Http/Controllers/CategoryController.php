<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CategoryController extends Controller
{
       function index() {
        $category=Category::with("image")->get();
        return view("admin.category",compact("category"));
    }
    function store(Request $request){
        $Category=Category::create($request->all());
        $Category->addMediaFromRequest("image")
        ->sanitizingFileName(function ($fileName) {
            return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
        })
        ->toMediaCollection();
    toastr()->success('تمت اضافة تصنيف بنجاح');
    return redirect()->back();

        return redirect()->back();
        
    }
    function edit(Request $request) {
        // Retrieve the category by ID
        $Category = Category::find($request->id);
    
        // Update the category name
        $Category->update($request->only("name"));
    
        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
            // Check if an existing image is associated with the category
            if ($Category->image) {
               $image= Media::find($Category->image->id);
               $image->delete();
            }
    
            // Add the new image to the media collection
            $Category->addMediaFromRequest("image")
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection();
        }
        toastr()->success('تمت تعديل تصنيف بنجاح');
    
        // Redirect back to the previous page
        return redirect()->back();
    }
    
    function delete() {
        $Category=Category::find(request()->id);
        $Category->delete();
    toastr()->success('تمت حذف تصنيف بنجاح');

        return redirect()->back();

    }
}
