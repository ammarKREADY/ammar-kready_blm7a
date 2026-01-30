<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model

{
    use HasFactory;
    protected $fillable=["user_id","driver_id","restaurant_id","address","status",'phone',"total_price","drive_price"];
  
    public function content()
   {
       return $this->hasMany(OrderContent::class)->with("food");
   }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }
    public function driver():BelongsTo
    {
        return $this->belongsTo(Driver::class,"driver_id")->with("user");
    }
    public function restaurant():BelongsTo
    {
        return $this->belongsTo(Restaurant::class,"restaurant_id");
    }
}
