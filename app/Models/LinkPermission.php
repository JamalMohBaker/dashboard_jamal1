<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id','user_permissions',
    ];
    public function link(){
        return $this->belongsTo(Link::class,'link_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
