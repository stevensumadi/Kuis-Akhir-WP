<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use App\Models\Venue;

class location extends Model
{
    use HasFactory;

    public function venues(){
        return $this->hasMany(Venue::class);
    }
}
