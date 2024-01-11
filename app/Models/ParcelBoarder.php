<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelBoarder extends Model
{
    use HasFactory;
    protected $table="parcellary_boundaries";
    protected $fillable=[
        'users_id',
        'agri_districts_id',
        'ricefield_boarders_id',
        'parcel_name',
        'area',
     'series',
     'tct_no',
     'brgy_name',
     'atdn',
     'arpowner_na',
     'pkind_desc',
     'puse_desc',
     'actual_used',
     'market_value',
     'asssesedva',
       'parone_latitude',
       'parone_longitude',
       'partwo_latitude',
       'partwo_longitude',
       'parthree_latitude',
       'parthree_longitude',
       'parfour_latitude',
       'parfour_longitude',
       'parfive_latitude',
       'parfive_longitude',
       'parsix_latitude',
       'parsix_longitude',
       'parseven_latitude',
       'parseven_longitude',
       'pareight_latitude',
       'pareight_longitude',
       'parnine_latitude',
       'parnine_longitude',
       'parten_latitude',
       'parten_longitude',
       'pareleven_latitude',
       'pareleven_longitude',
       'partwelve_latitude',
       'partwelve_longitude',
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'users_id', )->withDefault();
    }
    public function agridistricts()
    {
        return $this->belongsTo(AgriDistrict::class,'agri_districts_id','id');
    }
    public function ricefieldboarders()
    {
        return $this->belongsTo(RicefieldBoarder::class,'ricefield_boarders_id','id');
    }
    
}
