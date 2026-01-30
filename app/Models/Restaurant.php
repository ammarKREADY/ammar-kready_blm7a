<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Restaurant extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $fillable=["name","address","city_id"];
    public function city():BelongsTo
    {
        return $this->belongsTo(City::class,"city_id");
    }
    public function image(): HasOne
    {
        return $this->hasOne(Media::class, 'model_id')
            ->select("id", "file_name", "model_id", "disk")->where("model_type", "=", static::class);
    }
}
