<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Tiles extends Model
{
    use HasFactory , SoftDeletes;
    // public function getLogourlAttribute()
    // {
    //     if ($this->logo) {
    //         return Storage::disk('public')->url($this->logo);
    //     }
    //     return 'http://127.0.0.1:8000/assets/images/web.jpg';
    // }

    protected $fillable = [
        'name',
        'color',
        'logo',
        'link',
    ];

    public function links(){
        return $this->hasMany(Link::class,'tile_id');
    }
    public function userTiles()
    {
        return $this->hasMany(UserTile::class, 'tile_id');
    }
}
