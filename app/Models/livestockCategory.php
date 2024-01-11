<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class livestockCategory extends Model
{
    use HasFactory;
    protected $table="livestock_categorys";
    protected $fillable=[
        'users_id',
        'agri_districts_id',
        'categorizes_id',
        'livestock_category_name',
        'livestock_description',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'users_id', )->withDefault();
    }
    public function agridistricts()
    {
        return $this->belongsTo(AgriDistrict::class,'agri_districts_id','id');
    }
    public function categorize()
    {
        return $this->belongsTo(Categorize::class,'categorizes_id','id');
    }
}
