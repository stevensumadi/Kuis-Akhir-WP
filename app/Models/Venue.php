<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Location;

class venue extends Model
{
    use HasFactory;

    public function regency(){
        return $this->belongsTo(Location::class, 'location_id');
    }
}
