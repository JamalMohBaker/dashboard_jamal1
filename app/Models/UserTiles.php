<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTiles extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','tile_id',
    ];
    public function tile(){
        return $this->belongsTo(Tiles::class,'tile_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
