<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function player1(): BelongsTo{
        return $this->belongsTo(User::class, 'player_1');
    }

    public function player2(): BelongsTo{
        return $this->belongsTo(User::class, 'player_2');
    }
}
