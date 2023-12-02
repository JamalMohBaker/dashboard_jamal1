<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\TwoFactorAuthenticatable;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes , TwoFactorAuthenticatable;
    const TYPE_USER = 'user';
    const TYPE_ADMIN = 'admin';
    const TYPE_USER_MANAGEMENT = 'user_management';
    public static function typesOptions()
    {
       return [
            self::TYPE_USER => 'user',
            self::TYPE_ADMIN => 'admin',
            self::TYPE_USER_MANAGEMENT => 'user_management',
       ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'key',
        'image',
        'phone',
        'username',
        'scan',
    ];
    public function links(){
        return $this->hasMany(Link::class,'user_id','id');
    }
    public function linkPermissions(){
        return $this->hasMany(LinkPermission::class,'user_id');
    }
    public function userTiles()
    {
        return $this->hasMany(UserTiles::class, 'user_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
