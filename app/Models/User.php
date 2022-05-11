<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use App\Scopes\UserIsActiveScope;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new UserIsActiveScope);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class,'user_id');
    }

    public function getFullNameAttribute($value)
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function setUserNameAttribute($username)
    {
        $this->attributes['username'] = Str::slug($username);
    }

    public function scopeIsAdmin($query)
    {
        return $query->where('isAdmin', true);
    }
}
