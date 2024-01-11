<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    use HasFactory;
    protected $table="livestocks";
    protected $fillable=[
        'users_id',
        'categorizes_id',
        'livestock_categorys_id',
        'livestock_name',
        'breed',
        'age',
        'gender',
        'livestock_description',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'users_id', )->withDefault();
    }
    public function categorize()
    {
        return $this->belongsTo(Categorize::class,'categorizes_id','id');
    }
    public function livestockcategory()
    {
        return $this->belongsTo(livestockCategory::class,'livestock_categorys_id','id');
    }

}  
