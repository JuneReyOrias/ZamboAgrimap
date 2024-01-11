<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fisheries extends Model
{
    use HasFactory;
    protected $table="fisheries";
    protected $fillable=[
        'users_id',
        'categorizes_id',
        'fisheries_categorys_id',
        'species_name',
        'common_name',
        'habitat',
        'fish_description',
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'users_id', )->withDefault();
    }
    public function categorize()
    {
        return $this->belongsTo(Categorize::class,'categorizes_id','id');
    }
    public function fisheriescategory()
    {
        return $this->belongsTo(FisheriesCategory::class,'fisheries_categorys_id','id');
    }
}
