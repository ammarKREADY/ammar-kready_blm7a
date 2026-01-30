<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Hall;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\TypeHall;
use App\Models\TypeService;
use Illuminate\Http\Request;

class AdminController extends Controller
{


  

    public function booking(){
        $data=Order::with("content","user","driver")->get();
        // $book=Book::with(['hall' , 'bookService'] )->get();
        // $type=TypeService::with('services')->get();
        return view('admin.index',compact("data") );
    }
    
}
