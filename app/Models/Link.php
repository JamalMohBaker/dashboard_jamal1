<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Link extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'user_id',
        'tile_id',
        'name',
        'username',
        'logo',
        'link',
        'color',
        'password',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function tile()
    {
        return $this->belongsTo(Tiles::class,'tile_id');
    }
    public function linkPermissions(){
        return $this->hasMany(LinkPermission::class,'link_id');
    }

    public function getPasswordHashAttribute(){

        return Crypt::decrypt($this->password);

    }
}
