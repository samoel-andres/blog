<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
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
        'password' => 'hashed',
    ];

    // create profile when is created any user
    protected static function boot()
    {
        parent::boot();

        // assign profile 
        static::created(function ($user) {
            $user->profile()->create();
        });
    }

    // Relation one - one (user-profile)
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Relation one - many (user-article)
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Relation one - many (user-comment)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // display photo on admin LTE
    // public function adminlte_image()
    // {
    //     return asset('storage/' . Auth::user()->profile->photo);
    // }
}
