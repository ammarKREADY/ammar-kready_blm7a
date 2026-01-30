<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/logintest', function () {
    return view('login');
})->name("logintest");
Route::post('/add-to-session', function (Request $request) {
    $order = $request->only(['food_id', 'food_name', 'quantity', 'price']);

    // الحصول على الطلبات المخزنة في الجلسة
    $orders = Session::get('orders', []);

    // التحقق مما إذا كان العنصر مضافًا مسبقًا
    $exists = collect($orders)->contains(fn($o) => $o['food_id'] == $order['food_id']);

    if (!$exists) {
        $orders[] = $order;
        Session::put('orders', $orders);
    }

    return response()->json(['success' => !$exists, 'orders' => $orders]);
})->name('add.to.session');

Route::get('/show-order', [PagesController::class, 'show_order'])->name('orders.view');

Route::post("/submit-orders",[PagesController::class,"submit_orders"])->name('orders.submit');
Route::post('/orders/remove', function (Request $request) {
    $index = $request->input('index');
    $orders = Session::get('orders', []);

    if (isset($orders[$index])) {
        unset($orders[$index]);
        Session::put('orders', array_values($orders)); // إعادة ترتيب الفهرس
    }

    return response()->json(['success' => true]);
})->name('orders.remove');

// Route::get('/', function () {
//     return view('user.home');
// })->name("home");
Route::get("/",[PagesController::class,"home"])->name("home");
Route::get('/about', function () {
    return view('user.about');
})->name("about");
Route::get('/blog', function () {
    return view('user.blog');
})->name("blog");
Route::get('/userServices', function () {
    return view('user.services');
})->name("userServices");
Route::get('/contact', function () {
    return view('user.contact');
})->name("contact");
Route::get("vedio",function(){
    return "Here";
    $vedio= public_path("vedio/hrr.mp4");
    return response()->file($vedio);
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get("/driver",[PagesController::class,"driver"])->name("driver.index");
Route::post("/driver/{id}",[PagesController::class,"change"])->name("driver.change");
Route::get("/order",[PagesController::class,"change"])->name("admin.order");

Route::controller(HomeController::class)->group(function(){
    Route::get('admin/dashboard', 'index')->middleware(['auth' , 'admin']);
    // Route::get('/' ,'home');
    Route::get('shop' ,'shop');
    Route::get('shop/category/{id}', 'category');
    Route::get('whyus' , 'whyus');
    Route::get('shop/category/{id}', 'showProductsByCategory');
    Route::get('location' , 'location');
});
 Route::controller(AdminController::class)->group(function(){
    Route::get('view_category' ,'category')->middleware(['auth' , 'admin']);
    Route::get('admin/dashboard' , 'booking')->middleware(['auth' , 'admin'])->name('admin.index');
    Route::get('view_type' , 'type')->middleware('auth' , 'admin');
    Route::get('createproduct' ,'product')->middleware(['auth' , 'admin']);
    Route::get('view_product' ,'showProduct')->middleware(['auth' , 'admin']);
    Route::get('view_hall' ,'showHall')->middleware(['auth' , 'admin']);
    Route::get('edithall/{id}' , 'edithall')->middleware(['auth' , 'admin']);
    Route::get('services','getservices')->middleware(['auth' , 'admin']);
    Route::get('view_type_service' , 'getTypeService')->middleware('auth' , 'admin');
 });
Route::prefix("admin")->controller(CityController::class)->group(function(){
    Route::get("city","index");
    Route::post("store","store")->name("city.store");
    Route::post("edit","edit")->name("city.edit");
    Route::post("delete","delete")->name("city.delete");
    
});
Route::prefix("admin/category")->controller(CategoryController::class)->group(function(){
    Route::get("/","index")->name("admin.category");
    Route::post("store","store")->name("category.store");
    Route::post("edit","edit")->name("category.edit");
    Route::post("delete","delete")->name("category.delete");
    
});
Route::prefix("admin/food")->controller(FoodController::class)->group(function(){
    Route::get("/","index")->name("admin.food");
    Route::post("store","store")->name("food.store");
    Route::post("edit","edit")->name("food.edit");
    Route::post("delete","delete")->name("food.delete");
    
});
Route::prefix("admin/restaurant")->controller(RestaurantController::class)->group(function(){
    Route::get("/","index")->name("admin.restaurant");
    Route::post("store","store")->name("restaurant.store");
    Route::post("edit","edit")->name("restaurant.edit");
    Route::post("delete","delete")->name("restaurant.delete");
    
});
Route::prefix("admin/driver")->controller(DriverController::class)->group(function(){
    Route::get("/","index")->name("admin.driver");
    Route::post("store","store")->name("driver.store");
    Route::get("create","create")->name("driver.create");
    Route::get("edit/{id}","edit")->name("driver.edit");
    Route::post("update/{id}","update")->name("driver.update");
    Route::post("delete","delete")->name("driver.delete");
    
});
Route::get('getImage/{id}/{file_name}', function ($id, $file_name) {
    $path = public_path("media/$id/$file_name");
    if (file_exists($path)) {
        return response()->file($path);
    } else {
        abort(404);
    }
})->name('getImage');

Route::middleware(['auth'])->group(function () {
    Route::get('/driver/orders', [PagesController::class, 'driver'])->name('driver.orders');
});

Route::post('/driver/orders/{id}/update-status', [PagesController::class, 'change'])
    ->name('driver.orders.updateStatus');

    Route::get('/blog', [PagesController::class, 'blog'])->name('blog');
Route::get('/userServices', [PagesController::class, 'services'])->name('userServices');

Route::post('/driver/orders/accept/{id}', [PagesController::class, 'acceptOrder'])->name('driver.orders.accept');

