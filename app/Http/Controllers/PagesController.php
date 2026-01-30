<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Driver;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderContent;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function home(Request $request)
    {
        $city = City::all();
        $resturantAll=Restaurant::get();
        $categoryAll=Category::get();
        $resturant = Restaurant::when($request->has("resturant_id"), function ($query) use ($request) {
            return $query->where("id", $request->get("resturant_id"));
        })->get();

      $category = Category::when($request->has("category_id"), function ($query) use ($request) {
    return $query->where("id", $request->get("category_id"));
})->get();

foreach ($category as $cat) {
    $cat->setRelation('food', $cat->food()->inRandomOrder()->get());
}

        return view("user.home", compact("city", "resturant", "category","resturantAll","categoryAll"));
    }
    function show_order(Request $request) {
        $orders = Session::get('orders', []);
        $driver=Driver::with("user")->get();
        // return $orders;
        return view('user.show_order', compact('orders',"driver"));
    }
  public function submit_orders(Request $request)
{
    $driver = Driver::find($request->driver_id);

    if (!$driver) {
        return redirect()->back()->with('error', '🚨 السائق غير موجود.');
    }

    // استرجاع الطلبات من الجلسة
    $orders = Session::get('orders', []);

    // استخراج أول منتج لتحديد المطعم
    $firstFood = Food::find($request->orders[0]['food_id']);
    $restaurantId = $firstFood ? $firstFood->restaurant_id : null;

    if (!$restaurantId) {
        return redirect()->back()->with('error', '🚨 لا يمكن تحديد المطعم من المنتجات.');
    }

    // إنشاء الطلب الرئيسي
    $order = Order::create([
        "user_id" => Auth::id(),
        "driver_id" => $driver->id,
        "restaurant_id" => $restaurantId,
        "address" => $request->address,
        "phone" => $request->phone,
        "status" => "waiting_acceptance",
        "total_price" => 0,
        "drive_price" => $driver->driver_cost
    ]);

    $totalPrice = 0;

    foreach ($request->orders as $orderData) {
        $food = Food::find($orderData["food_id"]);

        if (!$food) {
            return redirect()->back()->with('error', '🚨 أحد المنتجات غير موجود.');
        }

        OrderContent::create([
            "order_id" => $order->id,
            "food_id" => $orderData["food_id"],
            "quantity" => $orderData["quantity"]
        ]);

        $totalPrice += $food->price * $orderData["quantity"];
    }

    $order->update(["total_price" => $totalPrice]);

    Session::forget("orders");

    return redirect()->route("home")->with('success', '🎉 تم إرسال الطلب بنجاح!');
}


    public function acceptOrder($id)
{
    $order = Order::findOrFail($id);
    $driver = Driver::where('user_id', Auth::id())->first();

    if ($order->driver_id != $driver->id) {
        return redirect()->back()->with('error', '🚫 لا يمكنك قبول هذا الطلب.');
    }

    if ($order->status === 'waiting_acceptance') {
        $order->status = 'on_way';
        $order->save();
        return redirect()->back()->with('success', '✅ تم قبول الطلب بنجاح، وهو الآن في الطريق.');
    }

    return redirect()->back()->with('error', '❗لا يمكن قبول هذا الطلب.');
}

   public function driver()
{
    $driver = Driver::where('user_id', Auth::id())->first();

    if (!$driver) {
        // لا يوجد سائق مرتبط بالمستخدم الحالي
        // يمكن إرسال رسالة أو عرض صفحة فارغة أو إعادة توجيه
        return view('admin.driver', ['orders' => collect()])->with('error', 'لم يتم العثور على حساب سائق.');
    }

    $orders = Order::where('driver_id', $driver->id)->with(['content.food', 'user'])->get();

    return view('admin.driver', compact('orders'));
}

    function order() {
        $data=Order::with("content","user","driver")->get();
        return view("admin.driver",compact("data"));
    }
    function change(Request $request,$id)  {
        $order=Order::find($id);
        $order->status=$request->status;
        $order->save();
        return redirect()->back()->with('success', '🎉 تم إرسال الطلب بنجاح!');
    }
    public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->status = $request->input('status');
    $order->save();

    return response()->json([
        'success' => true,
        'message' => 'تم تحديث حالة الطلب بنجاح'
    ]);
}
public function blog()
{
    $resturantAll = Restaurant::with('image', 'city')->get(); // تحميل الصور والمدن للمطاعم
    return view('user.blog', compact('resturantAll'));
}

public function services()
{
    // جلب التصنيفات مع تحميل عشوائي للأطعمة والصور
    $category = Category::with(['food.image'])->get();

    return view('user.services', compact('category'));
}


}


