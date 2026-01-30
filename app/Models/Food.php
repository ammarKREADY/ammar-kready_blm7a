<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Food extends Model implements HasMedia
{
    use HasFactory;
  use InteractsWithMedia;
    protected $fillable=["name","restaurant_id","category_id","description","price"];
    public function restaurant():BelongsTo
    {
        return $this->belongsTo(Restaurant::class,"restaurant_id");
    }
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class,"category_id");
    }
    public function image(): HasOne
    {
        return $this->hasOne(Media::class, 'model_id')
            ->select("id", "file_name", "model_id", "disk")->where("model_type", "=", static::class);
    }
}
