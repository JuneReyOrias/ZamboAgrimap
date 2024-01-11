<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RicefieldBoarder extends Model
{
    use HasFactory;
    protected $table='ricefield_boarders';
    protected $fillable=[

    ];
    public function parcellaryboarder()
    {
        return $this->belongsTo(ParcelBoarder::class, 'id','ricefield_boarders_id');
    }









}
