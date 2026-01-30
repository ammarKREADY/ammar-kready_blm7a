<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends Model
{
    use HasFactory;
    protected $fillable=["user_id","city_id","start_jop","end_jop","vehicle","driver_cost","salary","status"];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }
    public function city():BelongsTo
    {
        return $this->belongsTo(City::class,"city_id");
    }
}
