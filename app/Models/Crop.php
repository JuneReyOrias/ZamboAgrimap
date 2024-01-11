<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;
    protected $table="crops";
    protected $fillable=[
        'users_id',
        'categorizes_id',
        'crop_categorys_id',
        'crop_name',
        'crop_variety',
        'crop_planting_season',
        'crop_harvesting_season',
        'crop_type_soil',
        'crop_description',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id', )->withDefault();
    }
    public function categorize()
    {
        return $this->belongsTo(Categorize::class,'categorizes_id','id');
    }
    public function cropcategory()
    {
        return $this->belongsTo(CropCategory::class,'crop_categorys_id','id');
    }
}
