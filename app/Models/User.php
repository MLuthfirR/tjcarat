<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Oauth_access_token;
use App\Models\Oauth_refresh_token;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
    ];

    public function AuthAccessToken(){
        return $this->hasMany('App\Models\Oauth_access_token');
    }

    public function RefreshToken(){
        // return $this->hasManyThrough(Oauth_refresh_token::class, Oauth_access_token::class);

        return $this->hasManyThrough(
            Oauth_refresh_token::class,
            Oauth_access_token::class,
            'user_id',
            'access_token_id',
            'id',
            'id'
        );
    }
    public function documents() {
        return $this->hasMany('App\Models\User_document', 'user_uuid', 'uuid')->orderBy('id');
    }
}
